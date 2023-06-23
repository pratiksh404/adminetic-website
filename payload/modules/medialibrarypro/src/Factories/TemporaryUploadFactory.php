<?php

namespace Spatie\MediaLibraryPro\Factories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\MediaLibraryPro\Models\TemporaryUpload;

class TemporaryUploadFactory
{
    private int $fakeImageWidth = 10;
    private int $fakeImageHeight = 10;

    public static function new(): self
    {
        return new static;
    }

    public function useFakeImageDimensions(int $fakeImageWidth, int $fakeImageHeight): self
    {
        $this->fakeImageWidth = $fakeImageWidth;

        $this->fakeImageHeight = $fakeImageHeight;

        return $this;
    }

    public function create(array $attributes = []): TemporaryUpload
    {
        $fakeUpload = UploadedFile::fake()->image('test.jpg', $this->fakeImageWidth, $this->fakeImageHeight);

        return TemporaryUpload::createForFile(
            $fakeUpload,
            session()->getId(),
            $attributes['uuid'] ?? Str::uuid(),
            $attributes['name'] ?? 'name',
        );
    }

    public function createMultiple(int $count, array $attributes = []): array
    {
        return Collection::times($count)
            ->map(fn () => $this->create($attributes))->toArray();
    }
}
