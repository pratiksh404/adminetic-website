<div>
    @isset($blocks)
    @foreach ($blocks as $theme => $types)
    <div class="card shadow-lg">
        <div class="card-header">
            <h4 class="card-title">Theme {{$theme}}</h4>
        </div>
        <div class="card-body p-2">
            <div class="card">

                <div class="card-body">
                    @foreach ($types as $type => $block_items)
                    <div class="row">
                        <div class="col-lg-3">
                            <p class="mega-title">{{$type}}</p>
                        </div>
                        <div class="col-lg-9">
                            @foreach ($block_items as $block)
                            <div class="card">
                                <div class="media p-20">
                                    <div class="form-check radio radio-primary me-3">
                                        <input class="form-check-input" id="radio{{$block->id}}" type="radio"
                                            wire:model="activeblocks.{{$theme}}.{{$type}}"
                                            name="radio{{$theme}}{{$type}}" value="{{$block->id}}">
                                        <label class="form-check-label" for="radio{{$block->id}}"></label>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0 mega-title-badge">{{$block->name}} -
                                            v{{$block->version}}<span
                                                class="badge badge-{{$block->active ? 'success' : 'danger'}} pull-right digits">{{$block->active
                                                ? 'Active' : 'Inactive'}}</span></h6>
                                        @if (isset($block->image))
                                        <img src="{{asset('storage/' . $block->image)}}" alt="{{$block->name}}"
                                            class="img-fluid">
                                        @else
                                        @if (isset(($block->setting())->image))
                                        <img src="{{asset(($block->setting())->image)}}" alt="{{$block->name}}"
                                            class="img-fluid">
                                        @else
                                        <img src="{{getImagePlaceholder()}}" alt="{{$block->name}}" class="img-fluid">
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endisset
    @push('livewire_third_party')
    <script>
        Livewire.on('blockVcComplete', function() {
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
                                        message: "Block Status Updated !"
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
    @endpush
</div>