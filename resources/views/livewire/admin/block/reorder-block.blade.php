<div>
    @isset($blocks)
    <ul wire:sortable="updateBlockOrder">
        @foreach ($blocks as $block)
        <li wire:sortable.item="{{ $block->id }}" wire:key="block-{{ $block->id }}">
            <div class="card shadow-lg" wire:sortable.handle style="cursor:move">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <b>Name : </b> <span class="text-muted">{{$block->name ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Theme : </b> <span class="text-muted">{{$block->theme ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Page : </b> <span class="text-muted">{{$block->page ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Version : </b> <span class="text-muted">v{{$block->version ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Location : </b> <span class="text-muted">{{$block->location ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="badge badge-{{$block->active ? 'success' : 'danger'}}">{{$block->active
                                        ? 'Active' : 'Inactive'}}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-7">
                            @if (isset($block->image))
                            <img src="{{asset('storage/' . $block->image)}}" alt="{{$block->name}}" width="120"
                                class="img-fluid">
                            @else
                            @if (isset(($block->setting())->image))
                            <img src="{{asset(($block->setting())->image)}}" alt="{{$block->name}}" width="120"
                                class="img-fluid">
                            @else
                            <img src="{{getImagePlaceholder()}}" alt="{{$block->name}}" width="120" class="img-fluid">
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    @endisset
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
                                message: "Block Reorderd !"
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