<div>
    <div class="row">
        <div class="col-lg-12">
            <div wire:ignore wire:loading.flex>
                <div style="width:100%;align-items: center;justify-content: center;">
                    <div class="loader-box" style="margin:auto">
                        <div class="loader-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:loading.remove>
        @if (isset($gallery->images))
        @if ($gallery->images->count() > 0)
        <span class="text-muted">Drag Up/Down To Alter Position</span>
        <br>
        <ul wire:sortable="imagePositionReorder">
            @foreach ($gallery->images->sortBy('position') as $image)
            <li wire:sortable.item="{{ $image->id }}" wire:key="image-{{ $image->id }}">
                <div class="row">
                    <div class="col-8">
                        @if (!is_null($image))
                        <img src="{{asset($image->thumbnail('image','small'))}}" alt="{{$gallery->name}}"
                            class="img-fluid" width="80">
                        @else
                        <img src="{{getImagePlaceholder()}}" alt="{{$gallery->name}}" class="img-fluid" width="80">
                        @endif
                    </div>
                    <div class="col-4"><button type="button" class="btn btn-sm btn-danger btn-air-danger"
                            wire:click="$emitUp('delete_gallery_image',{{$image->id}})"><i
                                class="fa fa-trash"></i></button></div>
                </div>
                <br>
            </li>
            @endforeach
        </ul>
        @else
        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">Gallery has no image !
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @endif
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
                            message: "Image Reorderd !"
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
        Livewire.on('galleryImageDeleted', function() {
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
                            message: "Gallery Image Deleted !"
                        }, {
                            type: 'danger',
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