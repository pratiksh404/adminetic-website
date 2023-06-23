<li class="media-library-item media-library-item-row" wire:key="item-{{ $mediaItem->uuid }}">
    @if($sortable)
        <div class="dragula-handle media-library-row-drag">
            <x-media-library-icon icon="drag" />
        </div>
    @endif

    @include('media-library::livewire.partials.thumb')
        @if((! $mediaItem->hideError) && ($mediaItem->uploadError || $errors->has($mediaItem->errorName())))
        <div class="media-library-properties">
            @include('media-library::livewire.partials.item-error', ['message' => $mediaItem->uploadError ?? $errors->first($mediaItem->errorName())])
        </div>
    @else
        @include($propertiesView)
    @endif


    <div dusk="remove" class="media-library-row-remove" wire:click="remove('{{ $mediaItem->uuid }}')">
        <x-media-library-icon icon="remove" />
    </div>

    @include('media-library::livewire.partials.hidden-fields')
</li>
