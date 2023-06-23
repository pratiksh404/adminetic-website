@if (isset($category))
    <option value="{{ $category->id }}"
        {{ isset($category_id) ? ($category_id == $category->id ? 'selected' : '') : '' }}>
        {{ str_repeat('-', $dash ?? 0) . ' ' . $category->name }}
    </option>
    @if ($category->categories->count() > 0)
        @foreach ($category->categories as $child_category)
            @include('website::admin.layouts.modules.category.options', [
                'category' => $child_category,
                'dash' => ($dash ?? 0) + $loop->iteration,
                'category_id' => $category_id ?? null,
            ])
        @endforeach
    @endif
@endif
