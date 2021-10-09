<div>
    <div class="btn-group p-1" role="group">
        <button class="btn btn-{{ $post->statusColor() }} btn-air-{{ $post->statusColor() }} dropdown-toggle"
            id="{{$post->id}}Status" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false"><i class="fa fa-sort-desc"></i>
            {{ $post->status }}</button>
        <div class="dropdown-menu" aria-labelledby="{{$post->id}}Status">
            <button class="dropdown-item" wire:click="$emitUp('status_changed',1, {{ $post->id }})"
                style="cursor: pointer">Draft</button>
            <button class="dropdown-item" wire:click="$emitUp('status_changed',2, {{ $post->id }})"
                style="cursor: pointer">Pending</button>
            <button class="dropdown-item" wire:click="$emitUp('status_changed',3, {{ $post->id }})"
                style="cursor: pointer">Published</button>
        </div>
    </div>
</div>