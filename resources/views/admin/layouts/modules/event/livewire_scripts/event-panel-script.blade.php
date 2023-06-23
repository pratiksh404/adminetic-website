<script>
    $(function(){     
        $('#interval').daterangepicker({
                parentEl: "#interval_body",
                showDropdowns: true,
                locale: {
                format: 'YYYY-MM-DD'
                }
        });

        $('#interval').on('apply.daterangepicker', function(ev, picker) {
            let start_date = new Date($('#interval').data('daterangepicker')
                .startDate.format('YYYY-MM-DD'));
            let end_date = new Date($('#interval').data('daterangepicker').endDate
                .format('YYYY-MM-DD'));
            window.livewire.emit('date_range_filter', start_date, end_date)
        });

        Livewire.on('event_featured_success', message => {
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
        // Date Time with Format
		 function formattedDay(date)
		 {
		 var dd = String(date.getDate()).padStart(2, '0');
		 var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
		 var yyyy = date.getFullYear();
		 var h = String(date.getHours());
		 var m = String(date.getMinutes());
		 
		 date = yyyy + '/' + mm + '/' + dd + ' ' + h + ':' + m;
		 return date;
		 }
    });
</script>

<script>
    // Show Image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#event_image').hide();
                $('#event_image_placeholder')
                    .attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>