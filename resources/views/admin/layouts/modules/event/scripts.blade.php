<script>
    $(function(){

        $(document).ready(function(){
            eventType();
            assignStartEnd();
        });

        $('#single_day').on('change',function(){
            eventType();
        });

        $("#meta_keywords").select2({
        tags: true,
        tokenSeparators: [',', ' ']
        });
    
        $('#event_date').daterangepicker({
            parentEl: "#event_date_section",
            timePicker: true,
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
            format: 'YYYY-MM-DD'
            }
        });

        $('#interval').daterangepicker({
            parentEl: "#event_date_section",
            timePicker: true,
                showDropdowns: true,
                locale: {
                format: 'YYYY-MM-DD'
                }
        });

        $('#interval').on('change',function(){
            assignStartEnd();
        });

    function eventType(){
        var event_type = $('#single_day').val();
        if (parseInt(event_type) == 1) {
            $('#single_day_section').show();
            $('#multiple_day_section').hide();
            $("#single_day_section :input").prop("disabled", false);
            $("#multiple_day_section :input").prop("disabled", true);
        } else if(parseInt(event_type) == 0){
             $('#multiple_day_section').show();
             $('#single_day_section').hide();
             $("#multiple_day_section :input").prop("disabled", false);
             $("#single_day_section :input").prop("disabled", true);
        } else {
            $('#single_day_section').hide();
            $('#multiple_day_section').hide();
            $("#single_day_section :input").prop("disabled", true);
            $("#multiple_day_section :input").prop("disabled", true);
        }
    }

    // Assign First and Last Date
       function assignStartEnd()
       {
               var start_date = formattedDay(new Date($('#interval').data('daterangepicker').startDate));
               var end_date = formattedDay(new Date($('#interval').data('daterangepicker').endDate));
               $('#start_date').val(start_date);
               $('#end_date').val(end_date);
        }

         // Date Time with Format
		 function formattedDay(date)
		 {
		 var dd = String(date.getDate()).padStart(2, '0');
		 var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
		 var yyyy = date.getFullYear();
		 var h = String(date.getHours());
		 var m = String(date.getMinutes());
		 
		 date = yyyy + '/' + mm + '/' + dd + ' ' + h + ':' + m;
		 return date;
		 }
    });
</script>

<script>
    function readURL(input) {
                if(input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                $('#image').hide();
                $('#image_plcaeholder')
                .attr('src',e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
                }
            }
</script>