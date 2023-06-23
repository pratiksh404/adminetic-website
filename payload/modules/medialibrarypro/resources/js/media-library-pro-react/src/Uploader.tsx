import * as React from 'react';
import DropZone from './DropZone';
import IconButton from './components/IconButton';
import { buildRuleHelpText } from '@spatie/media-library-pro-core';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';

type Props = {
    add?: boolean;
    uploadInfo?: MediaLibrary.MediaObject['upload'];
    multiple: boolean;
    validationRules?: Partial<MediaLibrary.Config['validationRules']>;
    maxItems?: number;
    fileTypeHelpText?: string;
    onDrop: (event: React.DragEvent<HTMLDivElement>) => void;
    onChange: (event: React.ChangeEvent<HTMLInputElement>) => void;
};

export default function Uploader({
    add = true,
    uploadInfo,
    multiple = false,
    validationRules,
    maxItems,
    fileTypeHelpText,
    onDrop,
    onChange,
    ...props
}: Props) {
    const fileInputRef = React.useRef<HTMLInputElement>(null);

    function handleChange(event: React.ChangeEvent<HTMLInputElement>) {
        onChange(event);

        if (fileInputRef.current) {
            fileInputRef.current.value = '';
        }
    }

    return (
        <DropZone
            validationAccept={validationRules?.accept}
            onDrop={onDrop}
            {...props}
            className={add ? 'media-library-add' : 'media-library-replace'}
            onClick={() => fileInputRef.current?.click()}
        >
            {({ hasDragObject, isDropTarget, isValid }) => (
                <>
                    <button
                        type="button"
                        className={`media-library-dropzone
                                    ${hasDragObject && !isDropTarget ? 'media-library-dropzone-drag' : ''}
                                    ${hasDragObject && isDropTarget ? 'media-library-dropzone-drop' : ''}
                                    ${add ? 'media-library-dropzone-add' : 'media-library-dropzone-replace'}
                                    ${!isValid && hasDragObject ? 'disabled' : ''}
                                `}
                    >
                        <input
                            type="file"
                            accept={validationRules?.accept?.join(',')}
                            className="media-library-hidden"
                            ref={fileInputRef}
                            multiple={multiple}
                            onChange={handleChange}
                            {...{ dusk: add ? 'main-uploader' : 'uploader' }}
                        />

                        <div className="media-library-placeholder">
                            {isValid || !hasDragObject ? (
                                <IconButton level="info" icon={add ? 'add' : 'replace'} />
                            ) : (
                                <IconButton level="warning" icon="not-allowed" />
                            )}

                            {uploadInfo && (
                                <div
                                    className={`media-library-progress-wrap ${
                                        uploadInfo.hasFinishedUploading ? '' : 'media-library-progress-wrap-loading'
                                    }`}
                                >
                                    <progress
                                        max={100}
                                        value={uploadInfo.uploadProgress}
                                        className="media-library-progress"
                                    />
                                </div>
                            )}
                        </div>

                        {add && (
                            <div className="media-library-help">
                                {isValid && hasDragObject ? (
                                    isDropTarget ? (
                                        <span>{window.mediaLibraryTranslations.dropFile}</span>
                                    ) : (
                                        <span>{window.mediaLibraryTranslations.dragHere}</span>
                                    )
                                ) : (
                                    <span>{buildRuleHelpText({ validationRules, maxItems, fileTypeHelpText })}</span>
                                )}
                            </div>
                        )}
                    </button>
                </>
            )}
        </DropZone>
    );
}
