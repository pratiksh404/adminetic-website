import { produce } from 'immer';
import { v4 as uuidv4 } from 'uuid';
import set from 'lodash/set';
import { CancelTokenSource } from 'axios';
import { findObjectIndexByUuid } from './selectors';
import { uploadFile, getCancelTokenSource, api } from './api';
import { getMediaPreview, getFileTypeIsAllowed, mergeDeep } from './util';
import { defaultTranslations } from './translations';
import { MediaLibrary } from './types';
import { cloneDeep } from 'lodash';

declare global {
    interface Window {
        mediaLibraryTranslations: MediaLibrary.Translations;
    }
}

export default class MediaLibraryClass {
    config: MediaLibrary.Config;
    state: MediaLibrary.State;
    translations: MediaLibrary.Translations;
    subscribers: Array<MediaLibrary.Subscriber>;

    constructor(options: MediaLibrary.Options) {
        this.config = mergeDeep(
            {
                routePrefix: 'media-library-pro',
                immutable: false,
                validationRules: { accept: [], minSizeInKB: 0, maxSizeInKB: 0 },
                maxSizeForPreviewInBytes: 5242880,
                vapor: false,
                vaporSignedStorageUrl: '/vapor/signed-storage-url',
                uploadDomain: '',
                withCredentials: true,
                headers: {},
                beforeUpload: () => {},
                afterUpload: () => {},
            },
            options.config
        );

        const initialValue: Array<Partial<MediaLibrary.MediaAttributes>> = options.initialValue
            ? Array.isArray(options.initialValue)
                ? options.initialValue
                : Object.values(options.initialValue)
            : [];

        this.state = {
            media: initialValue.map(this.createMedia),
            invalidMedia: [],
            validationErrors: options.validationErrors || {},
        };

        this.translations =
            window.mediaLibraryTranslations || options.translations
                ? mergeDeep(defaultTranslations, window.mediaLibraryTranslations || options.translations)
                : defaultTranslations;

        window.mediaLibraryTranslations = this.translations;

        this.subscribers = [];
    }

    private createMedia(attributes: Partial<MediaLibrary.MediaAttributes>): MediaLibrary.MediaObject {
        if (!attributes.uuid) {
            throw new Error('media-library-pro-core: A media object requires a uuid');
        }

        return {
            attributes: {
                uuid: '',
                order: 0,
                name: '',
                preview_url: null,
                original_url: null,
                ...attributes,
                custom_properties:
                    typeof attributes.custom_properties === 'string'
                        ? JSON.parse(attributes.custom_properties)
                        : attributes.custom_properties || {},
            },
            client_preview: null,
            clientValidationErrors: [],
            upload: {
                uploadProgress: 100,
                hasFinishedUploading: true,
                hadErrorWhileUploading: false,
                errorMessage: null,
                cancelTokenSource: null,
            },
        };
    }

    public get hasUploadsInProgress() {
        return this.state.media.some((object) => !object.upload.hasFinishedUploading);
    }

    public get hasValidationErrors() {
        return this.state.media.some((object) => object.clientValidationErrors.length);
    }

    public get isReadyToSubmit() {
        return !(this.hasUploadsInProgress || this.hasValidationErrors);
    }

    public get value(): ReadonlyArray<MediaLibrary.MediaAttributes> {
        // These are the properties of the mediaObjects that are actually relevant to the backend, so we're not sending
        // the entire preview blob in a form submit. We're sending the preview_url so we can get it back in the 'old'
        // values.
        return this.state.media.map((object) => object.attributes);
    }

    public getErrors(uuid: string): Array<string> {
        const object = this.state.media.find((object) => object.attributes.uuid === uuid);

        if (!object) {
            return [];
        }

        let errors: Array<string> = [];

        if (object.upload.errorMessage) {
            errors.push(object.upload.errorMessage);
        }

        if (object.clientValidationErrors.length) {
            errors = errors.concat(object.clientValidationErrors);
        }

        if (this.state.validationErrors[uuid]) {
            errors = errors.concat(this.state.validationErrors[uuid]);
        }

        return errors;
    }

