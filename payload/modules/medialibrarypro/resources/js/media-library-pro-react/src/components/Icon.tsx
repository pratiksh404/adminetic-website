import * as React from 'react';

type Props = {
    icon: string;
    className?: string;
};

export default function Icon({ icon, className = '' }: Props) {
    return (
        <svg className={`media-library-icon ${className} `}>
            <use xlinkHref={`#icon-${icon}`}></use>
        </svg>
    );
}
