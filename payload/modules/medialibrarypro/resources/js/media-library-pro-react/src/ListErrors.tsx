import * as React from 'react';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
import Icon from './components/Icon';

type Props = {
    invalidMedia: MediaLibrary.State['invalidMedia'];
    topLevelErrors?: Array<string>;
    onClear: () => void;
};

export default function ListErrors({ invalidMedia, topLevelErrors = [], onClear }: Props) {
    const groupedInvalidMedia = invalidMedia.reduce((groupedInvalidMedia, invalidMediaObject) => {
        const error = invalidMediaObject.errors[0];

        if (groupedInvalidMedia[error]) {
            groupedInvalidMedia[error].push(invalidMediaObject);
        } else {
            groupedInvalidMedia[error] = [invalidMediaObject];
        }

        return groupedInvalidMedia;
    }, {} as { [error: string]: MediaLibrary.State['invalidMedia'] });

    const [hideTopLevelErrors, setHideTopLevelErrors] = React.useState(false);

    React.useEffect(() => {
        setHideTopLevelErrors(false);
    }, [topLevelErrors]);

    if (!invalidMedia.length && (hideTopLevelErrors || !topLevelErrors.length)) {
        return null;
    }

    function handleClearClick() {
        setHideTopLevelErrors(true);
        onClear();
    }

    return (
        <div className="media-library-listerrors">
            <ul>
                {!hideTopLevelErrors && topLevelErrors.map((error, i) => <ListError title={error} key={i} />)}

                {Object.entries(groupedInvalidMedia).map(([error, invalidObjects], i) => (
                    <ListError title={error} key={i}>
                        {invalidObjects.map((object, i) => (
                            <li className="media-library-listerror-item" key={i}>
                                <div className="media-library-listerror-thumb">
                                    <ObjectPreview
                                        client_preview={object.client_preview || ''}
                                        name={object.attributes.name}
                                    />
                                </div>
                                <div className="media-library-listerror-text">{object.attributes.name}</div>
                            </li>
                        ))}
                    </ListError>
                ))}
            </ul>

            <div className="media-library-row-remove media-library-text-error" onClick={handleClearClick}>
                <Icon icon="remove" />
            </div>
        </div>
    );
}

type ListErrorProps = {
    title: string;
    children?: React.ReactNode;
};

function ListError({ title, children }: ListErrorProps) {
    return (
        <li className="media-library-listerror">
            <div className="media-library-listerror-icon">
                <span className="media-library-button media-library-button-error">
                    <Icon icon="error" />
                </span>
            </div>
            <div className="media-library-listerror-content">
                <div className="media-library-listerror-title">
                    <span>{title}</span>
                </div>

                {children && <ul className="media-library-listerror-items">{children}</ul>}
            </div>
        </li>
    );
}

type ObjectPreviewProps = {
    client_preview: string;
    name: string;
};

function ObjectPreview({ client_preview = '', name = '' }: ObjectPreviewProps) {
    const [imageErrored, setImageErrored] = React.useState(false);

    return imageErrored ? (
        <span className="media-library-thumb-extension">
            <span className="media-library-thumb-extension-truncate">{name.split('.').pop()}</span>
        </span>
    ) : (
        <img className="media-library-thumb-img" src={client_preview} onError={() => setImageErrored(true)} />
    );
}
