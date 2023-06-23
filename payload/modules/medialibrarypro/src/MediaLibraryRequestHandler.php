<?php

namespace Spatie\MediaLibraryPro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibraryPro\Dto\MediaLibraryRequestItem;
use Spatie\MediaLibraryPro\Dto\PendingMediaItem;

class MediaLibraryRequestHandler
{
    protected Model $model;

    protected array $existingUuids;

    protected Collection $mediaLibraryRequestItems;

    protected string $collectionName;

    public static function createForMediaLibraryRequestItems(
        Model $model,
        Collection $mediaLibraryRequestItems,
        string $collectionName
    ): self {
        return new static($model, $mediaLibraryRequestItems, $collectionName);
    }

    protected function __construct(Model $model, Collection $mediaLibraryRequestItems, string $collectionName)
    {
        $this->model = $model;

        $this->existingUuids = $this->model->getMedia($collectionName)->pluck('uuid')->toArray();

        $this->mediaLibraryRequestItems = $mediaLibraryRequestItems;

        $this->collectionName = $collectionName;
    }

    public function updateExistingMedia(): self
    {
        $this
            ->existingMediaLibraryRequestItems()
            ->each(function (MediaLibraryRequestItem $mediaResponseItem) {
                $this->handleExistingMediaLibraryRequestItem($mediaResponseItem);
            });

        return $this;
    }

    public function deleteObsoleteMedia(): self
    {
        $keepUuids = $this->mediaLibraryRequestItems->pluck('uuid')->toArray();

        $this->model->getMedia($this->collectionName)
            ->reject(fn (Media $media) => in_array($media->uuid, $keepUuids))
            ->each(fn (Media $media) => $media->delete());

        return $this;
    }

    public function getPendingMediaItems(): Collection
    {
        return $this
            ->newMediaLibraryRequestItems()
            ->map(function (MediaLibraryRequestItem $item) {
                return new PendingMediaItem(
                    $item->uuid,
                    $item->name,
                    $item->order,
                    $item->customProperties,
                    $item->customHeaders,
                    $item->fileName,
                );
            });
    }

    protected function existingMediaLibraryRequestItems(): Collection
    {
        return $this
            ->mediaLibraryRequestItems
            ->filter(fn (MediaLibraryRequestItem $item) => in_array($item->uuid, $this->existingUuids));
    }

    protected function newMediaLibraryRequestItems(): Collection
    {
        return $this
            ->mediaLibraryRequestItems
            ->reject(fn (MediaLibraryRequestItem $item) => in_array($item->uuid, $this->existingUuids));
    }

    protected function handleExistingMediaLibraryRequestItem(MediaLibraryRequestItem $mediaLibraryRequestItem): void
    {
        $mediaModelClass = config('media-library.media_model');

        $media = $mediaModelClass::findByUuid($mediaLibraryRequestItem->uuid);

        $media->update([
            'name' => $mediaLibraryRequestItem->name,
            'custom_properties' => $mediaLibraryRequestItem->customProperties,
            'order_column' => $mediaLibraryRequestItem->order,
        ]);
    }
}
