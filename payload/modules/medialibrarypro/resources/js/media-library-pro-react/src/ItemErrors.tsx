import * as React from 'react';

type Props = {
    objectErrors: string[];
    onBack?: (e: React.MouseEvent) => void;
};

export default function ItemErrors({ objectErrors, onBack }: Props) {
    return (
        <>
            {objectErrors.length > 0 && (
                <div className="media-library-properties">
                    <span className="media-library-text-error">
                        {objectErrors.map((error) => (
                            <span key={error}>{error}</span>
                        ))}
                    </span>
                    <a
                        className="media-library-text-link media-library-text-error media-library-help-clear"
                        onClick={onBack}
                    >
                        {window.mediaLibraryTranslations.goBack}
                    </a>
                </div>
            )}
        </>
    );
}
