<?php

namespace Spatie\MediaLibraryPro\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibraryPro\Models\TemporaryUpload;
use Spatie\MediaLibraryPro\Request\UploadRequest;
use Throwable;

class MediaLibraryUploadController
{
    public function __invoke(UploadRequest $request)
    {
        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        try {
            $temporaryUpload = $temporaryUploadModelClass::createForFile(
                $request->file,
                session()->getId(),
                $request->uuid,
                $request->name ?? '',
            );
        } catch (Throwable $exception) {
            $temporaryUploadModelClass::query()
                ->where('session_id', session()->getId())
                ->get()->each->delete();

            report($exception);

            throw ValidationException::withMessages(['file' => 'Could not handle upload. Make sure you are uploading a valid file.']);
        }

        /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $media */
        $media = $temporaryUpload->getFirstMedia();

        return response()->json($this->responseFields($media, $temporaryUpload));
    }

    protected function responseFields(Media $media, TemporaryUpload $temporaryUpload): array
    {
        return [
            'uuid' => $media->uuid,
            'name' => $media->name,
            'preview_url' => config('media-library.generate_thumbnails_for_temporary_uploads')
                ? $temporaryUpload->getFirstMediaUrl('default', 'preview')
                : '',
            'size' => $media->size,
            'mime_type' => $media->mime_type,
            'extension' => $media->extension,
        ];
    }
}
