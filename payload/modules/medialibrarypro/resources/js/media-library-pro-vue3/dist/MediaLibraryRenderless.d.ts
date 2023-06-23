import { MediaLibrary as MediaLibraryClass } from '@spatie/media-library-pro-core';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
import { PropType } from 'vue';
declare const _default: import("vue").DefineComponent<{
    name: {
        required: false;
        type: StringConstructor;
    };
    routePrefix: {
        required: false;
        type: PropType<string>;
    };
    initialValue: {
        default: () => never[];
        type: PropType<readonly MediaLibrary.MediaAttributes[] | {
            [uuid: string]: MediaLibrary.MediaAttributes;
        } | undefined>;
    };
    validationErrors: {
        default: () => {};
        type: PropType<MediaLibrary.ValidationErrors>;
    };
    validationRules: {
        required: false;
        type: PropType<Partial<{
            accept: string[];
            minSizeInKB: number;
            maxSizeInKB: number;
        }>>;
    };
    translations: {
        required: false;
        type: PropType<Partial<{
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
        }> | undefined>;
    };
    multiple: {
        default: boolean;
        type: BooleanConstructor;
    };
    maxItems: {
        required: false;
        type: NumberConstructor;
    };
    maxSizeForPreviewInBytes: {
        required: false;
        type: NumberConstructor;
    };
    vapor: {
        required: false;
        type: () => MediaLibrary.Config['vapor'];
    };
    vaporSignedStorageUrl: {
        required: false;
        type: StringConstructor;
    };
    uploadDomain: {
        required: false;
        type: StringConstructor;
    };
    withCredentials: {
        required: false;
        type: BooleanConstructor;
    };
    headers: {
        required: false;
        type: ObjectConstructor;
    };
    beforeUpload: {
        default: () => void;
        type: FunctionConstructor;
    };
    afterUpload: {
        default: () => void;
        type: FunctionConstructor;
    };
}, unknown, {
    state: MediaLibraryClass['state'];
    mediaLibrary: MediaLibraryClass;
}, {
    hasUploadsInProgress(): boolean;
    isReadyToSubmit(): boolean;
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
        }> | undefined;
        maxItems: number | undefined;
    };
    getDropZoneListeners(): {
        dropped: (event: DragEvent) => void | Promise<void>;
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
}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, ("changed" | "is-ready-to-submit-change" | "has-uploads-in-progress-change" | "isReadyToSubmitChange" | "hasUploadsInProgressChange")[], "changed" | "is-ready-to-submit-change" | "has-uploads-in-progress-change" | "isReadyToSubmitChange" | "hasUploadsInProgressChange", import("vue").VNodeProps & import("vue").AllowedComponentProps & import("vue").ComponentCustomProps, Readonly<{
    initialValue: readonly MediaLibrary.MediaAttributes[] | {
        [uuid: string]: MediaLibrary.MediaAttributes;
    } | undefined;
    validationErrors: MediaLibrary.ValidationErrors;
    multiple: boolean;
    withCredentials: boolean;
    beforeUpload: Function;
    afterUpload: Function;
} & {
    routePrefix?: string | undefined;
    validationRules?: Partial<{
        accept: string[];
        minSizeInKB: number;
        maxSizeInKB: number;
    }> | undefined;
    translations?: Partial<{
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
    name?: string | undefined;
    vapor?: boolean | undefined;
    maxItems?: number | undefined;
    maxSizeForPreviewInBytes?: number | undefined;
    vaporSignedStorageUrl?: string | undefined;
    uploadDomain?: string | undefined;
    headers?: Record<string, any> | undefined;
}>, {
    initialValue: readonly MediaLibrary.MediaAttributes[] | {
        [uuid: string]: MediaLibrary.MediaAttributes;
    } | undefined;
    validationErrors: MediaLibrary.ValidationErrors;
    multiple: boolean;
    withCredentials: boolean;
    beforeUpload: Function;
    afterUpload: Function;
}>;
export default _default;
