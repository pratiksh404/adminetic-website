import * as React from 'react';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
declare type Props = {
    validationAccept?: MediaLibrary.Config['validationRules']['accept'];
    children: ({ hasDragObject, isDropTarget, }: {
        hasDragObject: boolean;
        isDropTarget: boolean;
        isValid: boolean;
    }) => React.ReactNode;
    onDrop: (event: React.DragEvent<HTMLDivElement>) => void;
} & React.DetailedHTMLProps<React.HTMLAttributes<HTMLDivElement>, HTMLDivElement>;
export default function DropZone({ validationAccept, children, onDrop, ...props }: Props): JSX.Element;
export {};
