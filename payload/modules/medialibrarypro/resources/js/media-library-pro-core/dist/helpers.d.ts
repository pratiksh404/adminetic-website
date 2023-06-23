import { MediaLibrary } from './types';
export declare function sanitizeForInput(value: any): any;
export declare function getObjPaths(obj: {
    [key: string]: any;
}, path?: string): Array<string>;
export declare function parseTranslation(translationString: string, variables: {
    [key: string]: string | number;
}): string;
export declare function buildRuleHelpText({ validationRules, maxItems, fileTypeHelpText, }: {
    validationRules?: Partial<MediaLibrary.Config['validationRules']>;
    maxItems?: number;
    fileTypeHelpText?: string;
}): string | undefined;
