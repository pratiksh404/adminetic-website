import { MediaLibrary } from './types';
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
    constructor(options: MediaLibrary.Options);
    private createMedia;
    get hasUploadsInProgress(): boolean;
    get hasValidationErrors(): boolean;
    get isReadyToSubmit(): boolean;
    get value(): ReadonlyArray<MediaLibrary.MediaAttributes>;
    getErrors(uuid: string): Array<string>;
    clearObjectErrors(uuid: string): void;
    changeState(callback: (state: MediaLibrary.State) => void): void;
    subscribe(subscriber: MediaLibrary.Subscriber): void;
    private addInvalidMedia;
    clearInvalidMedia(): void;
    addFile(file: File): Promise<void>;
    private setClientPreview;
    private getFileValidationErrors;
    private addMediaObject;
    removeMedia(uuid: string): void;
    private cancelUpload;
    setProperty(uuid: string, key: MediaLibrary.MediaDotProperty, value: any): void;
    setCustomProperty(uuid: string, key: string, value: any): void;
    setOrder(uuids: ReadonlyArray<string>, sortArray?: Boolean): void;
    private setClientValidationErrors;
    setValidationErrors(validationErrors: {
        [uuid: string]: Array<string>;
    }): void;
    getCustomPropertyInputErrors(uuid: string, propertyName: string): Array<string>;
    getNameInputErrors(uuid: string): Array<string>;
    private upload;
    replaceMedia(uuid: string, file: File): Promise<void>;
}
