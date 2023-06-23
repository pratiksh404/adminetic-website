<script>
    $(function() {

        $(document).ready(function() {
            showColor();
        });

        $('#name').on('keyup', function() {
            showColor();
        });

        function showColor() {
            var name = $('#name').val();
            if (name == "color" || name == "Color" || name == "colors" || name == "Colors") {
                $('#color_section').show();
            } else {
                $('#color_section').hide();
            }
        }
    });
</script>

<script>
    function colorChanged(color) {
        var values = document.getElementById("values");
        var option = document.createElement("option");
        option.text = color.value;
        option.value = color.value;
        values.add(option);

        // Selecting all options
        $('#values option').prop("selected", "selected");
    }
</script>
