<?php

namespace Spatie\MediaLibraryPro\Request;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\MediaLibraryPro\Rules\FileExtensionRule;
use Spatie\MediaLibraryPro\Support\DefaultAllowedExtensions;

class UploadRequest extends FormRequest
{
    public function rules(): array
    {
        $configuredAllowedExtensions = config('media-library.temporary_uploads_allowed_extensions');

        $allowedExtensions = $configuredAllowedExtensions ?? DefaultAllowedExtensions::all();

        $allowedExtensionsString = implode(',', $allowedExtensions);

        return [
            'uuid' => "unique:{$this->getDatabaseConnection()}{$this->getMediaTableName()}",
            'name' => '',
            'custom_properties' => '',
            'file' => [
                'max:' . config('media-library.max_file_size') / 1024,
                "mimes:" . $allowedExtensionsString,
                new FileExtensionRule($allowedExtensions),
            ],
        ];
    }

    protected function getDatabaseConnection(): string
    {
        $mediaModelClass = config('media-library.media_model');

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $mediaModel */
        $mediaModel = new $mediaModelClass;

        if ($mediaModel->getConnectionName() === 'default') {
            return '';
        }

        return "{$mediaModel->getConnectionName()}.";
    }

    protected function getMediaTableName(): string
    {
        $mediaModelClass = config('media-library.media_model');

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $mediaModel */
        $mediaModel = new $mediaModelClass;

        return $mediaModel->getTable();
    }

    public function messages()
    {
        return [
            'uuid.unique' => trans('medialibrary-pro::upload_request.uuid_not_unique'),
        ];
    }
}
