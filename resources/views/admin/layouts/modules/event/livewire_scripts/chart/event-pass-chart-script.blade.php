<script>
    $(function(){
                  Livewire.emit('initialize_event_pass_chart');
                            window.addEventListener('initializeEventPassChart',event => {
                                // Area Chart
                                $('#eventPassAreaChart').empty();
                                var date = [];
                                var total = [];
        
                                var data = event.detail.passRegisterPerDay;
                                Object.keys(data).forEach(function(pass_date){
                                    date.push(pass_date);
                                    total.push(data[pass_date]);
                                });
                                var eventPassAreaChartOption = {
                                    chart: {
                                        height: 350,
                                        type: 'area',
                                        toolbar:{
                                          show: false
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        curve: 'smooth'
                                    },
                                    series: [{
                                        name: 'Pass Amount',
                                        data: total
                                    }],
                                
                                    xaxis: {
                                        categories: date,
                                    },
                                      tooltip: {
                                           y: {
                                               formatter: function (val) {
                                                   return ' Pass : ' + val
                                               }
                                           }
                                       },
                                    colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary,'#009933' ]
                                }
                                
                                if (document.querySelector("#eventPassAreaChart")) {
                                  var eventPassAreaChart = new ApexCharts(
                                  document.querySelector("#eventPassAreaChart"),
                                  eventPassAreaChartOption
                                  );
                                  
                                  eventPassAreaChart.render();
                                }
        
                                // Bar Chart
                                  $('#eventPassBarChart').empty();
                       
                                   var eventPassBarChartOption = {
                                    series: [{
                                    name: 'Pass',
                                    data: total
                                  }],
                                    chart: {
                                      type: 'bar',
                                      height: 270,
                                      toolbar: {
                                        show: false
                                      },
                                    },
                                  plotOptions: {
                                    bar: {
                                      horizontal: false,
                                      columnWidth: '50%',
                                    },
                                  },
                                  dataLabels: {
                                    enabled: false
                                  },
                                  stroke: {
                                    show: true,
                                    width: 6,
                                    colors: ['transparent']
                                  },
                                  grid: {
                                    show: true,
                                    borderColor: 'var(--chart-border)',
                                    xaxis: {
                                        lines: {
                                            show: true
                                        }
                                    }, 
                                  },
                                  colors: ['#7366FF'],
                                  xaxis: {
                                    categories: date,
                                    tickAmount: 4,
                                    tickPlacement: 'between',
                                    labels: {
                                      style: {
                                        fontFamily: 'Rubik, sans-serif',
                                      },
                                    },
                                    axisBorder: {
                                      show: false
                                    },
                                    axisTicks: {
                                      show: false
                                    }
                                  },
                                  yaxis: {
                                    tickAmount: 5,
                                    tickPlacement: 'between',
                                    labels: {
                                      style: {
                                        fontFamily: 'Rubik, sans-serif',
                                      }
                                    }
                                  },
                                  fill: {
                                    opacity: 1
                                  },
                                  legend: {
                                    position: 'top',
                                    horizontalAlign: 'left', 
                                    fontFamily: "Rubik, sans-serif",
                                    fontSize: '14px',
                                    fontWeight: 500,
                                    labels: {
                                          colors: "var(--chart-text-color)",
                                    },
                                    markers: {
                                      width: 6,
                                      height: 6,
                                      radius: 12,
                                    },
                                    itemMargin: {
                                      horizontal: 10,
                                    }
                                  },
                                  responsive: [{
                                    breakpoint: 1366,
                                    options: {
                                      plotOptions: {
                                        bar: {
                                          columnWidth: '80%',
                                        },
                                      },
                                      grid: {
                                        padding: {
                                          right: 0,
                                        }
                                      }
                                    },
                                  },
                                  {
                                    breakpoint: 992,
                                    options: {
                                      plotOptions: {
                                        bar: {
                                          columnWidth: '70%',
                                        },
                                      },
                                    },
                                  },
                                  {
                                    breakpoint: 576,
                                    options: {
                                      plotOptions: {
                                        bar: {
                                          columnWidth: '60%',
                                        },
                                      },
                                      grid: {
                                        padding: {
                                          right: 5,
                                        }
                                      }
                                    },
                                  }
                                  ]
                                };
                                
                                 if (document.querySelector("#eventPassBarChart")) {
                                  var eventPassBarChart = new ApexCharts(document.querySelector("#eventPassBarChart"), eventPassBarChartOption);
                                  eventPassBarChart.render();
                                 }
        
                                   // pie chart
                                   $('#totalVsRemainingEventPassPieChart').empty();
                                   var total_pass = event.detail.total_pass;
                                   var total_remaining_pass = event.detail.total_remaining_pass;
                                  var totalVsRemainingEventPassPieChartOption = {
                                      chart: {
                                          type: 'pie',
                                      },
                                      labels: ['Total Pass', 'Remaining'],
                                      series: [total_pass,total_remaining_pass],
                                      responsive: [{
                                          breakpoint: 480,
                                          options: {
                                              chart: {
                                                  width: 200
                                              },
                                              legend: {
                                                  show: false
                                              }
                                          }
                                      }],
                                      colors:['#51bb25', '#ff0000']
                                  }
                                  
                                  var totalVsRemainingEventPassPieChart = new ApexCharts(
                                      document.querySelector("#totalVsRemainingEventPassPieChart"),
                                      totalVsRemainingEventPassPieChartOption
                                  );
        
                                  totalVsRemainingEventPassPieChart.render();
                  });
            });
</script>