    public clearObjectErrors(uuid: string): void {
        const index = findObjectIndexByUuid(this.state, uuid);

        if (index !== -1) {
            this.changeState((state) => {
                state.media[index].clientValidationErrors = [];
                state.media[index].upload.hadErrorWhileUploading = false;
                state.media[index].upload.errorMessage = null;
            });
        }

        if (this.state.validationErrors[uuid]) {
            this.setValidationErrors({ ...this.state.validationErrors, [uuid]: [] });
        }
    }

    public changeState(callback: (state: MediaLibrary.State) => void): void {
        if (this.config.immutable) {
            this.state = produce(this.state, callback);
        } else {
            callback(this.state);
        }

        this.subscribers.forEach((subscriber) => {
            subscriber(this.state);
        });
    }

    public subscribe(subscriber: MediaLibrary.Subscriber): void {
        this.subscribers.push(subscriber);
    }

    private async addInvalidMedia(file: File, validationErrors: Array<string>) {
        const client_preview = await getMediaPreview(file, this.config.maxSizeForPreviewInBytes);

        this.changeState((state) => {
            state.invalidMedia.push({
                attributes: {
                    name: file.name,
                },
                client_preview,
                errors: validationErrors,
            });
        });
    }

    public clearInvalidMedia() {
        this.changeState((state) => {
            state.invalidMedia = [];
        });
    }

    public async addFile(file: File) {
        const validationErrors = await this.getFileValidationErrors(file);

        if (validationErrors.length) {
            this.addInvalidMedia(file, validationErrors);

            return;
        }

        const uuid = uuidv4();
        const cancelTokenSource = getCancelTokenSource();

        const newMediaObject: MediaLibrary.MediaObject = {
            attributes: {
                uuid,
                name: file.name,
                order: this.state.media.length,
                custom_properties: {},
                preview_url: null,
                original_url: null,
                extension: file.name.split('.').pop(),
                size: file.size,
            },
            client_preview: null,
            clientValidationErrors: [],
            upload: {
                uploadProgress: 0,
                hasFinishedUploading: false,
                hadErrorWhileUploading: false,
                errorMessage: null,
                cancelTokenSource,
            },
        };

        this.setClientPreview(uuid, file);
        this.addMediaObject(newMediaObject);

        const { success, error } = await this.upload(uuid, file, cancelTokenSource);

        if (!success) {
            this.removeMedia(uuid);
            this.addInvalidMedia(file, [error!]);
        }
    }

    private async setClientPreview(uuid: string, file: File) {
        const client_preview = await getMediaPreview(file, this.config.maxSizeForPreviewInBytes);

        this.setProperty(uuid, 'client_preview', client_preview);
    }

    private async getFileValidationErrors(file: File): Promise<Array<string>> {
        const validationErrors: Array<string> = [];

        if (this.config.validationRules) {
            if (!getFileTypeIsAllowed(file.type, this.config.validationRules.accept)) {
                validationErrors.push(
                    `${this.translations.fileTypeNotAllowed} ${this.config.validationRules.accept.join(', ')}`
                );
            }

            if (this.config.validationRules.maxSizeInKB && file.size / 1024 > this.config.validationRules.maxSizeInKB) {
                validationErrors.push(`${this.translations.tooLarge} ${this.config.validationRules.maxSizeInKB}KB`);
            }

            if (this.config.validationRules.minSizeInKB && file.size / 1024 < this.config.validationRules.minSizeInKB) {
                validationErrors.push(`${this.translations.tooSmall} ${this.config.validationRules.minSizeInKB}KB`);
            }
        }

        try {
            await Promise.resolve(this.config.beforeUpload(file, { axiosInstance: api }));
        } catch (error) {
            if (error) {
                validationErrors.push((error as any).message || error);
            }
        }

        return validationErrors;
    }

