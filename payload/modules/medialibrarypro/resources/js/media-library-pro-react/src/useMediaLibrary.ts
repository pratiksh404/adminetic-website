import {
    MediaLibrary as MediaLibraryClass,
    sanitizeForInput,
    formatLaravelErrors,
} from '@spatie/media-library-pro-core';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
import get from 'lodash/get';
import React, { useEffect, useRef } from 'react';
import { isEqual } from 'lodash';

type Params = {
    name?: string;
    initialValue?: MediaLibrary.Options['initialValue'];
    validationErrors?: MediaLibrary.ValidationErrors;
    routePrefix?: MediaLibrary.Config['routePrefix'];
    validationRules?: Partial<MediaLibrary.Config['validationRules']>;
    translations?: MediaLibrary.Options['translations'];
    multiple?: Boolean;
    maxItems?: number;
    maxSizeForPreviewInBytes?: number;
    vapor?: MediaLibrary.Config['vapor'];
    vaporSignedStorageUrl?: MediaLibrary.Config['vaporSignedStorageUrl'];
    uploadDomain?: MediaLibrary.Config['uploadDomain'];
    withCredentials?: MediaLibrary.Config['withCredentials'];
    headers?: MediaLibrary.Config['headers'];
    beforeUpload?: MediaLibrary.Config['beforeUpload'];
    afterUpload?: MediaLibrary.Config['afterUpload'];
    onChange?: (media: { [uuid: string]: MediaLibrary.MediaAttributes }) => void;
};

