<div class="media-library-thumb" dusk="thumb">
    @if($mediaItem->previewUrl)
        <img
            class="media-library-thumb-img" src="{{ $mediaItem->previewUrl }}"
            alt="{{ $mediaItem->fileName }}">
    @else
        <span class="media-library-thumb-extension">
            <span
                class="media-library-thumb-extension-truncate">{{ $mediaItem->extension }}</span>
        </span>
    @endif

    <livewire:media-library-uploader
        :key="'thumb-uploader' . $mediaItem->uuid"
        :name="$this->name"
        :rules="$rules"
        :uuid="$mediaItem->uuid"
    />
</div>
