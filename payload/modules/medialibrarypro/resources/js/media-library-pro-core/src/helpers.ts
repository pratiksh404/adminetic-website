import { MediaLibrary } from './types';

export function sanitizeForInput(value: any) {
    if (value === undefined || value === null) {
        return '';
    }

    return ['string', 'number'].includes(typeof value) ? value : JSON.stringify(value);
}

export function getObjPaths(obj: { [key: string]: any }, path = ''): Array<string> {
    return Object.keys(obj).reduce((paths, key) => {
        const newPath = path + `[${key}]`;

        if (typeof obj[key] === 'object' && obj[key] !== null) {
            return paths.concat(getObjPaths(obj[key], newPath));
        }

        return paths.concat(newPath);
    }, [] as Array<string>);
}

function cleanRule(rule: string) {
    const lowerCaseRule = rule.toLowerCase();

    if (lowerCaseRule === 'image/*') {
        return window.mediaLibraryTranslations.anyImage;
    }

    if (lowerCaseRule === 'video/*') {
        return window.mediaLibraryTranslations.anyVideo;
    }

    if (lowerCaseRule.startsWith('image/') || lowerCaseRule.startsWith('application/') || lowerCaseRule.startsWith('video/')) {
        return lowerCaseRule.replace('image/', '').replace('application/', '').replace('video/', '').toUpperCase();
    }

    return lowerCaseRule;
}

function addToRuleHelpText(ruleHelpText: string, newRule: string) {
    return `${ruleHelpText ? ruleHelpText + ' | ' : ''}${newRule}`;
}

export function parseTranslation(translationString: string, variables: { [key: string]: string | number }) {
    let translation = translationString;
    Object.entries(variables).forEach(([key, value]) => {
        translation = translation.replace(`{${key}}`, value.toString());
    });

    return translation;
}

export function buildRuleHelpText({
    validationRules = {},
    maxItems,
    fileTypeHelpText,
}: {
    validationRules?: Partial<MediaLibrary.Config['validationRules']>;
    maxItems?: number;
    fileTypeHelpText?: string;
}): string | undefined {
    const translations = window.mediaLibraryTranslations;

    let fileTypeRules = validationRules.accept;
    let fileSizeRules = { min: validationRules.minSizeInKB, max: validationRules.maxSizeInKB };

    let ruleHelpText = '';

    ruleHelpText = addToRuleHelpText(
        ruleHelpText,
        maxItems
            ? parseTranslation(translations.selectOrDragMax, {
                  maxItems,
                  file: maxItems > 1 ? translations.file.plural : translations.file.singular,
              })
            : translations.selectOrDrag
    );

    if (fileTypeRules && !fileTypeHelpText) {
        const amountOfRules = fileTypeRules.length;

        ruleHelpText = addToRuleHelpText(
            ruleHelpText,
            fileTypeRules.reduce((ruleHelpText, rule, i) => {
                const joiner = i === amountOfRules - 1 ? '' : ', ';

                ruleHelpText += cleanRule(rule) + joiner;

                return ruleHelpText;
            }, '')
        );
    }

    if (fileTypeHelpText) {
        ruleHelpText = addToRuleHelpText(ruleHelpText, fileTypeHelpText);
    }

    if (fileSizeRules.min) {
        const minSizeString =
            fileSizeRules.min > 1024 ? (fileSizeRules.min / 1024).toFixed(2) + 'MB' : fileSizeRules.min + 'KB';
        ruleHelpText = addToRuleHelpText(ruleHelpText, `> ${minSizeString}`);
    }

    if (fileSizeRules.max) {
        const maxSizeString =
            fileSizeRules.max > 1024 ? (fileSizeRules.max / 1024).toFixed(2) + 'MB' : fileSizeRules.max + 'KB';
        ruleHelpText = addToRuleHelpText(ruleHelpText, `< ${maxSizeString}`);
    }

    return ruleHelpText;
}
