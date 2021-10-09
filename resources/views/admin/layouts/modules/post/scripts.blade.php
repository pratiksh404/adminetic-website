<script>
    $(function() {
        // Code Generation
        $(document).ready(function() {
            let random = Math.floor((Math.random() * 1000000) + 1);
            $('#code').val(random);
        });
        $('#code_reload').on('click', function() {
            let random = Math.floor((Math.random() * 1000000) + 1)
            $('#code').val(random);
        });
    // Fetch Template
        $('#template').on('change', function() {
            $.get('{{ route('get_template') }}', {
                    'template_id': $(this).val()
                },
                function(data) {
                    CKEDITOR.instances['heavytexteditor'].insertHtml(data.template.template);
                    toastr.success('Template Imported');
                }
            );
        });


        // SEO
        // SEO Title
        $('#title').on('keyup', function() {
            var title = $(this).val();
            $('#seo_title').val(title);
        });
        // SEO Description
        $('#excerpt').on('change', function() {
            var description = $(this).val();
            $('#meta_description').val(description);
        });
        /* Tags */
        $(".tags").select2({
            tags: true,
            tokenSeparators: [',']
        })

    });

</script>



<script>
    // Show Image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#post_image').hide();
                $('#post_image_plcaeholder')
                    .attr('src', e.target.result)
                    .width(200)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

<script>
    $(function() {
        $(document).ready(function() {
            $.get('{{ route('get_monthly_post_view') }}', {
                    'post_id': $('#monthly-post-views-line-chart').data('id')
                },
                function(data) {
                    var monthly_counts = data.monthly_counts;
                    var months = [];
                    var counts = [];

                    $.each(monthly_counts, function(index, count) {
                        months.push(index);
                        counts.push(count);
                    });

                    var $primary = "#00b5b8",
                        $secondary = "#2c3648",
                        $success = "#0f8e67",
                        $info = "#179bad",
                        $warning = "#ffb997",
                        $danger = "#ff8f9e"

                    var $themeColor = [$primary, $success, $warning, $info, $danger, $secondary]

                    /* Line Chart Initialization */
                    var lineBasicChart = {
                        chart: {
                            height: 350,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                        },
                        series: [{
                            name: "Monthly Counts",
                            data: counts,
                        }],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight',
                            colors: $themeColor
                        },
                        title: {
                            text: 'post Views Count By Month',
                            align: 'left'
                        },
                        grid: {
                            row: {
                                colors: ['#f3f3f3',
                                    'transparent'
                                ], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        xaxis: {
                            categories: months
                        }
                    }
                    var monthly_post_views_line_chart = new ApexCharts(
                        document.querySelector("#monthly-post-views-line-chart"),
                        lineBasicChart
                    );
                    monthly_post_views_line_chart.render();

                    /* Bar Chart Initialization */
                    var barBasicChart = {
                        chart: {
                            height: 350,
                            type: 'bar',
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        series: [{
                            data: counts
                        }],
                        xaxis: {
                            categories: months
                        },
                        fill: {
                            colors: $themeColor
                        }
                    }
                    // Initializing Bar Basic Chart
                    var monthly_post_views_bar_chart = new ApexCharts(
                        document.querySelector("#monthly-post-views-bar-chart"),
                        barBasicChart
                    );
                    monthly_post_views_bar_chart.render();
                }
            );
        });
    });

</script>