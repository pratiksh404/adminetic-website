<?php

namespace Spatie\MediaLibraryPro\Http\Livewire;

use Illuminate\Support\Arr;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Livewire\Component;
use Spatie\MediaLibraryPro\Dto\ViewMediaItem;

class LivewireMediaLibraryComponent extends Component
{
    public $name;
    public $multiple;
    public $sortable;
    public $editableName;
    public $rules;
    public $maxItems = null;
    public $media;
    public $view;
    public $listView;
    public $itemView;
    public $propertiesView;
    public $fieldsView;
    public $listErrorMessage = null;
    protected $validationErrors = null;

    public function mount(
        string $name,
        bool $multiple,
        bool $sortable = true,
        bool $editableName = true,
        string $rules = '',
        ?int $maxItems = null,
        array $media = [],
        string $view = null,
        string $listView = null,
        string $itemView = null,
        string $propertiesView = null,
        string $fieldsView = null
    ) {
        $this->name = $name;
        $this->multiple = $multiple;
        $this->sortable = $sortable;
        $this->editableName = $editableName;

        $this->rules = $rules;
        $this->maxItems = $maxItems;

        $this->media = $media;

        $this->view = empty($view) ? 'media-library::livewire.media-library' : $view;
        $this->listView = $listView;
        $this->itemView = $itemView;
        $this->propertiesView = $propertiesView;
        $this->fieldsView = $fieldsView;

        $this->listErrorMessage = $this->determineListErrorMessage();
    }

    protected function getListeners()
    {
        return [
            "{$this->name}:fileAdded" => 'onFileAdded',
            "{$this->name}:uploadError" => 'onUploadError',
            "{$this->name}:showListErrorMessage" => 'onShowListErrorMessage',
            "{$this->name}:clearMedia" => 'onClearMedia',
            "{$this->name}:mediaComponentValidationErrors" => 'onMediaComponentValidationErrors',
        ];
    }

    public function onFileAdded(array $newMediaItem): void
    {
        if (! $this->allowsUpload($newMediaItem)) {
            return;
        }

        if (isset($this->media[$newMediaItem['oldUuid']])) {
            $existingMedia = $this->media[$newMediaItem['oldUuid']];
            $newMediaItem['order'] = $existingMedia['order'];

            unset($this->media[$newMediaItem['oldUuid']]);
        }

        $this->media[$newMediaItem['uuid']] = $newMediaItem;

        $this->media = collect($this->media)->sortBy('order')->toArray();

        $this->emit("{$this->name}:mediaChanged", $this->name, $this->media);
    }

    public function remove(string $uuid): void
    {
        $this->media = collect($this->media)
            ->reject(fn (array $mediaItem) => $mediaItem['uuid'] === $uuid)
            ->toArray();

        $this->emit("{$this->name}:mediaChanged", $this->name, $this->media);
    }

    public function allowsUpload(array $mediaItem): bool
    {
        if ($this->isReplacing($mediaItem)) {
            return true;
        }

        return $this->allowsUploads();
    }

    public function allowsUploads(): bool
    {
        if (is_null($this->maxItems)) {
            return true;
        }

        return (is_countable($this->media) ? count($this->media) : 0) < $this->maxItems;
    }

    public function isReplacing(array $newMediaItem): bool
    {
        if (! $newMediaItem['oldUuid']) {
            return false;
        }

        return collect($this->media)
            ->contains(fn (array $existingMediaItem): bool => $existingMediaItem['uuid'] === $newMediaItem['oldUuid']);
    }

    public function hideError(string $uuid)
    {
        if (! isset($this->media[$uuid])) {
            return;
        }

        $this->media[$uuid]['hideError'] = true;
    }

    public function determineListErrorMessage(MessageBag $viewErrorBag = null): ?string
    {
        if ($viewErrorBag) {
            return $viewErrorBag->first($this->name);
        }

        $errors = session()->get('errors');

        if (! $errors instanceof ViewErrorBag) {
            return null;
        }

        return $errors->first($this->name);
    }

    public function clearListErrorMessage()
    {
        $this->listErrorMessage = null;
    }

    public function onUploadError(string $uuid, string $uploadError)
    {
        if (! isset($this->media[$uuid])) {
            return;
        }

        $this->media[$uuid]['uploadError'] = $uploadError;
    }

    public function onShowListErrorMessage(string $message)
    {
        $this->listErrorMessage = $message;
    }

    public function onMediaComponentValidationErrors(string $componentName, array $validationErrors)
    {
        if ($componentName !== $this->name) {
            return;
        }

        $messageBag = new MessageBag($validationErrors);

        if ($messageBag->has($this->name)) {
            $this->onShowListErrorMessage($messageBag->first($this->name));
        } else {
            $this->listErrorMessage = null;
        }

        $this->validationErrors = $messageBag;
    }

    public function onClearMedia(string $componentName): void
    {
        if ($componentName !== $this->name) {
            return;
        }

        $this->media = [];
        $this->listErrorMessage = '';

        $this->emit("{$this->name}:mediaChanged", $this->name, $this->media);
    }

    public function setMediaProperty(string $uuid, string $attributeName, $value)
    {
        $this->media[$uuid][$attributeName] = $value;

        $this->emit("{$this->name}:mediaChanged", $this->name, $this->media);
    }

    public function setCustomProperty(string $uuid, string $customPropertyName, $value)
    {
        Arr::set($this->media, "{$uuid}.custom_properties.{$customPropertyName}", $value);

        $this->emit("{$this->name}:mediaChanged", $this->name, $this->media);
    }

    public function setNewOrder(array $newOrder)
    {
        foreach ($newOrder as $newOrderItem) {
            Arr::set($this->media, "{$newOrderItem['uuid']}.order", $newOrderItem['order']);
        }

        $this->media = collect($this->media)
            ->sortBy('order')
            ->toArray();

        $this->emit("{$this->name}:mediaChanged", $this->name, $this->media);
    }

    public function render()
    {
        return view($this->view, [
            'errors' => $this->validationErrors,
            'sortedMedia' => collect($this->media)
                ->map(fn (array $mediaItem) => new ViewMediaItem($this->name, $mediaItem))
                ->sortBy('order')
                ->values(),
        ]);
    }
}
