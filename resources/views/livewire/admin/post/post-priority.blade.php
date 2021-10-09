<div>
    <input type="number" name="priority" class="form-control" value="{{ $priority ?? 1 }}"
        wire:change="$emitUp('priority_changed',{{ $post->id }})" wire:model="priority">
</div>
