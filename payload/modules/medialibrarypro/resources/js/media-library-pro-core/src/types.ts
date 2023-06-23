import { AxiosInstance, CancelTokenSource } from 'axios';
import { defaultTranslations } from './translations';

export namespace MediaLibrary {
    export type MediaObject = {
        attributes: MediaAttributes;
        client_preview: null | string;
        clientValidationErrors: Array<string>;
        upload: {
            uploadProgress: number;
            hasFinishedUploading: boolean;
            hadErrorWhileUploading: boolean;
            errorMessage: null | string;
            cancelTokenSource: null | CancelTokenSource;
        };
    };

    export type InvalidMediaObject = {
        attributes: {
            name: string;
        };
        client_preview: null | string;
        errors: Array<string>;
    };

    export type MediaAttributes = {
        uuid: string;
        order: number;
        name: string;
        custom_properties: { [key: string]: any };
        preview_url: null | string;
        original_url: null | string;
        extension?: string;
        size?: number;
    };

    export type MediaDotProperty =
        | 'attributes'
        | 'attributes.uuid'
        | 'attributes.order'
        | 'attributes.name'
        | 'attributes.custom_properties'
        | 'attributes.preview_url'
        | 'attributes.original_url'
        | 'attributes.size'
        | 'attributes.extension'
        | 'client_preview'
        | 'clientValidationErrors'
        | 'upload'
        | 'upload.uploadProgress'
        | 'upload.hasFinishedUploading'
        | 'upload.hadErrorWhileUploading'
        | 'upload.errorMessage'
        | 'upload.cancelTokenSource';

    export type State = {
        media: Array<MediaObject>;
        invalidMedia: Array<InvalidMediaObject>;
        validationErrors: MediaLibrary.ValidationErrors;
    };

    export type Subscriber = (newState: State) => void;

    export type Config = {
        immutable: boolean;
        routePrefix: string;
        validationRules: {
            accept: Array<string>;
            minSizeInKB: number;
            maxSizeInKB: number;
        };
        maxSizeForPreviewInBytes: number;
        vapor: boolean;
        vaporSignedStorageUrl: string;
        uploadDomain: string;
        withCredentials: boolean;
        headers: Record<string, string>;
        beforeUpload: (file: File, options: { axiosInstance: AxiosInstance }) => Promise<void> | void;
        afterUpload: ({ success, uuid }: { success: boolean; uuid: string }) => void;
    };

    export type Options = {
        config: Partial<Omit<Config, 'validationRules'> & { validationRules: Partial<Config['validationRules']> }>;
        translations?: Partial<typeof defaultTranslations>;
        initialValue?: ReadonlyArray<MediaLibrary.MediaAttributes> | { [uuid: string]: MediaLibrary.MediaAttributes };
        validationErrors?: ValidationErrors;
    };

    export type ValidationErrors = { [key: string]: Array<string> };

    export type Translations = typeof defaultTranslations;
}