    private addMediaObject(newMediaObject: MediaLibrary.MediaObject) {
        this.changeState((state) => {
            state.media.push(newMediaObject);
        });
    }

    public removeMedia(uuid: string) {
        const index = findObjectIndexByUuid(this.state, uuid);

        if (index !== -1) {
            // If an upload is in progress for this object, cancel it.
            this.cancelUpload(uuid);

            this.changeState((state) => {
                state.media.splice(index, 1);
            });
        }
    }

    private cancelUpload(uuid: string) {
        const index = findObjectIndexByUuid(this.state, uuid);

        if (index !== -1) {
            const object = this.state.media[index];
            if (!object.upload.hasFinishedUploading && object.upload.cancelTokenSource) {
                object.upload.cancelTokenSource.cancel();
            }

            this.setProperty(uuid, 'upload', {
                uploadProgress: 0,
                hasFinishedUploading: true,
                hadErrorWhileUploading: false,
                errorMessage: null,
                cancelTokenSource: null,
            });
        }
    }

    public setProperty(uuid: string, key: MediaLibrary.MediaDotProperty, value: any) {
        const index = findObjectIndexByUuid(this.state, uuid);

        if (index !== -1) {
            this.changeState((state) => {
                set(state.media[index], key as any, value);
            });
        }
    }

    public setCustomProperty(uuid: string, key: string, value: any) {
        const index = findObjectIndexByUuid(this.state, uuid);

        this.changeState((state) => {
            state.media[index].attributes.custom_properties = {
                ...state.media[index].attributes.custom_properties,
                [key]: value,
            };
        });
    }

    public setOrder(uuids: ReadonlyArray<string>, sortArray: Boolean = true) {
        this.changeState((state) => {
            if (sortArray) {
                state.media.sort((a, b) =>
                    uuids.indexOf(a.attributes.uuid) > uuids.indexOf(b.attributes.uuid) ? 1 : -1
                );
            }

            state.media = state.media.map((object, i) => ({
                ...object,
                attributes: { ...object.attributes, order: i },
            }));
        });
    }

    private setClientValidationErrors(uuid: string, errors: Array<string>) {
        const index = findObjectIndexByUuid(this.state, uuid);

        if (index !== -1) {
            this.changeState((state) => {
                state.media[index].clientValidationErrors = errors;
            });
        }
    }

    public setValidationErrors(validationErrors: { [uuid: string]: Array<string> }): void {
        this.changeState((state) => {
            state.validationErrors = validationErrors;
        });
    }

    public getCustomPropertyInputErrors(uuid: string, propertyName: string): Array<string> {
        if (
            !this.state.validationErrors ||
            typeof this.state.validationErrors !== 'object' ||
            !Object.keys(this.state.validationErrors).length
        ) {
            return [];
        }

        return this.state.validationErrors[`${uuid}.custom_properties.${propertyName}`] || [];
    }

    public getNameInputErrors(uuid: string): Array<string> {
        if (!this.state.validationErrors) {
            return [];
        }

        return this.state.validationErrors[`${uuid}.name`] || [];
    }

