import * as React from 'react';
import { MediaLibrary } from '@spatie/media-library-pro-core/dist/types';
import { sanitizeForInput, getObjPaths } from '@spatie/media-library-pro-core';
import get from 'lodash/get';

type Props = {
    name: string;
    mediaState: MediaLibrary.State['media'];
};

export default function HiddenFields({ name, mediaState }: Props) {
    return (
        <>
            {mediaState.map((object) => {
                return getObjPaths(object.attributes).map((parameterName) => (
                    <input
                        key={parameterName}
                        name={`${name}[${object.attributes.uuid}]${parameterName}`}
                        defaultValue={sanitizeForInput(get(object.attributes, parameterName))}
                        type="hidden"
                    />
                ));
            })}
        </>
    );
}
