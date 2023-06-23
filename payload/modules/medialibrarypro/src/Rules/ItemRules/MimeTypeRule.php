<?php

namespace Spatie\MediaLibraryPro\Rules\ItemRules;

use Illuminate\Support\Arr;

class MimeTypeRule extends MediaItemRule
{
    protected array $allowedMimeTypes;

    /** @var string|array */
    public function __construct($allowedMimeTypes)
    {
        $this->allowedMimeTypes = Arr::wrap($allowedMimeTypes);
    }

    public function validateMediaItem(): bool
    {
        if (! $media = $this->getTemporaryUploadMedia()) {
            return true;
        }

        return in_array($media->mime_type, $this->allowedMimeTypes);
    }

    public function message(): string
    {
        return __('media-library::validation.mime', [
            'mimes' => implode(', ', $this->allowedMimeTypes),
        ]);
    }
}
