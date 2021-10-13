<script>
    $(function(){
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
    });
</script>
<script>
    function readURL(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#project_image').hide();
            $('#project_image_plcaeholder')
                .attr('src',e.target.result)
                .width(100)
            };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>