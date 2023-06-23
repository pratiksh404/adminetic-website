<?php

namespace Spatie\MediaLibraryPro\Rules\ItemRules;

use Spatie\MediaLibrary\Support\File;

class MaxItemSizeInKbRule extends MediaItemRule
{
    protected int $maxSizeInKb;

    protected int $actualSizeInBytes;

    public function __construct(int $maxSizeInKb)
    {
        $this->maxSizeInKb = $maxSizeInKb;
    }

    public function validateMediaItem(): bool
    {
        if (! $media = $this->getTemporaryUploadMedia()) {
            return true;
        }

        $this->actualSizeInBytes = $media->size;

        return $this->actualSizeInBytes <= ($this->maxSizeInKb * 1024);
    }

    public function message()
    {
        return __('media-library::validation.file_too_big', [
            'max' => File::getHumanReadableSize($this->maxSizeInKb * 1024),
            'maxInKb' => $this->maxSizeInKb,
            'actual' => File::getHumanReadableSize($this->actualSizeInBytes),
            'actualInKb' => round($this->actualSizeInBytes / 1024),
        ]);
    }
}
