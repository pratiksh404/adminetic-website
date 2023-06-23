import { default as MediaLibraryClass } from './MediaLibrary';
import { MediaLibrary } from './types';

export function getMediaPreview(file: File, maxSizeForPreviewInBytes: number): Promise<string | null> {
    return new Promise((resolve) => {
        if (file.size > maxSizeForPreviewInBytes) {
            // Don't generate previews for very big files, this slows down the application significantly.
            return resolve(null);
        }

        const reader = new FileReader();

        reader.onload = (e) => {
            resolve(e.target!.result as string);
        };

        reader.onerror = () => {
            resolve(null);
        };

        try {
            reader.readAsDataURL(file);
        } catch (error) {
            resolve(null);
        }
    });
}

export function getFileTypeIsAllowed(
    fileType: string,
    accept: MediaLibraryClass['config']['validationRules']['accept']
) {
    if (!accept.length) {
        return true;
    }

    if (accept.includes(fileType)) {
        return true;
    }

    if (accept.some((acceptType) => acceptType.endsWith('*') && fileType.includes(acceptType.replace('*', '')))) {
        return true;
    }

    return false;
}

// source: https://stackoverflow.com/a/34749873/6374824
/**
 * Simple object check.
 * @param item
 * @returns {boolean}
 */
export function isObject(item: any) {
    return item && typeof item === 'object' && !Array.isArray(item);
}

/**
 * Deep merge two objects.
 * @param target
 * @param ...sources
 */
export function mergeDeep<TObject extends { [key: string]: any }, TSource extends { [key: string]: any }>(
    target: TObject,
    source: TSource
): TObject & TSource {
    if (isObject(target) && isObject(source)) {
        for (const key in source) {
            if (isObject(source[key])) {
                if (!target[key]) Object.assign(target, { [key]: {} });
                mergeDeep(target[key], source[key]);
            } else {
                if (source[key] !== undefined) {
                    Object.assign(target, { [key]: source[key] });
                }
            }
        }
    }

    return target as TObject & TSource;
}

export function formatLaravelErrors(
    name: string,
    errors: MediaLibrary.ValidationErrors
): MediaLibrary.ValidationErrors {
    const prefix = `${name}.`;

    return Object.entries(errors).reduce((validationErrors, [key, errors]) => {
        if (key.startsWith(prefix)) {
            const newKey = key.replace(prefix, '');
            validationErrors[newKey] = errors;
        }

        return validationErrors;
    }, {} as MediaLibrary.ValidationErrors);
}
