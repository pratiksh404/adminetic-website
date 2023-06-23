<?php

namespace Spatie\MediaLibraryPro\Http\Components;

use Illuminate\View\Component;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibraryPro\WithAccessingMedia;

class MediaLibraryCollectionComponent extends Component
{
    use WithAccessingMedia;

    public string $name;
    public HasMedia $model;
    public string $collection;

    public string $rules;
    public ?int $maxItems;
    public bool $sortable;
    public bool $editableName = true;

    public array $media;

    public ?string $componentView;
    public ?string $listView;
    public ?string $itemView;
    public ?string $propertiesView;
    public ?string $fieldsView;

    public bool $multiple = true;

    public function __construct(
        string $name,
        HasMedia $model,
        string $collection = null,
        string $rules = '',
        ?int $maxItems = null,
        bool $sortable = true,
        bool $editableName = true,
        ?string $view = null,
        ?string $listView = null,
        ?string $itemView = null,
        ?string $propertiesView = null,
        ?string $fieldsView = null,
        bool $multiple = true
    ) {
        $this->name = $name;
        $this->model = $model;
        $this->collection = $collection ?? 'default';

        $this->rules = $rules;
        $this->maxItems = $maxItems;
        $this->editableName = $editableName;
        $this->sortable = $sortable;

        $this->media = $this->getMedia($name, $model, $this->collection);

        $this->componentView = $view;
        $this->listView = $listView ?? 'media-library::livewire.partials.collection.list';
        $this->itemView = $itemView ?? 'media-library::livewire.partials.collection.item';
        $this->propertiesView = $propertiesView ?? 'media-library::livewire.partials.collection.properties';
        $this->fieldsView = $fieldsView ?? 'media-library::livewire.partials.collection.fields';

        $this->multiple = $multiple;
    }

    public function render()
    {
        return view('media-library::components.media-library-collection');
    }
}
