import { default as MediaLibraryClass } from './MediaLibrary';
import { MediaLibrary } from './types';
export declare function getMediaPreview(file: File, maxSizeForPreviewInBytes: number): Promise<string | null>;
export declare function getFileTypeIsAllowed(fileType: string, accept: MediaLibraryClass['config']['validationRules']['accept']): boolean;
/**
 * Simple object check.
 * @param item
 * @returns {boolean}
 */
export declare function isObject(item: any): boolean;
/**
 * Deep merge two objects.
 * @param target
 * @param ...sources
 */
export declare function mergeDeep<TObject extends {
    [key: string]: any;
}, TSource extends {
    [key: string]: any;
}>(target: TObject, source: TSource): TObject & TSource;
export declare function formatLaravelErrors(name: string, errors: MediaLibrary.ValidationErrors): MediaLibrary.ValidationErrors;
