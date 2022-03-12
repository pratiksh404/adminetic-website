<li>@foreach(range(0, $parent_loop_index) as $loop_index)--@endforeach > <span
        class="text-muted">{{ $child->name }}</span></li>
@if($child->categories)
<ul>
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