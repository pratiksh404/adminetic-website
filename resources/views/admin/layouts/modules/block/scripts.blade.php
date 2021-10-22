<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.11/ace.js"></script>
<script>
    $(function(){
        $(".page").select2({
        tags: true
        });
        $(".type").select2({
        tags: true
        });

        $(document).ready(function() {
        var setting = $('#setting').data('setting');
        var editor = ace.edit("editor");
        editor.session.setValue(JSON.stringify(setting, null, 4))
        });
        
        var editor = ace.edit("editor");
        editor.getSession().setMode("ace/mode/json");
        editor.setTheme("ace/theme/chrome");
        editor.getSession().setTabSize(2);
        editor.getSession().setUseWrapMode(true);

        var input = $('input[name="setting"]');
        editor.getSession().on("change", function() {
        input.val(editor.getSession().getValue());
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