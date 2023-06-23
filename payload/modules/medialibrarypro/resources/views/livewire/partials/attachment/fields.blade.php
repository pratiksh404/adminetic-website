<div @class(['media-library-field', 'media-library-hidden' => ! $editableName])>
    @if($editableName)
        <label class="media-library-label">{{ __("Name") }}</label>
        <input
            x-data
            dusk="media-library-field-name"
            class="media-library-input"
            type="text"
            name="{{ $mediaItem->propertyAttributeName('name') }}"
            value="{{ $mediaItem->name }}"
            x-on:keyup.debounce="$wire.setMediaProperty('{{ $mediaItem->uuid }}', 'name', document.getElementsByName('{{ $mediaItem->propertyAttributeName('name') }}')[0].value)"
        />
    @endif

    @error($mediaItem->propertyErrorName('name'))
        <p class="media-library-field-error">
               {{ $message }}
        </p>
    @enderror
</div>
