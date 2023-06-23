import { MediaLibrary as MediaLibraryClass } from '@spatie/media-library-pro-core';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
import React from 'react';
declare type Params = {
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
    onChange?: (media: {
        [uuid: string]: MediaLibrary.MediaAttributes;
    }) => void;
};
export default function useMediaLibrary({ name, initialValue, validationErrors, routePrefix, validationRules, translations, multiple, maxItems, maxSizeForPreviewInBytes, vapor, vaporSignedStorageUrl, uploadDomain, withCredentials, headers, beforeUpload, afterUpload, onChange, }: Params): {
    mediaLibrary: MediaLibraryClass | null;
    state: MediaLibrary.State;
    hasUploadsInProgress: boolean;
    isReadyToSubmit: boolean;
    getImgProps: (object: MediaLibrary.MediaObject) => {
        src: string | undefined;
        alt: string;
        extension: string | undefined;
        size: number | undefined;
    };
    getNameInputProps: (object: MediaLibrary.MediaObject) => {
        value: any;
        onChange: (event: React.ChangeEvent<HTMLInputElement>) => void;
    };
    getNameInputErrors: (object: MediaLibrary.MediaObject) => Array<string>;
    getCustomPropertyInputProps: (object: MediaLibrary.MediaObject, propertyName: string) => {
        value: any;
        onChange: (event: React.ChangeEvent<HTMLInputElement>) => void;
    };
    getCustomPropertyInputErrors: (object: MediaLibrary.MediaObject, propertyName: string) => Array<string>;
    getFileInputProps: () => {
        onChange: (event: React.ChangeEvent<HTMLInputElement>) => void | Promise<void>;
        accept: string | undefined;
    };
    getDropZoneProps: () => {
        validationRules: Partial<{
            accept: string[];
            minSizeInKB: number;
            maxSizeInKB: number;
        }> | undefined;
        maxItems: number | undefined;
        onDrop: (event: React.DragEvent) => void;
    };
    addFile: (file: File) => Promise<void>;
    removeMedia: (object: MediaLibrary.MediaObject) => void;
    setOrder: (uuids: ReadonlyArray<MediaLibrary.MediaObject['attributes']['uuid']>) => void;
    setProperty: (object: MediaLibrary.MediaObject, key: Exclude<keyof MediaLibrary.MediaObject, 'custom_properties' | 'uuid'>, value: any) => void;
    setCustomProperty: (object: MediaLibrary.MediaObject, key: string, value: any) => void;
    replaceMedia: (object: MediaLibrary.MediaObject, file: File) => Promise<void>;
    getErrors: (object: MediaLibrary.MediaObject) => string[];
    clearObjectErrors: (object: MediaLibrary.MediaObject) => void;
    clearInvalidMedia: () => void;
};
export {};
