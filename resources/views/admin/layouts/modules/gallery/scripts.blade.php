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
        


        $('.urls').select2({
        dropdownAutoWidth: true,
        width: '100%',
        tags: true,
        tokenSeparators: [',']
        });

    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img class="img-fluid" style="width:100px;height:auto">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#images').on('change', function() {
        imagesPreview(this, 'div.gallery_images');
    });

    });
</script>