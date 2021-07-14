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

        // Phone 
        $(".phone").select2({
            placeholder: 'Member Phone Number',
            tags: true,
            tokenSeparators: [',', ' ']
        })
    });
</script>

<script>
    function readURL(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#team_image').hide();
            $('#team_image_plcaeholder')
                .attr('src',e.target.result)
                .width(100)
            };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>