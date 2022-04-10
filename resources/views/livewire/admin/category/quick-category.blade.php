<div>
    <label for="category">Category</label>
    <div class="input-group">
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".create-quick-category"><i
                class="fa fa-plus"></i></button>
        <select name="parent_id" id="category_id" class="form-control">
            <option selected disabled>Select Category</option>
            @isset($parentcategories)
            @foreach ($parentcategories as $parent_category)
            @if ($parent_category->model == ($model ?? null))
            @if (!isset($parent_category->category_id))
            <option value="{{ $parent_category->id }}" {{isset($category->id) ? ($category->id == $parent_category->id ?
                'disabled' : '') : ''}}
                {{isset($category_id) ? ($category_id == $parent_category->id ? 'selected' : '') : ''}}>
                {{ $parent_category->name }}</option>
            @isset($parent_category->childrenCategories)
            @php
            $parent_loop_index = $loop->index + 1;
            @endphp
            @foreach ($parent_category->childrenCategories as $child)
            @include('website::admin.layouts.modules.category.option_child_category', ['child' =>
            $child,'parent_loop_index'
            => $parent_loop_index,'model' => $model ?? null])
            @endforeach
            @endisset
            @endif
            @endif
            @endforeach
            @endisset
        </select>
    </div>

    {{-- MODAL --}}
    <div wire:ignore.self class="modal fade create-quick-category" id="quick_category" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Create Category</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="name">Category Name</label></label>
                            <div class="input-group">
                                <input type="text" wire:model.defer="name" id="name" class="form-control"
                                    placeholder="Category Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="name">Category Parent</label></label>
                            <div class="input-group">
                                <select wire:model.defer="categoryid" class="form-control" id="categoryid"
                                    style="width: 100%">
                                    <option value="">Select Parent ... </option>
                                    @isset($parentcategories)
                                    @foreach ($parentcategories as $parent_category)
                                    @if ($parent_category->model == ($model ?? null))
                                    @if (!isset($parent_category->category_id))
                                    <option value="{{ $parent_category->id }}" {{isset($category->id) ? ($category->id
                                        == $parent_category->id ? 'disabled' : '') : ''}}>
                                        {{ $parent_category->name }}</option>
                                    @isset($parent_category->childrenCategories)
                                    @php
                                    $parent_loop_index = $loop->index + 1;
                                    @endphp
                                    @foreach ($parent_category->childrenCategories as $child)
                                    @include('website::admin.layouts.modules.category.option_child_category', ['child'
                                    =>
                                    $child,'parent_loop_index'
                                    => $parent_loop_index,'model' => $model ?? null])
                                    @endforeach
                                    @endisset
                                    @endif
                                    @endif
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <button type="button" wire:click="submit" class="btn btn-primary btn-air-primary">Create</button>
                </div>
            </div>
        </div>
    </div>

    @push('livewire_third_party')
    <script>
        $(function() {
                window.livewire.on('quick_category_created', () => $('#quick_category').modal('toggle'));
                      Livewire.on('quick_category_created', function() {
                            var notify_allow_dismiss = Boolean({{ config('adminetic.notify_allow_dismiss', true) }});
                            var notify_delay = {{ config('adminetic.notify_delay', 2000) }};
                            var notify_showProgressbar = Boolean({{ config('adminetic.notify_showProgressbar', true) }});
                            var notify_timer = {{ config('adminetic.notify_timer', 300) }};
                            var notify_newest_on_top = Boolean({{ config('adminetic.notify_newest_on_top', true) }});
                            var notify_mouse_over = Boolean({{ config('adminetic.notify_mouse_over', true) }});
                            var notify_spacing = {{ config('adminetic.notify_spacing', 1) }};
                            var notify_notify_animate_in = "{{ config('adminetic.notify_animate_in', 'animated fadeInDown') }}";
                            var notify_notify_animate_out = "{{ config('adminetic.notify_animate_out', 'animated fadeOutUp') }}";
                            var notify = $.notify({title: "<i class='{{ config('adminetic.notify_icon', 'fa fa-bell-o') }}'></i> " +
                                      "Success",
                                  message: "Quick Category Created !"
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
            });
    </script>
    @endpush
</div>