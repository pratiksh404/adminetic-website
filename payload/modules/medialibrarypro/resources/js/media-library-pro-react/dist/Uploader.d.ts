import * as React from 'react';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
declare type Props = {
    add?: boolean;
    uploadInfo?: MediaLibrary.MediaObject['upload'];
    multiple: boolean;
    validationRules?: Partial<MediaLibrary.Config['validationRules']>;
    maxItems?: number;
    fileTypeHelpText?: string;
    onDrop: (event: React.DragEvent<HTMLDivElement>) => void;
    onChange: (event: React.ChangeEvent<HTMLInputElement>) => void;
};
export default function Uploader({ add, uploadInfo, multiple, validationRules, maxItems, fileTypeHelpText, onDrop, onChange, ...props }: Props): JSX.Element;
export {};
