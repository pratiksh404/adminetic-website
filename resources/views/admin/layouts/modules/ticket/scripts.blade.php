<script>
    // Show Image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#ticket_image').hide();
                $('#ticket_image_placeholder')
                    .attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>