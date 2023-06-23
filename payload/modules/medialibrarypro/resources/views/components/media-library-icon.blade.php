<svg class="media-library-icon {{ $attributes['class'] }}" {{ $attributes->except(['class', 'icon']) }}>
    <use xlink:href="#icon-{{ $attributes['icon'] }}"></use>
</svg>
