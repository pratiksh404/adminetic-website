@if (!isset($model) || $child->model == $model)
<option value="{{$child->id}}" {{isset($category->id) ? ($category->id == $child->id ? 'disabled' : '') : ''}}
    {{isset($category_id) ? ($category_id == $child->id ? 'selected' : '') : ''}}>
    @foreach(range(0, $parent_loop_index) as $loop_index)--@endforeach > {{$child->name}}</option>
@if ($child->categories)
<ul>
    @foreach ($child->categories as $childCategory)
    @php
    $child_loop_index = $parent_loop_index + 1
    @endphp
    @include('website::admin.layouts.modules.category.option_child_category', ['child' =>
    $childCategory,'parent_loop_index'
    => $child_loop_index])
    @endforeach
</ul>
@endif
@endif