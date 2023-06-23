/// <reference types="react" />
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
declare type Props = {
    invalidMedia: MediaLibrary.State['invalidMedia'];
    topLevelErrors?: Array<string>;
    onClear: () => void;
};
export default function ListErrors({ invalidMedia, topLevelErrors, onClear }: Props): JSX.Element | null;
export {};
