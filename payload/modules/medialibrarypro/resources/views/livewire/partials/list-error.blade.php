<div class="livewire-list-error {{ empty($listErrorMessage) ? 'media-library-hidden' : 'media-library-listerrors' }}">
    <ul>
        <li class="media-library-listerror">
            <div class="media-library-listerror-icon">
                    <span class="media-library-button media-library-button-error">
                        <x-media-library-icon icon="error"/>
                    </span>
            </div>
            <div class="media-library-listerror-content">
                <div class="media-library-listerror-title">
                    {{ $listErrorMessage }}
                </div>
            </div>
        </li>
    </ul>

    <div class="media-library-row-remove media-library-text-error" wire:click="clearListErrorMessage">
        <x-media-library-icon icon="remove"/>
    </div>
</div>
