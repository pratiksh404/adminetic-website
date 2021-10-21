@if (config('website.google_analytics_active',false))
<script>
    $(function(){
                    $(document).ready(function(){
                        viewByCountryColumnChart();
                        viewByDaysColumnChart();
                        topReferrersColumnChart();
                        newVsReturningVistorPieChart();
                        topBrowsersPieChart();
                        mostVisitedPagesBarChart();
                    });

                    $('#viewByCountryColumnChartDays').on('keyup',function(){
                        var days = $(this).val();
                        if (parseInt(days) <= 30) {
                            $('#generateViewByCountryColumnChart').prop('disabled',false);
                        } else {
                            $('#generateViewByCountryColumnChart').prop('disabled',true);
                        }
                    });

                    $('#viewByDaysColumnChartDays').on('keyup',function(){
                        var days = $(this).val();
                        if (parseInt(days) <= 30) {
                            $('#generateViewByDaysColumnChart').prop('disabled',false);
                        } else {
                            $('#generateViewByDaysColumnChart').prop('disabled',true);
                        }
                    });

                    $('#topReferrersColumnChartDays').on('keyup',function(){
                        var days = $(this).val();
                        if (parseInt(days) <= 30) {
                            $('#generateTopReferrersColumnChart').prop('disabled',false);
                        } else {
                            $('#generateTopReferrersColumnChart').prop('disabled',true);
                        }
                    });

                    $('#newVsReturningVistorPieChartDays').on('keyup',function(){
                        var days = $(this).val();
                        if (parseInt(days) <= 30) {
                            $('#generateNewVsReturningVistorPieChart').prop('disabled',false);
                        } else {
                            $('#generateNewVsReturningVistorPieChart').prop('disabled',true);
                        }
                    });

                    $('#topBrowsersPieChartDays').on('keyup',function(){
                        var days = $(this).val();
                        if (parseInt(days) <= 30) {
                            $('#generateTopBrowsersPieChart').prop('disabled',false);
                        } else {
                            $('#generateTopBrowsersPieChart').prop('disabled',true);
                        }
                    });

                    $('#mostVisitedPagesBarChartDays').on('keyup',function(){
                        var days = $(this).val();
                        if (parseInt(days) <= 30) {
                            $('#generateMostVisitedPagesBarChart').prop('disabled',false);
                        } else {
                            $('#generateMostVisitedPagesBarChart').prop('disabled',true);
                        }
                    });

                    $('#generateViewByCountryColumnChart').on('click',function(){
                        var days = $('#viewByCountryColumnChartDays').val();
                        viewByCountryColumnChart(days);
                    });

                    $('#generateViewByDaysColumnChart').on('click',function(){
                        var days = $('#viewByDaysColumnChartDays').val();
                        viewByDaysColumnChart(days);
                    });

                    $('#generateTopReferrersColumnChart').on('click',function(){
                        var days = $('#topReferrersColumnChartDays').val();
                        topReferrersColumnChart(days);
                    });

                    $('#generateNewVsReturningVistorPieChart').on('click',function(){
                        var days = $('#newVsReturningVistorPieChartDays').val();
                        newVsReturningVistorPieChart(days);
                    });

                    $('#generateTopBrowsersPieChart').on('click',function(){
                        var days = $('#topBrowsersPieChartDays').val();
                        topBrowsersPieChart(days);
                    });

                    $('#generateMostVisitedPagesBarChart').on('click',function(){
                        var days = $('#mostVisitedPagesBarChartDays').val();
                        mostVisitedPagesBarChart(days);
                    });
                });
                
                function viewByCountryColumnChart(given_days = 7){
                    var days = parseInt(given_days) != 0 || parseInt(given_days) != '' ? parseInt(given_days) : 7;
                    $.get('{{route('viewByCountryColumnChart')}}',
                    {
                        days : days
                    },
                    function(data){
                    var countries = [];
                    var views = [];
                    var sessions = [];
                    var analytics = data.analytics;
                    $.each(analytics,function(index,analytic){
                        countries.push(analytic[0]);
                        sessions.push(analytic[1]);
                        views.push(analytic[2]);
                    });

                    var viewByCountryColumnChartOption = {
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
                        name: 'Views Per Country',
                        data: views
                    },{
                    name: 'Sessions Per Country',
                    data: sessions
                    }],
                    xaxis: {
                        categories: countries,
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
                                return val
                            }
                        }
                    },
                    colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25']
                }
                
                $('#viewByCountryColumnChart').empty();
                var viewByCountryColumnChart = new ApexCharts(
                    document.querySelector("#viewByCountryColumnChart"),
                    viewByCountryColumnChartOption
                );
                
                viewByCountryColumnChart.render();
            });
            }

            function viewByDaysColumnChart(given_days = 7){
                var days = parseInt(given_days) != 0 || parseInt(given_days) != '' ? parseInt(given_days) : 7;
                $.get('{{route('viewByDaysColumnChart')}}',
                {
                    days : days
                },
                function(data){
                var dates = [];
                var views = [];
                var visitors = [];
                var analytics = data.analytics;
                $.each(analytics,function(index,analytic){
                    dates.push(analytic.date);
                    visitors.push(analytic.visitors);
                    views.push(analytic.pageViews);
                });
                var viewByDaysColumnChartOption = {
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
                    name: 'Views',
                    data: views
                },{
                name: 'Visitors',
                data: visitors
                }],
                xaxis: {
                    categories: dates,
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
                            return val
                        }
                    }
                },
                colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25']
            }
            
            $('#viewByDaysColumnChart').empty();
            var viewByDaysColumnChart = new ApexCharts(
                document.querySelector("#viewByDaysColumnChart"),
                viewByDaysColumnChartOption
            );
            
            viewByDaysColumnChart.render();
            });
            }

            function topReferrersColumnChart(given_days = 7){
                var days = parseInt(given_days) != 0 || parseInt(given_days) != '' ? parseInt(given_days) : 7;
                $.get('{{route('topReferrersColumnChart')}}',
                {
                    days : days
                },
                function(data){
                var urls = [];
                var pageViews = [];
                var analytics = data.analytics;
                $.each(analytics,function(index,analytic){
                    urls.push(analytic.url);
                    pageViews.push(analytic.pageViews);
                });
                var topReferrersColumnChartOption = {
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
                    name: 'Views',
                    data: pageViews
                }],
                xaxis: {
                    categories: urls,
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
                            return val
                        }
                    }
                },
                colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25']
            }
            
            $('#topReferrersColumnChart').empty();
            var topReferrersColumnChart = new ApexCharts(
                document.querySelector("#topReferrersColumnChart"),
                topReferrersColumnChartOption
            );
            
            topReferrersColumnChart.render();
            });
            }

            function newVsReturningVistorPieChart(given_days = 7)
            {
                var days = parseInt(given_days) != 0 || parseInt(given_days) != '' ? parseInt(given_days) : 7;
                $.get('{{route('newVsReturningVistorPieChart')}}',
                {
                    days : days
                },
                function(data){
                    var new_visitors = parseInt(data.analytics[0][1]);
                    var returning_visitors = parseInt(data.analytics[1][1]);
                    
                    var newVsReturningVistorOptions = {
                       chart: {
                           width: 380,
                           type: 'pie',
                       },
                       labels: ['New Visitor', 'Returning Vistor'],
                       series: [new_visitors, returning_visitors],
                       responsive: [{
                           breakpoint: 480,
                           options: {
                               chart: {
                                   width: 200
                               },
                               legend: {
                                   position: 'bottom'
                               }
                           }
                       }],
                       colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary]
                   }
                   
                   $('#newVsReturningVistorPieChart').empty();
                   var newVsReturningVistorPieChart = new ApexCharts(
                       document.querySelector("#newVsReturningVistorPieChart"),
                       newVsReturningVistorOptions
                   );
                   
                   newVsReturningVistorPieChart.render();
                });
            }

            function topBrowsersPieChart(given_days = 7)
            {
                var days = parseInt(given_days) != 0 || parseInt(given_days) != '' ? parseInt(given_days) : 7;
                $.get('{{route('topBrowsersPieChart')}}',
                {
                    days : days
                },
                function(data){
                    var browsers = [];
                    var sessions = [];
                    var analytics = data.analytics;
                    $.each(analytics,function(index,analytic){
                        browsers.push(analytic.browser);
                        sessions.push(parseInt(analytic.sessions));
                    });
                    
                    var newVsReturningVistorOptions = {
                       chart: {
                           width: 380,
                           type: 'pie',
                       },
                       labels: browsers,
                       series: sessions,
                       responsive: [{
                           breakpoint: 480,
                           options: {
                               chart: {
                                   width: 200
                               },
                               legend: {
                                   position: 'bottom'
                               }
                           }
                       }],
                       colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary, '#51bb25', '#a927f9', '#f8d62b']
                   }
                   
                   $('#topBrowsersPieChart').empty();
                   var topBrowsersPieChart = new ApexCharts(
                       document.querySelector("#topBrowsersPieChart"),
                       newVsReturningVistorOptions
                   );
                   
                   topBrowsersPieChart.render();
                });
            }

            function mostVisitedPagesBarChart(given_days = 7)
            {
                var days = parseInt(given_days) != 0 || parseInt(given_days) != '' ? parseInt(given_days) : 7;
                $.get('{{route('mostVisitedPagesBarChart')}}',
                {
                    days : days
                },
                function(data){
                    var pageTitles = [];
                    var pageViews  = [];
                    $.each(data.analytics,function(index,analytic){
                        pageTitles.push(analytic.pageTitle);
                        pageViews.push(analytic.pageViews);
                    });
                        var mostVisitedPagesBarChartOptions = {
                           chart: {
                               height: 350,
                               type: 'bar',
                               toolbar:{
                                 show: false
                               }
                           },
                           plotOptions: {
                               bar: {
                                   horizontal: true,
                               }
                           },
                           dataLabels: {
                               enabled: false
                           },
                           series: [{
                               data: pageViews,
                           }],
                           xaxis: {
                               categories: pageTitles,
                           },
                           colors:[ CubaAdminConfig.primary ]
                       }
                       
                       var mostVisitedPagesBarChart = new ApexCharts(
                           document.querySelector("#mostVisitedPagesBarChart"),
                           mostVisitedPagesBarChartOptions
                       );
                       
                       mostVisitedPagesBarChart.render();
                });
            }
</script>
@endif