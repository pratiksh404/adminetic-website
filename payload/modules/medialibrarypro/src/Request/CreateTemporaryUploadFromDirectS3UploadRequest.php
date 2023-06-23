<?php

namespace Spatie\MediaLibraryPro\Request;

use Illuminate\Foundation\Http\FormRequest;

class CreateTemporaryUploadFromDirectS3UploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => "unique:{$this->getDatabaseConnection()}{$this->getMediaTableName()}",
            'key' => 'required',
            'bucket' => 'required',
            'name' => 'required',
            'content_type' => 'required',
            'size' => 'required',
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
