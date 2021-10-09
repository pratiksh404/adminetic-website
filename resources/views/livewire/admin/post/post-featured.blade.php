<div>
    <i class="fa fa-star {{ $post->featured ? 'text-warning' : '' }}" style="cursor: pointer;font-size:2em"
        wire:click="$emitUp('featured_changed', {{ $post->id }})"></i>
</div>
