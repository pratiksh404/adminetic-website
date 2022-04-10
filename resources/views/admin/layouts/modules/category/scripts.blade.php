<script>
    $(function(){
        $("#meta_keywords").select2({
        tags: true,
        tokenSeparators: [',', ' ']
        })

          $('#treeBasic').jstree({
            'core' : {
                'themes' : {
                    'responsive': false
                }
            },
            'types' : {
                'default' : { 
                    'icon' : 'icofont icofont-folder font-theme'
                },
                'file' : {
                    'icon' : 'icofont icofont-file-alt font-dark'
                }
            },
            'plugins' : ['types']
        })
        
        $('#name').on('change',function(){
        var name = $(this).val();
        $('#meta_name').val(name);
        });

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
    function readURL(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#category_image').hide();
            $('#category_image_plcaeholder')
                .attr('src',e.target.result)
                .width(100)
            };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>