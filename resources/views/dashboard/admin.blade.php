@extends('layouts.back')

@section('page-title', trans('app.home'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>@lang('app.dashboard')</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- top tiles -->
            <div class="row tile_count">
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-users"></i> @lang('app.admins')</span>
                <div class="count green">{{ $total['admin'] }}</div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> @lang('app.clients')</span>
                <div class="count green">{{ $total['clients'] }}</div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-car"></i> @lang('app.drivers')</span>
                <div class="count green">{{ $total['drivers'] }}</div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> @lang('app.supervisors') </span>
                <div class="count green">{{ $total['supervisor'] }}</div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-building-o"></i> @lang('app.branch_offices') </span>
                <div class="count green">{{ $total['branchOffices'] }}</div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> @lang('app.represent_branchs') </span>
                <div class="count green">{{ $total['representants'] }}</div>
              </div>

            </div>
            <!-- /top tiles -->

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Órdenes por hora del día</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="echart_pie2" style="height:350px;"></div>

                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Órdenes por fecha de búsqueda</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="echart_pie" style="height:350px;"></div>

                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Órdenes por sucursal</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="graph_bar" style="width:100%; height:280px;"></div>

                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Amigos invitados</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="graph_donut" style="width:100%; height:300px;"></div>

                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Paquetes más solicitados</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="graph_bar2" style="width:100%; height:280px;"></div>

                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Métodos de pagos mas usados</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id="graph_bar3" style="width:100%; height:280px;"></div>

                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<!-- ECharts -->
{!! HTML::script('public/vendors/echarts/dist/echarts.min.js') !!}
{!! HTML::script('public/vendors/echarts/map/js/world.js') !!}   
<!-- morris.js -->
{!! HTML::script('public/vendors/raphael/raphael.min.js') !!}  
{!! HTML::script('public/vendors/morris.js/morris.min.js') !!}  

<script type="text/javascript">

     Morris.Bar({
          element: 'graph_bar',
          data: {!! json_encode($order_branchs['data']) !!},
          xkey: 'name',
          ykeys: ['value'],
          labels: ['órdenes'],
          barRatio: 0.4,
          barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
          xLabelAngle: 35,
          hideHover: 'auto',
          resize: true
        });

      Morris.Bar({
          element: 'graph_bar2',
          data: {!! json_encode($order_packages['data']) !!},
          xkey: 'name',
          ykeys: ['total'],
          labels: ['órdenes'],
          barRatio: 0.4,
          barColors: ['#3498DB', '#26B99A', '#34495E', '#ACADAC'],
          xLabelAngle: 35,
          hideHover: 'auto',
          resize: true
        });

        Morris.Bar({
          element: 'graph_bar3',
          data: {!! json_encode($order_payments['data']) !!},
          xkey: 'name',
          ykeys: ['value'],
          labels: ['órdenes'],
          barRatio: 0.4,
          barColors: ['#34495E', '#26B99A','#ACADAC', '#3498DB'],
          xLabelAngle: 35,
          hideHover: 'auto',
          resize: true
        });

     Morris.Donut({
          element: 'graph_donut',
          data: {!! json_encode($friend_invited['data']) !!},
          colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
          formatter: function (y) {
            return y;
          },
          resize: true
        });

    var theme = {
          color: [
              '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
              '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
          ],

          title: {
              itemGap: 8,
              textStyle: {
                  fontWeight: 'normal',
                  color: '#408829'
              }
          },

          dataRange: {
              color: ['#1f610a', '#97b58d']
          },

          toolbox: {
              color: ['#408829', '#408829', '#408829', '#408829']
          },

          tooltip: {
              backgroundColor: 'rgba(0,0,0,0.5)',
              axisPointer: {
                  type: 'line',
                  lineStyle: {
                      color: '#408829',
                      type: 'dashed'
                  },
                  crossStyle: {
                      color: '#408829'
                  },
                  shadowStyle: {
                      color: 'rgba(200,200,200,0.3)'
                  }
              }
          },

          dataZoom: {
              dataBackgroundColor: '#eee',
              fillerColor: 'rgba(64,136,41,0.2)',
              handleColor: '#408829'
          },
          grid: {
              borderWidth: 0
          },

          categoryAxis: {
              axisLine: {
                  lineStyle: {
                      color: '#408829'
                  }
              },
              splitLine: {
                  lineStyle: {
                      color: ['#eee']
                  }
              }
          },

          valueAxis: {
              axisLine: {
                  lineStyle: {
                      color: '#408829'
                  }
              },
              splitArea: {
                  show: true,
                  areaStyle: {
                      color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                  }
              },
              splitLine: {
                  lineStyle: {
                      color: ['#eee']
                  }
              }
          },
          timeline: {
              lineStyle: {
                  color: '#408829'
              },
              controlStyle: {
                  normal: {color: '#408829'},
                  emphasis: {color: '#408829'}
              }
          },

          k: {
              itemStyle: {
                  normal: {
                      color: '#68a54a',
                      color0: '#a9cba2',
                      lineStyle: {
                          width: 1,
                          color: '#408829',
                          color0: '#86b379'
                      }
                  }
              }
          },
          map: {
              itemStyle: {
                  normal: {
                      areaStyle: {
                          color: '#ddd'
                      },
                      label: {
                          textStyle: {
                              color: '#c12e34'
                          }
                      }
                  },
                  emphasis: {
                      areaStyle: {
                          color: '#99d2dd'
                      },
                      label: {
                          textStyle: {
                              color: '#c12e34'
                          }
                      }
                  }
              }
          },
          force: {
              itemStyle: {
                  normal: {
                      linkStyle: {
                          strokeColor: '#408829'
                      }
                  }
              }
          },
          chord: {
              padding: 4,
              itemStyle: {
                  normal: {
                      lineStyle: {
                          width: 1,
                          color: 'rgba(128, 128, 128, 0.5)'
                      },
                      chordStyle: {
                          lineStyle: {
                              width: 1,
                              color: 'rgba(128, 128, 128, 0.5)'
                          }
                      }
                  },
                  emphasis: {
                      lineStyle: {
                          width: 1,
                          color: 'rgba(128, 128, 128, 0.5)'
                      },
                      chordStyle: {
                          lineStyle: {
                              width: 1,
                              color: 'rgba(128, 128, 128, 0.5)'
                          }
                      }
                  }
              }
          },
          gauge: {
              startAngle: 225,
              endAngle: -45,
              axisLine: {
                  show: true,
                  lineStyle: {
                      color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                      width: 8
                  }
              },
              axisTick: {
                  splitNumber: 10,
                  length: 12,
                  lineStyle: {
                      color: 'auto'
                  }
              },
              axisLabel: {
                  textStyle: {
                      color: 'auto'
                  }
              },
              splitLine: {
                  length: 18,
                  lineStyle: {
                      color: 'auto'
                  }
              },
              pointer: {
                  length: '90%',
                  color: 'auto'
              },
              title: {
                  textStyle: {
                      color: '#333'
                  }
              },
              detail: {
                  textStyle: {
                      color: 'auto'
                  }
              }
          },
          textStyle: {
              fontFamily: 'Arial, Verdana, sans-serif'
          }
      };

    var echartPieCollapse = echarts.init(document.getElementById('echart_pie2'), theme);
      
    echartPieCollapse.setOption({
      tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
      },
      legend: {
        x: 'center',
        y: 'bottom',
        data: {!! json_encode($order_by_hour['legend']) !!}
      },
      toolbox: {
        show: true,
        feature: {
          magicType: {
            show: true,
            type: ['pie', 'funnel']
          },
          restore: {
            show: false,
            title: "Restore"
          },
          saveAsImage: {
            show: true,
            title: "@lang('app.save_img')"
          }
        }
      },
      calculable: true,
      series: [{
        name: "@lang('app.hours')",
        type: 'pie',
        radius: [25, 90],
        center: ['50%', 170],
        roseType: 'area',
        x: '50%',
        max: 40,
        sort: 'ascending',
        data: {!! json_encode($order_by_hour['data']) !!}
      }]
    });

    var echartPie = echarts.init(document.getElementById('echart_pie'), theme);

    echartPie.setOption({
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',
          y: 'bottom',
          data: {!! json_encode($order_by_hour_delivery['legend']) !!}
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              type: ['pie', 'funnel'],
              option: {
                funnel: {
                  x: '25%',
                  width: '50%',
                  funnelAlign: 'left',
                  max: 1548
                }
              }
            },
            restore: {
              show: false,
              title: "Restore"
            },
            saveAsImage: {
              show: true,
              title: "@lang('app.save_img')"
            }
          }
        },
        calculable: true,
        series: [{
          name: "@lang('app.hours')",
          type: 'pie',
          radius: '55%',
          center: ['50%', '48%'],
          data: {!! json_encode($order_by_hour_delivery['data']) !!}
        }]
    });

  
</script>
@endsection