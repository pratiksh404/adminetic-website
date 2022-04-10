<li wire:key="child-{{ $child->id }}" wire:sortable-group.item="{{ $child->id }}">
    <div class="d-flex justify-content-between">
        <div>
            @foreach(range(0, $parent_loop_index) as $loop_index)--@endforeach > <span class="text-muted">{{
                $child->name }}</span>
        </div>
    </div>
</li>
@if($child->categories)
<ul wire:sortable-group.item-group="{{$child->id }}">
    @foreach ($child->categories->sortBy('position') as $childCategory)
    @php
    $child_loop_index = $parent_loop_index + 1
    @endphp
    @include('website::admin.layouts.modules.category.livewire_child_category', ['category_id' =>
    $child->id,'child' => $childCategory,'parent_loop_index'
    => $child_loop_index])
    @endforeach
</ul>
@endif