<ul data-media-library-component-name="{{ $this->name }}" wire:key="ul-{{ $this->name }}"
    class="{{ $sortable ? 'media-library-dragula-container' : '' }} {{ count($sortedMedia) == 0 ? 'media-library-hidden' : 'media-library-items' }}">
    @foreach($sortedMedia as $mediaItem)
        @include($itemView)
    @endforeach
</ul>

<script>
    document.addEventListener('media-library-sorted-' + '{{ $this->name }}', () => {
        const source = document.querySelector('[data-media-library-component-name="{{ $this->name }}"]');

        const newOrder = [];
    
        source.querySelectorAll('[data-uuid]').forEach((el, i) =>  newOrder.push({uuid: el.value, order: i}));

        @this.setNewOrder(newOrder);
    })
</script>
