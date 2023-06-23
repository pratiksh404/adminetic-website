import * as React from 'react';
import { MediaLibrary as MediaLibraryClass } from '@spatie/media-library-pro-core';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
declare type Props = {
    name: string;
    initialValue?: MediaLibrary.Options['initialValue'];
    routePrefix?: string;
    translations?: MediaLibrary.Options['translations'];
    validationRules?: Partial<MediaLibraryClass['config']['validationRules']>;
    validationErrors?: {
        [key: string]: Array<string>;
    } | Array<never>;
    multiple?: boolean;
    maxItems?: number;
    maxSizeForPreviewInBytes?: number;
    vapor?: MediaLibrary.Config['vapor'];
    vaporSignedStorageUrl?: MediaLibrary.Config['vaporSignedStorageUrl'];
    uploadDomain?: MediaLibrary.Config['uploadDomain'];
    withCredentials?: MediaLibrary.Config['withCredentials'];
    headers?: MediaLibrary.Config['headers'];
    fileTypeHelpText?: string;
    setMediaLibrary?: (mediaLibrary: MediaLibraryClass) => void;
    beforeUpload?: MediaLibraryClass['config']['beforeUpload'];
    afterUpload?: MediaLibraryClass['config']['afterUpload'];
    onChange?: (media: {
        [uuid: string]: MediaLibrary.MediaAttributes;
    }) => void;
    onIsReadyToSubmitChange?: (isReadyToSubmit: boolean) => void;
    propertiesView?: (helpers: {
        object: MediaLibrary.MediaObject;
    }) => React.ReactNode;
    fieldsView?: (helpers: {
        object: MediaLibrary.MediaObject;
        getCustomPropertyInputProps: (propertyName: string) => {
            value: any;
            onChange: (event: React.ChangeEvent<HTMLInputElement>) => void;
        };
        getCustomPropertyInputErrors: (propertyName: string) => ReturnType<MediaLibraryClass['getCustomPropertyInputErrors']>;
        getNameInputProps: () => {
            value: any;
            onChange: (event: React.ChangeEvent<HTMLInputElement>) => void;
        };
        getNameInputErrors: () => Array<string>;
    }) => React.ReactNode;
};
export default function MediaLibraryAttachment({ name, initialValue, translations, validationRules, validationErrors, routePrefix, multiple, maxItems, maxSizeForPreviewInBytes, vapor, vaporSignedStorageUrl, uploadDomain, withCredentials, headers, fileTypeHelpText, setMediaLibrary, propertiesView, fieldsView, beforeUpload, afterUpload, onChange, onIsReadyToSubmitChange, }: Props): JSX.Element;
export {};
