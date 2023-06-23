/// <reference types="react" />
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
declare type Props = {
    uploadInfo: MediaLibrary.MediaObject['upload'];
    validationRules?: Partial<MediaLibrary.Config['validationRules']>;
    imgProps: {
        src: string | undefined;
        alt: string;
        extension: string | undefined;
    };
    onReplace: (file: File) => void;
};
export default function Thumb({ uploadInfo, validationRules, imgProps, onReplace, ...props }: Props): JSX.Element;
export {};
