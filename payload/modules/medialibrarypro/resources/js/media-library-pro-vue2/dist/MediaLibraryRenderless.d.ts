import { MediaLibrary as MediaLibraryClass } from '@spatie/media-library-pro-core';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
import Vue from 'vue';
declare const _default: import("vue/types/vue").ExtendedVue<Vue, {
    state: MediaLibraryClass['state'];
    mediaLibrary: MediaLibraryClass;
}, {
    getImgProps(object: MediaLibrary.MediaObject): {
        src: string | null;
        alt: string;
        extension: string | undefined;
        size: number | undefined;
    };
    getCustomPropertyInputProps(object: MediaLibrary.MediaObject, propertyName: string): {
        value: any;
    };
    getCustomPropertyInputListeners(object: MediaLibrary.MediaObject, propertyName: string): {
        input: (event: Event) => void;
    };
    getCustomPropertyInputErrors(object: MediaLibrary.MediaObject, propertyName: string): string[];
    getNameInputProps(object: MediaLibrary.MediaObject): {
        value: any;
    };
    getNameInputListeners(object: MediaLibrary.MediaObject): {
        input: (event: Event) => void;
    };
    getNameInputErrors(object: MediaLibrary.MediaObject): string[];
    getFileInputProps(): {
        accept: string;
    };
    getFileInputListeners(): {
        changed: (event: Event) => void | Promise<void>;
    };
    getDropZoneProps(): {
        validationRules: Partial<{
            accept: string[];
            minSizeInKB: number;
            maxSizeInKB: number;
        }>;
        maxItems: number;
    };
    getDropZoneListeners(): {
        dropped: (event: DragEvent) => void;
    };
    addFiles(files: FileList): void | Promise<void>;
    removeMedia(object: MediaLibrary.MediaObject): void;
    setProperty(object: MediaLibrary.MediaObject, key: Exclude<keyof MediaLibrary.MediaObject, 'custom_properties' | 'uuid'>, value: any): void;
    setCustomProperty(object: MediaLibrary.MediaObject, key: string, value: any): void;
    setOrder(uuids: Array<string>): void;
    replaceMedia(object: MediaLibrary.MediaObject, file: File): void;
    addFile(file: File): void;
    getErrors(object: MediaLibrary.MediaObject): string[];
    clearObjectErrors(object: MediaLibrary.MediaObject): void;
    clearInvalidMedia(): void;
}, {
    hasUploadsInProgress: boolean;
    isReadyToSubmit: boolean;
}, {
    name: string;
    routePrefix: string;
    initialValue: readonly MediaLibrary.MediaAttributes[] | {
        [uuid: string]: MediaLibrary.MediaAttributes;
    } | undefined;
    validationErrors: any;
    validationRules: Partial<{
        accept: string[];
        minSizeInKB: number;
        maxSizeInKB: number;
    }>;
    translations: Partial<{
        fileTypeNotAllowed: string;
        tooLarge: string;
        tooSmall: string;
        tryAgain: string;
        somethingWentWrong: string;
        selectOrDragMax: string;
        selectOrDrag: string;
        file: {
            singular: string;
            plural: string;
        };
        anyImage: string;
        anyVideo: string;
        goBack: string;
        dropFile: string;
        dragHere: string;
        remove: string;
        name: string;
        download: string;
    }> | undefined;
    multiple: boolean;
    maxItems: number;
    maxSizeForPreviewInBytes: number;
    vapor: boolean;
    vaporSignedStorageUrl: string;
    uploadDomain: string;
    withCredentials: boolean;
    headers: any;
    beforeUpload: void | Function;
    afterUpload: void | Function;
}>;
export default _default;
