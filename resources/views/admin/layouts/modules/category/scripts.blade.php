<script>
    $(function(){
        $( document ).ready(function() {
			let random = Math.floor((Math.random() * 1000000) + 1);
			$('#code').val(random);
		});

		$('#code_reload').on('click',function(){
           let random = Math.floor((Math.random() * 1000000) + 1)
           $('#code').val(random);
        });

        // Font Selector
        IconPicker.Init({
           jsonUrl: "{{asset('assets/plugins/IconPicker/dist/iconpicker-1.5.0.json')}}",
           searchPlaceholder: 'Search Icon',
           showAllButton: 'Show All',
           cancelButton: 'Cancel',
           noResultsFound: 'No results found.',
           borderRadius: '20px',
        });
        
        IconPicker.Run('#iconPicker');

        // Category Table
          let datatable = $(".category_datatable").DataTable({
               "responsive": true,
               "autoWidth": true,
                rowReorder: true,
               "order": [],
               "info": true,
               "dom": '<"d-flex justify-content-between align-items-center btn-group">Bfrtip',
               "buttons": [
                   {
                      extend: 'copy',
                      exportOptions: {
                      columns: ':not(:last-child)',
                      }
                   },
                   {
                       extend: 'csv',
                       exportOptions: {
                       columns: ':not(:last-child)',
                       }
                   },
                   {
                       extend: 'excel',
                       exportOptions: {
                       columns: ':not(:last-child)',
                       }
                   },
                   {
                           extend: 'pdf',
                           exportOptions: {
                           columns: ':not(:last-child)',
                       }
                   },
                   {
                       extend: 'print',
                       exportOptions: {
                       columns: ':not(:last-child)',
                       }
                   }
               ]
             });
          $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary btn-air-primary');

        datatable.on('row-reorder', function (e, details) {
            if(details.length) {
                let rows = [];
                details.forEach(element => {
                    rows.push({
                        id: datatable.row(element.node).data()[0],
                        name: datatable.row(element.node).data()[2],
                        position: element.newData
                    });
                });

                $.get('{{ route('reorder_categories') }}',{
                    "rows": rows
                },function(){
               
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
                         message: "Position Updated !"
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
                 }

        });
    });
</script>

<script>
    function readURL(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#category_image').hide();
            $('#category_image_plcaeholder')
                .attr('src',e.target.result)
                .width(100)
            };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>