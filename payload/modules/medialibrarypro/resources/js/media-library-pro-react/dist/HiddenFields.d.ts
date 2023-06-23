/// <reference types="react" />
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
declare type Props = {
    name: string;
    mediaState: MediaLibrary.State['media'];
};
export default function HiddenFields({ name, mediaState }: Props): JSX.Element;
export {};
