import * as React from 'react';
import { getFileTypeIsAllowed } from '@spatie/media-library-pro-core';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';

type Props = {
    validationAccept?: MediaLibrary.Config['validationRules']['accept'];
    children: ({
        hasDragObject,
        isDropTarget,
    }: {
        hasDragObject: boolean;
        isDropTarget: boolean;
        isValid: boolean;
    }) => React.ReactNode;
    onDrop: (event: React.DragEvent<HTMLDivElement>) => void;
} & React.DetailedHTMLProps<React.HTMLAttributes<HTMLDivElement>, HTMLDivElement>;

export default function DropZone({ validationAccept, children, onDrop, ...props }: Props) {
    const dropZoneRef = React.useRef<null | HTMLDivElement>(null);

    const [hasDragObject, setHasDragObject] = React.useState(false);
    const [isDropTarget, setIsDropTarget] = React.useState(false);
    const [isValid, setIsValid] = React.useState(true);

    const dragCounter = React.useRef(0);

    function handleDocumentDragenter(e: DragEvent) {
        e.preventDefault();

        dragCounter.current++;

        testIfValid(e);

        setHasDragObject(true);
    }

    function handleDocumentDragleave(e: DragEvent) {
        e.preventDefault();

        dragCounter.current--;

        if (dragCounter.current === 0) {
            setHasDragObject(false);
        }
    }

    function handleDocumentDrop(e: DragEvent) {
        e.preventDefault();

        dragCounter.current = 0;

        setHasDragObject(false);
    }

    function handleDocumentDragOver(e: DragEvent) {
        e.preventDefault();

        const overElement = dropZoneRef.current?.contains(e.target as any);

        if (!overElement) {
            return setIsDropTarget(false);
        }

        setIsDropTarget(true);
    }

    function handleDrop(e: React.DragEvent<HTMLDivElement>) {
        e.preventDefault();

        if (e.dataTransfer.files.length) {
            onDrop(e);
        }

        dragCounter.current = 0;

        setHasDragObject(false);
        setIsDropTarget(false);
    }

    React.useEffect(() => {
        document.addEventListener('dragenter', handleDocumentDragenter);
        document.addEventListener('dragleave', handleDocumentDragleave);
        document.addEventListener('dragover', handleDocumentDragOver);
        document.addEventListener('drop', handleDocumentDrop);

        return () => {
            document.removeEventListener('dragenter', handleDocumentDragenter);
            document.removeEventListener('dragleave', handleDocumentDragleave);
            document.removeEventListener('dragover', handleDocumentDragOver);
            document.removeEventListener('drop', handleDocumentDrop);
        };
    }, []);

    function testIfValid(e: DragEvent) {
        if (!e.dataTransfer) {
            return;
        }

        if (!e.dataTransfer.items || !e.dataTransfer.items.length) {
            return setIsValid(true);
        }

        if (!validationAccept || !validationAccept.length) {
            return setIsValid(true);
        }

        setIsValid(
            Array.from(e.dataTransfer.items).every((item) => {
                return getFileTypeIsAllowed(item.type, validationAccept);
            })
        );
    }

    return (
        <div ref={dropZoneRef} onDrop={handleDrop} {...props}>
            {children({ hasDragObject, isDropTarget, isValid })}
        </div>
    );
}
