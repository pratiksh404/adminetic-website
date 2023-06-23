<div>
    <input
        data-uuid
        type="hidden"
        name="{{ $mediaItem->propertyAttributeName('uuid') }}"
        value="{{ $mediaItem->uuid }}"
    />

    <input
        type="hidden"
        name="{{ $mediaItem->propertyAttributeName('previewUrl') }}"
        value="{{ $mediaItem->previewUrl }}"
    />

    <input
        type="hidden"
        name="{{ $mediaItem->propertyAttributeName('fileName') }}"
        value="{{ $mediaItem->fileName }}"
    />

    <input
        type="hidden"
        name="{{ $mediaItem->propertyAttributeName('size') }}"
        value="{{ $mediaItem->size }}"
    />

    <input
        type="hidden"
        name="{{ $mediaItem->propertyAttributeName('order') }}"
        value="{{ $mediaItem->order ?? 0 }}"
        data-order
    />
</div>
