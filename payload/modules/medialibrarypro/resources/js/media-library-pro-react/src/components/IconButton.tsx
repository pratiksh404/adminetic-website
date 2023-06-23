import * as React from 'react';
import Icon from './Icon';

type Props = {
    icon: string;
    level?: string;
};

export default function IconButton({ icon, level = 'info' }: Props) {
    return (
        <span className={`media-library-button media-library-button-${level}`}>
            <Icon icon={icon} />
        </span>
    );
}
