<div class="{{ count($sortedMedia) == 0 ? 'media-library-hidden' : 'media-library-items' }}">
    @foreach($sortedMedia as $mediaItem)
        @include($itemView)
    @endforeach
</div>