export default function useMediaLibrary({
    name,
    initialValue,
    validationErrors = {},
    routePrefix,
    validationRules,
    translations,
    multiple = true,
    maxItems,
    maxSizeForPreviewInBytes,
    vapor,
    vaporSignedStorageUrl,
    uploadDomain,
    withCredentials,
    headers,
    beforeUpload = () => {},
    afterUpload = () => {},
    onChange = () => {},
}: Params) {
    const mediaLibrary = React.useRef<MediaLibraryClass | null>(null);

    const [state, setState] = React.useState(() => {
        mediaLibrary.current = new MediaLibraryClass({
            initialValue,
            config: {
                immutable: true,
                routePrefix,
                validationRules,
                maxSizeForPreviewInBytes,
                vapor,
                vaporSignedStorageUrl,
                uploadDomain,
                withCredentials,
                headers,
                beforeUpload,
                afterUpload,
            },
            translations,
        });

        registerOnChangeSubscriber();

        return mediaLibrary.current!.state;
    });

    function registerOnChangeSubscriber() {
        if (!mediaLibrary.current) {
            return;
        }

        mediaLibrary.current.subscribers = [];

        mediaLibrary.current.subscribe((newState: MediaLibrary.State) => {
            setState(newState);
            onChange(
                newState.media.reduce((value, media) => {
                    value[media.attributes.uuid] = media.attributes;
                    return value;
                }, {} as { [uuid: string]: MediaLibrary.MediaAttributes })
            );
        });
    }

    useEffect(() => {
        registerOnChangeSubscriber();
    }, [onChange]);

    useEffect(() => {
        mediaLibrary.current!.config.afterUpload = afterUpload;
    }, [afterUpload]);
    useEffect(() => {
        mediaLibrary.current!.config.beforeUpload = beforeUpload;
    }, [beforeUpload]);

    const oldValidationErrors = useRef<MediaLibrary.ValidationErrors | null>(validationErrors);

    useEffect(() => {
        if (!name || !mediaLibrary.current) {
            return;
        }

        if (isEqual(oldValidationErrors.current, validationErrors)) {
            return;
        }

        oldValidationErrors.current = validationErrors;

        mediaLibrary.current.setValidationErrors(validationErrors ? formatLaravelErrors(name, validationErrors) : {});
    }, [validationErrors]);

    function getImgProps(object: MediaLibrary.MediaObject) {
        return {
            src: object.attributes.preview_url || object.client_preview || undefined,
            alt: object.attributes.name,
            extension: object.attributes.extension,
            size: object.attributes.size,
        };
    }

    function getNameInputProps(object: MediaLibrary.MediaObject) {
        return {
            value: sanitizeForInput(get(object, 'attributes.name')),
            onChange: (event: React.ChangeEvent<HTMLInputElement>) =>
                mediaLibrary.current!.setProperty(object.attributes.uuid, 'attributes.name', event.target.value),
        };
    }

    function getNameInputErrors(object: MediaLibrary.MediaObject): Array<string> {
        return mediaLibrary.current!.getNameInputErrors(object.attributes.uuid);
    }

    function getCustomPropertyInputProps(object: MediaLibrary.MediaObject, propertyName: string) {
        return {
            value: sanitizeForInput(get(object.attributes.custom_properties, propertyName)),
            onChange: (event: React.ChangeEvent<HTMLInputElement>) =>
                mediaLibrary.current!.setCustomProperty(object.attributes.uuid, propertyName, event.target.value),
        };
    }

    function getCustomPropertyInputErrors(object: MediaLibrary.MediaObject, propertyName: string): Array<string> {
        return mediaLibrary.current!.getCustomPropertyInputErrors(object.attributes.uuid, propertyName);
    }

    function getFileInputProps() {
        return {
            onChange: (event: React.ChangeEvent<HTMLInputElement>) => addFiles(event.target.files!),
            accept: validationRules?.accept?.join(','),
        };
    }

    function getDropZoneProps() {
        return {
            validationRules,
            maxItems,
            onDrop: (event: React.DragEvent) => {
                addFiles(event.dataTransfer.files);
            },
        };
    }

    function addFiles(files: FileList) {
        if (multiple) {
            const end = maxItems ? maxItems - mediaLibrary.current!.state.media.length : undefined;

            return Array.from(files)
                .slice(0, end)
                .forEach((file) => mediaLibrary.current!.addFile(file));
        }

        const file = files[0];

        const existingItem = mediaLibrary.current!.state.media[0];
        if (existingItem) {
            return mediaLibrary.current!.replaceMedia(existingItem.attributes.uuid, file);
        }

        mediaLibrary.current!.addFile(file);
    }

    return {
        mediaLibrary: mediaLibrary.current,
        state: state,
        hasUploadsInProgress: mediaLibrary.current!.hasUploadsInProgress,
        isReadyToSubmit: mediaLibrary.current!.isReadyToSubmit,
        getImgProps,
        getNameInputProps,
        getNameInputErrors,
        getCustomPropertyInputProps,
        getCustomPropertyInputErrors,
        getFileInputProps,
        getDropZoneProps,
        addFile: (file: File) => mediaLibrary.current!.addFile(file),
        removeMedia: (object: MediaLibrary.MediaObject) => mediaLibrary.current!.removeMedia(object.attributes.uuid),
        setOrder: (uuids: ReadonlyArray<MediaLibrary.MediaObject['attributes']['uuid']>) =>
            mediaLibrary.current!.setOrder(uuids),
        setProperty: (
            object: MediaLibrary.MediaObject,
            key: Exclude<keyof MediaLibrary.MediaObject, 'custom_properties' | 'uuid'>,
            value: any
        ) => mediaLibrary.current!.setProperty(object.attributes.uuid, key, value),
        setCustomProperty: (object: MediaLibrary.MediaObject, key: string, value: any) =>
            mediaLibrary.current!.setCustomProperty(object.attributes.uuid, key, value),
        replaceMedia: (object: MediaLibrary.MediaObject, file: File) =>
            mediaLibrary.current!.replaceMedia(object.attributes.uuid, file),
        getErrors: (object: MediaLibrary.MediaObject) => mediaLibrary.current!.getErrors(object.attributes.uuid),
        clearObjectErrors: (object: MediaLibrary.MediaObject) =>
            mediaLibrary.current!.clearObjectErrors(object.attributes.uuid),
        clearInvalidMedia: () => mediaLibrary.current!.clearInvalidMedia(),
    };
}
