<div>
    @isset($parentCategories)
    <div wire:sortable="updateParentCategories" wire:sortable-group="updateParentCategories">
        @foreach ($parentCategories as $parent_category)
        @if (!isset($parent_category->category_id))
        <div wire:key="group-{{ $parent_category->id }}" wire:sortable.item="{{ $parent_category->id }}"
            style="border: 2px solid rgba(0, 0, 0, 0.466);width:100%" class="m-2 p-2">

            <div class="d-flex justify-content-between">
                <span class="text-bold" wire:sortable.handle>{{ $parent_category->name }}</span>
                @if (isset($parent_category->categories))
                @if ($parent_category->categories->count() > 0)
                <a href="{{route('categoryChildrenReorder',['category'=> $parent_category->id])}}"
                    class="btn btn-primary btn-sm"><i class="fa fa-list-ul"></i></a>
                @endif
                @endif
            </div>

            @isset($parent_category->childrenCategories)
            <ul wire:sortable-group.item-group="{{ $parent_category->id }}">
                @php
                $parent_loop_index = $loop->index + 1;
                @endphp
                @foreach ($parent_category->childrenCategories->sortBy('position') as $child)
                @include('website::admin.layouts.modules.category.livewire_child_category', ['category_id' =>
                $parent_category->id,'child' => $child,'parent_loop_index'
                => $parent_loop_index])
                @endforeach
            </ul>
            @endisset
        </div>
        <br>
        @endif
        @endforeach
    </div>
    @endisset
</div>

@push('livewire_third_party')
<script>
    Livewire.on('reorderingComplete', function() {
                    var notify_allow_dismiss = Boolean(
                        {{ config('adminetic.notify_allow_dismiss', true) }});
                    var notify_delay = {{ config('adminetic.notify_delay', 2000) }};
                    var notify_showProgressbar = Boolean(
                        {{ config('adminetic.notify_showProgressbar', true) }});
                    var notify_timer = {{ config('adminetic.notify_timer', 300) }};
                    var notify_newest_on_top = Boolean(
                        {{ config('adminetic.notify_newest_on_top', true) }});
                    var notify_mouse_over = Boolean(
                        {{ config('adminetic.notify_mouse_over', true) }});
                    var notify_spacing = {{ config('adminetic.notify_spacing', 1) }};
                    var notify_notify_animate_in =
                        "{{ config('adminetic.notify_animate_in', 'animated fadeInDown') }}";
                    var notify_notify_animate_out =
                        "{{ config('adminetic.notify_animate_out', 'animated fadeOutUp') }}";
                    var notify = $.notify({
                        title: "<i class='{{ config('adminetic.notify_icon', 'fa fa-bell-o') }}'></i> " +
                            "Success",
                        message: "Category Reorderd !"
                    }, {
                        type: 'success',
                        allow_dismiss: notify_allow_dismiss,
                        delay: notify_delay,
                        showProgressbar: notify_showProgressbar,
                        timer: notify_timer,
                        newest_on_top: notify_newest_on_top,
                        mouse_over: notify_mouse_over,
                        spacing: notify_spacing,
                        animate: {
                            enter: notify_notify_animate_in,
                            exit: notify_notify_animate_out
                        }
                    });
                });
</script>
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js">
</script>
@endpush
</div>