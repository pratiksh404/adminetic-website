<?php

namespace Spatie\MediaLibraryPro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\FileAdderFactory;
use Spatie\MediaLibraryPro\Dto\MediaLibraryRequestItem;
use Spatie\MediaLibraryPro\Dto\PendingMediaItem;

class PendingMediaLibraryRequestHandler
{
    protected Collection $mediaLibraryRequestItems;

    protected Model $model;

    protected bool $preserveExisting;

    protected ?array $processCustomProperties = null;

    protected ?array $customHeaders = null;

    public function __construct(array $mediaLibraryRequestItems, Model $model, bool $preserveExisting)
    {
        $this->mediaLibraryRequestItems = collect($mediaLibraryRequestItems)
            ->map(fn (array $properties) => MediaLibraryRequestItem::fromArray($properties));

        $this->model = $model;

        $this->preserveExisting = $preserveExisting;
    }

    public function usingName($mediaName): self
    {
        if (is_string($mediaName)) {
            return $this->usingName(fn () => $mediaName);
        }

        $callable = $mediaName;

        $this->mediaLibraryRequestItems->each(function (MediaLibraryRequestItem $mediaLibraryRequestItem) use ($callable) {
            $name = $callable($mediaLibraryRequestItem);

            $mediaLibraryRequestItem->name = $name;
        });

        return $this;
    }

    public function usingFileName($fileName): self
    {
        if (is_string($fileName)) {
            return $this->usingFileName(fn () => $fileName);
        }

        $callable = $fileName;

        $this->mediaLibraryRequestItems->each(function (MediaLibraryRequestItem $mediaLibraryRequestItem) use ($callable) {
            $fileName = $callable($mediaLibraryRequestItem);

            $mediaLibraryRequestItem->fileName = $fileName;
        });

        return $this;
    }

    public function withCustomProperties(...$customPropertyNames): self
    {
        $this->processCustomProperties = $customPropertyNames;

        return $this;
    }

    public function addCustomHeaders(array $customHeaders): self
    {
        $this->customHeaders = $customHeaders;

        return $this;
    }

    public function toMediaLibrary(string $collectionName = 'default', string $diskName = ''): void
    {
        $this->toMediaCollection($collectionName, $diskName);
    }

    public function toMediaCollection(string $collectionName = 'default', string $diskName = ''): void
    {
        $mediaLibraryRequestHandler = MediaLibraryRequestHandler::createForMediaLibraryRequestItems($this->model, $this->mediaLibraryRequestItems, $collectionName)
            ->updateExistingMedia();

        if (! $this->preserveExisting) {
            $mediaLibraryRequestHandler->deleteObsoleteMedia();
        }
        $mediaLibraryRequestHandler
            ->getPendingMediaItems()
            ->each(function (PendingMediaItem $pendingMedia) use ($diskName, $collectionName) {
                $fileAdder = app(FileAdderFactory::class)->createForPendingMedia($this->model, $pendingMedia);

                if (! is_null($this->processCustomProperties)) {
                    $fileAdder->withCustomProperties($pendingMedia->getCustomProperties($this->processCustomProperties));
                }

                if (! is_null($this->customHeaders)) {
                    $fileAdder = $fileAdder->addCustomHeaders($this->customHeaders);
                }

                if (! is_null($pendingMedia->fileName)) {
                    $fileAdder->setFileName($pendingMedia->fileName);
                }

                $fileAdder->toMediaCollection($collectionName, $diskName);
            });
    }
}
