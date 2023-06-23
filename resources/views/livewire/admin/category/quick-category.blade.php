<div>
    <div class="mt-4">
        <label for="category_id">{{ $label ?? 'Category' }}</label>
        <div class="input-group">
            <select name="{{ $attribute ?? 'category_id' }}" wire:model="category_id" id="category_id" class="form-control">
                <option value="">Select ...</option>
                @foreach ($parent_categories as $parent_category)
                    @include('website::admin.layouts.modules.category.options', [
                        'category' => $parent_category,
                        'iteration' => ($iteration ?? 0) + $loop->iteration,
                        'category_id' => $category->parent_id ?? null,
                    ])
                @endforeach
            </select>
            <span class="input-group-text">
                <button type="button" class="btn btn-primary btn-air-primary"
                    wire:click="$toggle('category_panel_toggle')"><i class="fa fa-plus"></i></button>
            </span>
        </div>
    </div>

    @if ($category_panel_toggle)
        <div class="card"
            style="position: fixed;top: 10vh;right: 5vw;bottom: 0;left: 5vw;z-index: 999;width: 90vw;height:30vh;overflow: auto">
            <div class="card-header">
                <div class="d-flex justify-content-center">
                    <b>Quick Category Create</b>
                </div>
            </div>
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mt-4">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <input type="text" name="name" wire:model="name" id="name"
                                    class="form-control" placeholder="Name" required>
                            </div>
                            @error('name')
                                <br>
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mt-4">
                            <label for="parent_id">Parent Category If Any</label>
                            <div class="input-group">
                                <select name="parent_id" wire:model="parent_id" id="parent_id" class="form-control">
                                    <option value="">Select ...</option>
                                    @foreach ($parent_categories as $parent_category)
                                        @include('website::admin.layouts.modules.category.options', [
                                            'category' => $parent_category,
                                            'category_id' => $category->parent_id ?? null,
                                        ])
                                    @endforeach
                                </select>
                            </div>
                            @error('parent_id')
                                <br>
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success btn-air-success" wire:click="save">Save</button>
                    <button type="button" class="btn btn-danger btn-air-danger"
                        wire:click="$toggle('category_panel_toggle')">Close</button>
                </div>
            </div>
        </div>
    @endif
    @push('livewire_third_party')
        <script>
            $(function() {
                Livewire.on('quick_category_success', message => {
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
                            "Alert",
                        message: message
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
