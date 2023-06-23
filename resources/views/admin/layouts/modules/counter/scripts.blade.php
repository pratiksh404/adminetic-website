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
