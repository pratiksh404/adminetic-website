import * as React from 'react';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
import Uploader from './Uploader';

type Props = {
    uploadInfo: MediaLibrary.MediaObject['upload'];
    validationRules?: Partial<MediaLibrary.Config['validationRules']>;
    imgProps: {
        src: string | undefined;
        alt: string;
        extension: string | undefined;
    };
    onReplace: (file: File) => void;
};

export default function Thumb({ uploadInfo, validationRules, imgProps, onReplace, ...props }: Props) {
    const [imageErrored, setImageErrored] = React.useState(false);

    const oldImgSrc = React.useRef(imgProps.src);

    React.useEffect(() => {
        if (oldImgSrc.current != imgProps.src) {
            setImageErrored(false);
        }
    }, [imgProps.src]);

    return (
        <>
            <div className="media-library-thumb" {...{ dusk: 'thumb' }}>
                {!!imgProps.src && !imageErrored ? (
                    <img className="media-library-thumb-img" onError={() => setImageErrored(true)} {...imgProps} />
                ) : (
                    <span className="media-library-thumb-extension">
                        <span className="media-library-thumb-extension-truncate">{imgProps.extension}</span>
                    </span>
                )}
                <Uploader
                    validationRules={validationRules}
                    onDrop={(event: React.DragEvent) => onReplace(event.dataTransfer.files[0])}
                    onChange={(event: React.ChangeEvent<HTMLInputElement>) =>
                        onReplace((event.target.files as FileList)[0])
                    }
                    add={false}
                    multiple={false}
                    uploadInfo={uploadInfo}
                    {...props}
                />
            </div>
        </>
    );
}
