<?php

namespace Spatie\MediaLibraryPro\Rules\ItemRules;

class DimensionsRule extends MediaItemRule
{
    public function __construct(
        protected int $requiredWidth = 0,
        protected int $requiredHeight = 0
    ) {
    }

    public function validateMediaItem(): bool
    {
        if (! $media = $this->getTemporaryUploadMedia()) {
            return true;
        }

        $size = getimagesize($media->getPath());
        $actualWidth = $size[0];
        $actualHeight = $size[1];

        if ($this->requiredWidth && $this->requiredHeight) {
            return $actualWidth === $this->requiredWidth && $actualHeight === $this->requiredHeight;
        }

        if ($this->requiredWidth) {
            return $actualWidth === $this->requiredWidth;
        }

        if ($this->requiredHeight) {
            return $actualHeight === $this->requiredHeight;
        }

        return false;
    }

    public function message()
    {
        $params = [
            'width' => $this->requiredWidth,
            'height' => $this->requiredHeight,
        ];

        if ($this->requiredWidth && $this->requiredHeight) {
            return __('media-library::validation.incorrect_dimensions.both', $params);
        }

        if ($this->requiredWidth) {
            return __('media-library::validation.incorrect_dimensions.width', $params);
        }

        if ($this->requiredHeight) {
            return __('media-library::validation.incorrect_dimensions.height', $params);
        }
    }
}
