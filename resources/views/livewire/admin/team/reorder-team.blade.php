<div>
    @isset($teams)
    <ul wire:sortable="updateTeamOrder">
        @foreach ($teams as $team)
        <li wire:sortable.item="{{ $team->id }}" wire:key="team-{{ $team->id }}">
            <span class="text-muted" wire:sortable.handle style="cursor:move">{{ $team->name }}</span>
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
                                message: "Team Reorderd !"
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