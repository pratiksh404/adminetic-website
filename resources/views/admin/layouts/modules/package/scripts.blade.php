<script>
    $(function(){    
             $('#add_feature').on('click',function(){
            var html = '';
            html += '<tr class="feature_unit">';
            html += '<td><input type="text" name="features[]" class="feature form-control"></td>';
            html += '<td><button type="button" class="btn btn-danger delete-feature"><i class="fas fa-trash"></i></button></td>';
            html += '</tr>';
            $('#features').append(html);
        });
    
        $(document).on('click','.delete-feature',function(){
            $(this).closest('.feature_unit').remove();
        });
    });
</script>