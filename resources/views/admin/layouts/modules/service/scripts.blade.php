<script>
    $(function(){

        // Code Generation
		$( document ).ready(function() {
			let random = Math.floor((Math.random() * 1000000) + 1);
			$('#code').val(random);
		});

		$('#code_reload').on('click',function(){
           let random = Math.floor((Math.random() * 1000000) + 1)
           $('#code').val(random);
        });

        // SEO Title
        $('#name').on('keyup',function(){
            var name = $(this).val();
            $('#meta_name').val(name);
        });
        // SEO Description
         $('#excerpt').on('keyup',function(){
            var excerpt = $(this).val();
            $('#meta_description').val(excerpt);
        });
        /* Tags */
        $(".tags").select2({
        tags: true,
        tokenSeparators: [',']
        })

        // Font Selector
        IconPicker.Init({
         jsonUrl: "{{asset('website/plugins/iconPicker/dist/iconpicker-1.5.0.json')}}",
           searchPlaceholder: 'Search Icon',
           showAllButton: 'Show All',
           cancelButton: 'Cancel',
           noResultsFound: 'No results found.',
           borderRadius: '20px',
        });
        
        IconPicker.Run('#iconPicker');
    });
</script>
<script>
    function readIconURL(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#service_icon').hide();
            $('#service_icon_plcaeholder')
                .attr('src',e.target.result)
                .width(100)
            };
        reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#service_image').hide();
            $('#service_image_plcaeholder')
                .attr('src',e.target.result)
                .width(100)
            };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>