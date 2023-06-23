<?php

namespace Spatie\MediaLibraryPro\Rules\ItemRules;

use Spatie\MediaLibrary\Support\File;

class MinItemSizeInKbRule extends MediaItemRule
{
    protected int $minSizeInKb;

    protected int $actualSizeInBytes;

    public function __construct(int $minSizeInKb)
    {
        $this->minSizeInKb = $minSizeInKb;
    }

    public function validateMediaItem(): bool
    {
        if (! $media = $this->getTemporaryUploadMedia()) {
            return true;
        }

        $this->actualSizeInBytes = $media->size;

        return $this->actualSizeInBytes >= ($this->minSizeInKb * 1024);
    }

    public function message(): string
    {
        return __('media-library::validation.file_too_small', [
            'min' => File::getHumanReadableSize($this->minSizeInKb * 1024),
            'minInKb' => $this->minSizeInKb,
            'actual' => File::getHumanReadableSize($this->actualSizeInBytes),
            'actualInKb' => round($this->actualSizeInBytes / 1024),
        ]);
    }
}
