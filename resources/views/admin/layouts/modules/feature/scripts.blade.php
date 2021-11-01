<script>
    $(function(){
        // Font Selector
        IconPicker.Init({
         jsonUrl: "{{asset('adminetic/assets/js/icon-picker/iconpicker-1.5.0.json')}}",
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
            $('#feature_icon').hide();
            $('#feature_icon_plcaeholder')
                .attr('src',e.target.result)
                .width(100)
            };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>