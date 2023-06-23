<script>
    $(function(){
                  Livewire.emit('initialize_event_payment_chart');
                            window.addEventListener('initializeEventPaymentChart',event => {
                                // Area Chart
                                $('#eventPaymentAreaChart').empty();
                                var date = [];
                                var total = [];
        
                                var data = event.detail;
                                Object.keys(data).forEach(function(payment_date){
                                    date.push(payment_date);
                                    total.push(data[payment_date]);
                                });
                                var eventPaymentAreaChartOption = {
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
                                        name: 'Payment Amount',
                                        data: total
                                    }],
                                
                                    xaxis: {
                                        categories: date,
                                    },
                                      tooltip: {
                                           y: {
                                               formatter: function (val) {
                                                   return ' {{currency()}} ' + val
                                               }
                                           }
                                       },
                                    colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary,'#009933' ]
                                }
                                
                                if (document.querySelector("#eventPaymentAreaChart")) {
                                  var eventPaymentAreaChart = new ApexCharts(
                                  document.querySelector("#eventPaymentAreaChart"),
                                  eventPaymentAreaChartOption
                                  );
                                  
                                  eventPaymentAreaChart.render();
                                }
        
                                // Bar Chart
                                  $('#eventPaymentBarChart').empty();
                       
                                   var eventPaymentBarChartOption = {
                                    series: [{
                                    name: 'Payment',
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
                                
                                  if (document.querySelector("#eventPaymentBarChart")) {
                                    var eventPaymentBarChart = new ApexCharts(document.querySelector("#eventPaymentBarChart"), eventPaymentBarChartOption);
                                    eventPaymentBarChart.render();
                                  }
        
                  });
            });
</script>