@if (config('website.post_dashboard_active',false))
<script>
    $(function(){
                    $(document).ready(function(){
                        monthlyPostTotalViewColumnChart();
                        monthlyPostTotalViewAreaChart();
                    });

                });

                function monthlyPostTotalViewAreaChart(){
                    $.get('{{route('getMonthlyPostTotalView')}}',
                    function(data){
                        var monthly_counts = data.monthly_counts;
                        var months = [];
                        var count = [];
                        
                        $.each(monthly_counts, function(index, views) {
                        months.push(index);
                        count.push(views);
                        });

                        var monthlyPostTotalViewAreaChartOptions = {
                        chart: {
                            height: 350,
                            type: 'area',
                            zoom: {
                                enabled: false
                            },
                            toolbar:{
                              show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        series: [{
                            name: "Views",
                            data: count
                        }],
                        title: {
                            text: 'Post views',
                            align: 'left'
                        },
                        subtitle: {
                            text: 'per month',
                            align: 'left'
                        },
                        labels: months,
                        yaxis: {
                            opposite: true
                        },
                        legend: {
                            horizontalAlign: 'left'
                        },
                        colors:[ CubaAdminConfig.primary ]
                    
                    }
                    
                    var monthlyPostTotalViewAreaChart = new ApexCharts(
                        document.querySelector("#monthlyPostTotalViewAreaChart"),
                        monthlyPostTotalViewAreaChartOptions
                    );
                    
                    monthlyPostTotalViewAreaChart.render();
                    });
                }
                
                function monthlyPostTotalViewColumnChart(){
                    $.get('{{route('getMonthlyPostTotalView')}}',
                    function(data){
                    var monthly_counts = data.monthly_counts;
                    var months = [];
                    var count = [];
                    
                    $.each(monthly_counts, function(index, views) {
                    months.push(index);
                    count.push(views);
                    });

                    var monthlyPostTotalViewColumnChartOption = {
                    chart: {
                        height: 350,
                        type: 'bar',
                        toolbar:{
                          show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            endingShape: 'rounded',
                            columnWidth: '55%',
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    series: [{
                        name: 'Views Per Month',
                        data: count
                    }],
                    xaxis: {
                        categories: months,
                    },
                    yaxis: {
                        title: {
                            text: 'views'
                        }
                    },
                    fill: {
                        opacity: 1
                
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return val + 'views'
                            }
                        }
                    },
                    colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25']
                }
                
                $('#monthlyPostTotalViewColumnChart').empty();
                var monthlyPostTotalViewColumnChart = new ApexCharts(
                    document.querySelector("#monthlyPostTotalViewColumnChart"),
                    monthlyPostTotalViewColumnChartOption
                );
                
                monthlyPostTotalViewColumnChart.render();
            });
            }

</script>
@endif