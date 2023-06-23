<div class="media-library-properties media-library-properties-fixed">
    <div class="media-library-property">
        {{ strtoupper($mediaItem->extension) }}
    </div>
    @if ($mediaItem->size)
        <div class="media-library-property">
            {{ \Spatie\MediaLibrary\Support\File::getHumanReadableSize($mediaItem->size) }}
        </div>
    @endif
    <div class="media-library-property">
        <a href="{{ $mediaItem->downloadUrl() }}" download class="media-library-text-link">{{ __('Download') }}</a>
    </div>
</div>

<div class="media-library-properties">
    @include($fieldsView)
</div>
