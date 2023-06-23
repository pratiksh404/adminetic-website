<div class="media-library-property">
    {{ $mediaItem->fileName }}
</div>

@if ($mediaItem->size)
    <div class="media-library-property">
        {{ \Spatie\MediaLibrary\Support\File::getHumanReadableSize($mediaItem->size) }}
    </div>
@endif

<div class="media-library-property">
    @include($fieldsView)
</div>
