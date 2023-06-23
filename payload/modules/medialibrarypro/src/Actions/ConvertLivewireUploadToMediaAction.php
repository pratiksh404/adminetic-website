<?php

namespace Spatie\MediaLibraryPro\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Livewire\FileUploadConfiguration;
use Livewire\TemporaryUploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibraryPro\Models\TemporaryUpload;

class ConvertLivewireUploadToMediaAction
{
    public function execute(TemporaryUploadedFile $temporaryUploadedFile): Media
    {
        return $this->isLocalTemporaryDisk()
            ? $this->createFromLocalLivewireUpload($temporaryUploadedFile)
            : $this->createFromRemoteLivewireUpload($temporaryUploadedFile);
    }

    protected function isLocalTemporaryDisk(): bool
    {
        // See \Livewire\FileUploadConfiguration::isUsingS3()

        $diskBeforeTestFake = config('livewire.temporary_file_upload.disk') ?: config('filesystems.default');

        return config('filesystems.disks.'.strtolower($diskBeforeTestFake).'.driver') === 'local';
    }

    protected function createFromLocalLivewireUpload(TemporaryUploadedFile $livewireUpload): Media
    {
        $uploadedFile = new UploadedFile($livewireUpload->path(), $livewireUpload->getClientOriginalName());

        /** @var class-string<TemporaryUpload> $temporaryUploadModelClass */
        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        $temporaryUpload = $temporaryUploadModelClass::createForFile(
            $uploadedFile,
            session()->getId(),
            (string)Str::uuid(),
            $livewireUpload->getClientOriginalName()
        );

        return $temporaryUpload->getFirstMedia();
    }

    protected function createFromRemoteLivewireUpload(TemporaryUploadedFile $livewireUpload): Media
    {
        /** @var class-string<TemporaryUpload> $temporaryUploadModelClass */
        $temporaryUploadModelClass = config('media-library.temporary_upload_model');

        $livewireDisk = config('livewire.temporary_file_upload.disk', 's3');

        $livewireDirectory = FileUploadConfiguration::directory();
        $remotePath = Str::of($livewireDirectory)->start('/')->finish('/') . $livewireUpload->getFilename();

        $temporaryUpload = $temporaryUploadModelClass::createForRemoteFile(
            $remotePath,
            session()->getId(),
            (string) Str::uuid(),
            $livewireUpload->getClientOriginalName(),
            $livewireDisk
        );

        return $temporaryUpload->getFirstMedia();
    }
}
