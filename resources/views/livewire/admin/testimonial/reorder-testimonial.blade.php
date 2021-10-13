<div>
    @isset($testimonials)
    <ul wire:sortable="updateTestimonialOrder">
        @foreach ($testimonials as $testimonial)
        <li wire:sortable.item="{{ $testimonial->id }}" wire:key="testimonial-{{ $testimonial->id }}">
            <div class="card shadow-lg" wire:sortable.handle style="cursor:move">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-4">
                            @isset($testimonial->image)
                            <img src="{{asset('storage/' . $testimonial->image)}}" class="img-fluid">
                            @endisset
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <b>code : </b><span class="text-muted">{{$testimonial->code ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>name : </b><span class="text-muted">{{$testimonial->name ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>email : </b><span class="text-muted">{{$testimonial->email ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>contact : </b><span class="text-muted">{{$testimonial->contact ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>designation : </b><span class="text-muted">{{$testimonial->designation ??
                                        'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>company : </b><span class="text-muted">{{$testimonial->company ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>rating : </b><span class="text-muted">{{$testimonial->rating ?? 'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>position : </b><span class="text-muted">{{$testimonial->position ??
                                        'N/A'}}</span>
                                </li>
                                <li class="list-group-item">
                                    <span
                                        class="badge badge-{{$testimonial->approve ? 'success' : 'danger'}}">{{$testimonial->approve
                                        ? 'Approved' : 'Denied'}}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-8">
                            <h4 class="text-center">Testimonial</h4>
                            <hr>
                            {!! $testimonial->body !!}
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
                                message: "Testimonial Reorderd !"
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