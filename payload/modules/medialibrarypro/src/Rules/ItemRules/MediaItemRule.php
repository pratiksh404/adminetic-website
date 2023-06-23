<?php

namespace Spatie\MediaLibraryPro\Rules\ItemRules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

abstract class MediaItemRule implements Rule
{
    public $value;

    public function passes($attribute, $value)
    {
        $this->value = $value;

        return $this->validateMediaItem();
    }

    public function getTemporaryUploadMedia(): ?Media
    {
        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        $temporaryUpload = $temporaryUploadModelClass::findByMediaUuidInCurrentSession($this->value['uuid']);

        if (! $temporaryUpload) {
            return null;
        }

        return $temporaryUpload->getFirstMedia();
    }

    abstract public function validateMediaItem(): bool;
}
