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
        $('#title').on('keyup',function(){
            var title = $(this).val();
            $('#seo_title').val(title);
        });
        /* Tags */
        $(".tags").select2({
        tags: true,
        tokenSeparators: [',']
        })
    });
</script>
<script>
    // Show Image
    function readURL(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#page_image').hide();
            $('#page_image_plcaeholder')
                .attr('src',e.target.result)
                .width(200)
            };
        reader.readAsDataURL(input.files[0]);
        }
    }

</script>