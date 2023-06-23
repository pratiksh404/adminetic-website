<?php

namespace Spatie\MediaLibraryPro\Http\Components;

use Illuminate\View\Component;

class MediaLibraryAttachmentComponent extends Component
{
    public array $media;

    public ?string $propertiesView = null;

    public function __construct(
        public string $name,
        public string $rules = '',
        public $multiple = false,
        public $editableName = false,
        public ?int $maxItems = null,
        public ?string $componentView = null,
        public ?string $listView = null,
        public ?string $itemView = null,
        ?string $propertiesView = null,
        public ?string $fieldsView = null
    ) {
        $this->media = old($name) ?? [];
        $this->propertiesView = $propertiesView ?? 'media-library::livewire.partials.attachment.properties';
    }

    public function render()
    {
        return view('media-library::components.media-library-attachment');
    }

    public function determineListViewName(): string
    {
        if (! is_null($this->listView)) {
            return $this->listView;
        }

        return 'media-library::livewire.partials.attachment.list';
    }

    public function determineItemViewName(): string
    {
        if (! is_null($this->itemView)) {
            return $this->itemView;
        }

        return 'media-library::livewire.partials.attachment.item';
    }

    public function determineFieldsViewName(): string
    {
        if (! is_null($this->fieldsView)) {
            return $this->fieldsView;
        }

        return 'media-library::livewire.partials.attachment.fields';
    }

    public function determineMaxItems(): ?int
    {
        return $this->multiple
            ? $this->maxItems
            : 1;
    }
}
