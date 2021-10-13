<script>
    $(function(){
        $(".page").select2({
        tags: true
        });
    });
</script>
<script>
    function readURL(input) {
        if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
        $('#block_image').hide();
        $('#block_image_plcaeholder')
        .attr('src',e.target.result)
        .width(100)
        };
        reader.readAsDataURL(input.files[0]);
        }
        }
</script>