    private upload(
        uuid: string,
        file: File,
        cancelTokenSource: CancelTokenSource
    ): Promise<{ success: boolean; error?: string }> {
        return new Promise((resolve) => {
            this.setProperty(uuid, 'upload.errorMessage', null);
            this.setProperty(uuid, 'upload.hasFinishedUploading', false);

            uploadFile({
                routePrefix: this.config.routePrefix,
                file,
                uuid,
                cancelTokenSource,
                vapor: this.config.vapor,
                vaporSignedStorageUrl: this.config.vaporSignedStorageUrl,
                uploadDomain: this.config.uploadDomain,
                withCredentials: this.config.withCredentials,
                headers: this.config.headers,
                onUploadProgress: (progress: ProgressEvent) => {
                    if (progress.total !== 0) {
                        this.setProperty(uuid, 'upload.uploadProgress', (progress.loaded / progress.total) * 100);
                    }
                },
            })
                .then((res) => {
                    let finalUuid = uuid;

                    if (this.config.vapor) {
                        finalUuid = res.data.uuid;
                        this.setProperty(uuid, 'attributes.uuid', finalUuid);
                    }

                    this.setProperty(finalUuid, 'attributes.preview_url', res.data.preview_url);
                    this.setProperty(finalUuid, 'attributes.original_url', res.data.original_url);
                    this.setProperty(finalUuid, 'attributes.size', res.data.size);
                    this.setProperty(finalUuid, 'attributes.extension', res.data.extension);

                    this.setProperty(finalUuid, 'upload', {
                        uploadProgress: 100,
                        hasFinishedUploading: true,
                        hadErrorWhileUploading: false,
                        errorMessage: null,
                    });

                    this.config.afterUpload({ success: true, uuid: finalUuid });

                    resolve({ success: true });
                })
                .catch((error) => {
                    if (error.__CANCEL__) {
                        return resolve({ success: true });
                    }

                    const errorMessage = error.message || this.translations.somethingWentWrong;

                    this.setProperty(uuid, 'upload', {
                        uploadProgress: 0,
                        hasFinishedUploading: true,
                        hadErrorWhileUploading: true,
                        errorMessage: errorMessage + ' - ' + this.translations.tryAgain,
                    });

                    this.config.afterUpload({ success: false, uuid });

                    resolve({ success: false, error: errorMessage });
                });
        });
    }

    public async replaceMedia(uuid: string, file: File) {
        this.setClientValidationErrors(uuid, []);

        const validationErrors = await this.getFileValidationErrors(file);

        if (validationErrors.length) {
            return this.setClientValidationErrors(uuid, validationErrors);
        }

        this.cancelUpload(uuid);

        const index = findObjectIndexByUuid(this.state, uuid);
        const oldObject = cloneDeep(this.state.media[index]);

        if (index === -1) {
            return;
        }

        const newUuid = uuidv4();
        const cancelTokenSource = getCancelTokenSource();

        // Because the uuid changes, we need to update the (backend) validation errors to use this new uuid.
        const newValidationErrors = Object.entries(this.state.validationErrors).reduce(
            (validationErrors, [key, value]) => {
                validationErrors[key.replace(uuid, newUuid)] = value;

                return validationErrors;
            },
            {} as MediaLibrary.ValidationErrors
        );

        this.changeState((state) => {
            state.media[index].attributes.uuid = newUuid;
            state.media[index].attributes.preview_url = null;
            state.media[index].attributes.size = file.size;
            state.media[index].attributes.extension = file.name.split('.').pop();
            state.media[index].client_preview = null;
            state.media[index].upload.cancelTokenSource = cancelTokenSource;
            state.validationErrors = newValidationErrors;
        });

        this.setClientPreview(newUuid, file);

        const { success } = await this.upload(newUuid, file, cancelTokenSource);

        if (!success) {
            // Reset the object to the old object, but don't overwrite the custom properties, in case those were edited during upload
            const index = findObjectIndexByUuid(this.state, newUuid);

            if (index === -1) {
                return;
            }

            this.changeState((state) => {
                state.media[index].attributes = {
                    ...oldObject.attributes,
                    order: state.media[index].attributes.order,
                    name: state.media[index].attributes.name,
                    custom_properties: state.media[index].attributes.custom_properties,
                };
                state.media[index].clientValidationErrors = oldObject.clientValidationErrors;
                state.media[index].client_preview = oldObject.client_preview;
                state.media[index].upload = {
                    ...oldObject.upload,
                    errorMessage: state.media[index].upload.errorMessage,
                };
            });
        }
    }
}
