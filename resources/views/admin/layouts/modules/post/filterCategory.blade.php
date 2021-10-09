<option value="{{$child->id}}">
    @foreach(range(0, $parent_loop_index) as $loop_index)--@endforeach > {{$child->name}}</option>
@if ($child->categories)
<ul>
    @foreach ($child->categories as $childCategory)
    @php
    $child_loop_index = $parent_loop_index + 1
    @endphp
    @include('website::admin.layouts.modules.post.filterCategory', ['child' =>
    $childCategory,'parent_loop_index'
    => $child_loop_index])
    @endforeach
</ul>
@endif