<script>
    // Font Selector
    IconPicker.Init({
        jsonUrl: "{{ asset('adminetic/assets/js/icon-picker/iconpicker-1.5.0.json') }}",
        searchPlaceholder: 'Search Icon',
        showAllButton: 'Show All',
        cancelButton: 'Cancel',
        noResultsFound: 'No results found.',
        borderRadius: '20px',
    });

    IconPicker.Run('#iconPicker');
</script>

<script>
    $(function() {
        $('#expire').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        $('#name').on('keyup', function() {
            var name = $('#name').val();
            $('#meta_name').val(name);
        });
        $('#excerpt').on('keyup', function() {
            var excerpt = $('#excerpt').val();
            $('#meta_description').val(excerpt);
        });
    });
</script>
