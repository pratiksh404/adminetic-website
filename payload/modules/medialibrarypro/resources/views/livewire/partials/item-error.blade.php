@if($message && isset($mediaItem))
    <span class="media-library-text-error">
        {{ $message }}
    </span>
    <a wire:click="hideError('{{ $mediaItem->uuid }}')" class="media-library-text-link media-library-text-error media-library-help-clear">{{ __('Go back') }}</a>
@endif
