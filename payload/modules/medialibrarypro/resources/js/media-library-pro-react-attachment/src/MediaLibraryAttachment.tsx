import * as React from 'react';
import {
    useMediaLibrary,
    HiddenFields,
    Thumb,
    ListErrors,
    ItemErrors,
    Icons,
    Uploader,
} from '@spatie/media-library-pro-react';
import { MediaLibrary as MediaLibraryClass } from '@spatie/media-library-pro-core';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';

type Props = {
    name: string;
    initialValue?: MediaLibrary.Options['initialValue'];
    routePrefix?: string;
    translations?: MediaLibrary.Options['translations'];
    validationRules?: Partial<MediaLibraryClass['config']['validationRules']>;
    validationErrors?: { [key: string]: Array<string> } | Array<never>;
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
    onChange?: (media: { [uuid: string]: MediaLibrary.MediaAttributes }) => void;
    onIsReadyToSubmitChange?: (isReadyToSubmit: boolean) => void;
    propertiesView?: (helpers: { object: MediaLibrary.MediaObject }) => React.ReactNode;
    fieldsView?: (helpers: {
        object: MediaLibrary.MediaObject;
        getCustomPropertyInputProps: (
            propertyName: string
        ) => { value: any; onChange: (event: React.ChangeEvent<HTMLInputElement>) => void };
        getCustomPropertyInputErrors: (
            propertyName: string
        ) => ReturnType<MediaLibraryClass['getCustomPropertyInputErrors']>;

        getNameInputProps: () => {
            value: any;
            onChange: (event: React.ChangeEvent<HTMLInputElement>) => void;
        };
        getNameInputErrors: () => Array<string>;
    }) => React.ReactNode;
};

export default function MediaLibraryAttachment({
    name,
    initialValue = [],
    translations = {},
    validationRules,
    validationErrors = {},
    routePrefix,
    multiple = false,
    maxItems = multiple ? undefined : 1,
    maxSizeForPreviewInBytes,
    vapor,
    vaporSignedStorageUrl,
    uploadDomain,
    withCredentials,
    headers,
    fileTypeHelpText,
    setMediaLibrary,
    propertiesView = DefaultPropertiesView,
    fieldsView = DefaultFieldsView,
    beforeUpload = () => {},
    afterUpload = () => {},
    onChange = () => {},
    onIsReadyToSubmitChange = () => {},
}: Props) {
    const {
        mediaLibrary,
        state,
        getImgProps,
        getNameInputProps,
        getNameInputErrors,
        getCustomPropertyInputProps,
        getCustomPropertyInputErrors,
        getFileInputProps,
        getDropZoneProps,
        removeMedia,
        replaceMedia,
        getErrors,
        clearObjectErrors,
        clearInvalidMedia,
        isReadyToSubmit,
    } = useMediaLibrary({
        name,
        initialValue,
        validationErrors: Array.isArray(validationErrors) ? {} : validationErrors,
        routePrefix,
        validationRules,
        translations,
        multiple,
        maxItems,
        maxSizeForPreviewInBytes,
        vapor,
        vaporSignedStorageUrl,
        uploadDomain,
        withCredentials,
        headers,
        beforeUpload,
        afterUpload,
        onChange,
    });

    React.useEffect(() => {
        onIsReadyToSubmitChange(isReadyToSubmit);
    }, [isReadyToSubmit]);

    React.useEffect(() => {
        if (setMediaLibrary && mediaLibrary) {
            setMediaLibrary(mediaLibrary);
        }
    }, [setMediaLibrary, mediaLibrary]);

    return (
        <>
            <Icons />
            <div
                className={`media-library ${multiple ? 'media-library-multiple' : 'media-library-single'} ${
                    state.media.length == 0 ? 'media-library-empty' : 'media-library-filled'
                }`}
            >
                <ListErrors
                    invalidMedia={state.invalidMedia}
                    topLevelErrors={Array.isArray(validationErrors) ? undefined : validationErrors[name]}
                    onClear={clearInvalidMedia}
                ></ListErrors>

                {state.media?.length > 0 && (
                    <div className="media-library-items">
                        {state.media.map((object: MediaLibrary.MediaObject) => {
                            const objectErrors = getErrors(object);
                            return (
                                <div
                                    className="media-library-item"
                                    key={object.attributes.uuid}
                                    data-media-library-uuid={object.attributes.uuid}
                                >
                                    <Thumb
                                        uploadInfo={object.upload}
                                        validationRules={validationRules}
                                        imgProps={getImgProps(object)}
                                        onReplace={(file: File) => replaceMedia(object, file)}
                                    />

                                    <div className="media-library-properties">
                                        {!!objectErrors.length ? (
                                            <ItemErrors
                                                objectErrors={objectErrors}
                                                onBack={() => clearObjectErrors(object)}
                                            />
                                        ) : (
                                            <>
                                                {propertiesView({ object })}

                                                {fieldsView({
                                                    object,
                                                    getCustomPropertyInputProps: (propertyName: string) =>
                                                        getCustomPropertyInputProps(object, propertyName),
                                                    getCustomPropertyInputErrors: (propertyName: string) =>
                                                        getCustomPropertyInputErrors(object, propertyName),
                                                    getNameInputProps: () => getNameInputProps(object),
                                                    getNameInputErrors: () => getNameInputErrors(object),
                                                })}

                                                <div className="media-library-property">
                                                    <button
                                                        type="button"
                                                        className="media-library-text-link"
                                                        onClick={() => removeMedia(object)}
                                                        {...{ dusk: 'remove' }}
                                                    >
                                                        {window.mediaLibraryTranslations.remove}
                                                    </button>
                                                </div>
                                            </>
                                        )}
                                    </div>
                                </div>
                            );
                        })}
                    </div>
                )}

                <HiddenFields name={name} mediaState={state.media} />

                <div
                    className={
                        !maxItems || state.media.length < maxItems ? 'media-library-uploader' : 'media-library-hidden'
                    }
                >
                    <Uploader
                        multiple={multiple}
                        {...getDropZoneProps()}
                        {...getFileInputProps()}
                        add
                        fileTypeHelpText={fileTypeHelpText}
                    />
                </div>
            </div>
        </>
    );
}

function DefaultPropertiesView({ object }: { object: MediaLibrary.MediaObject }) {
    return (
        <>
            {object.attributes.extension && (
                <div className="media-library-property">{object.attributes.extension.toUpperCase()}</div>
            )}
            {object.attributes.size && (
                <div className="media-library-property">{(object.attributes.size / 1024).toFixed(2)} KB</div>
            )}
        </>
    );
}

type DefaultFieldsViewProps = {
    object: MediaLibrary.MediaObject;
    getNameInputProps: () => {
        value: any;
        onChange: (event: React.ChangeEvent<HTMLInputElement>) => void;
    };
    getNameInputErrors: () => Array<string>;
    getCustomPropertyInputProps: (
        propertyName: string
    ) => {
        value: any;
        onChange: (event: React.ChangeEvent<HTMLInputElement>) => void;
    };
    getCustomPropertyInputErrors: (propertyName: string) => Array<string>;
};

function DefaultFieldsView({}: DefaultFieldsViewProps) {
    return null;
}
