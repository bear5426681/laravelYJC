@extends('admin::index', ['header' => strip_tags($header)])

@section('content')
    <section class="content-header">
        <h1>
            {!! $header ?: trans('admin.title') !!}
            <small>{!! $description ?: trans('admin.description') !!}</small>
        </h1>

        <!-- breadcrumb start -->
        @if ($breadcrumb)
        <ol class="breadcrumb" style="margin-right: 30px;">
            <li><a href="{{ admin_url('/') }}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            @foreach($breadcrumb as $item)
                @if($loop->last)
                    <li class="active">
                        @if (\Illuminate\Support\Arr::has($item, 'icon'))
                            <i class="fa fa-{{ $item['icon'] }}"></i>
                        @endif
                        {{ $item['text'] }}
                    </li>
                @else
                <li>
                    @if (\Illuminate\Support\Arr::has($item, 'url'))
                        <a href="{{ admin_url(\Illuminate\Support\Arr::get($item, 'url')) }}">
                            @if (\Illuminate\Support\Arr::has($item, 'icon'))
                                <i class="fa fa-{{ $item['icon'] }}"></i>
                            @endif
                            {{ $item['text'] }}
                        </a>
                    @else
                        @if (\Illuminate\Support\Arr::has($item, 'icon'))
                            <i class="fa fa-{{ $item['icon'] }}"></i>
                        @endif
                        {{ $item['text'] }}
                    @endif
                </li>
                @endif
            @endforeach
        </ol>
        @elseif(config('admin.enable_default_breadcrumb'))
        <ol class="breadcrumb" style="margin-right: 30px;">
            <li><a href="{{ admin_url('/') }}"><i class="fa fa-dashboard"></i> {{__('Home')}}</a></li>
            @for($i = 2; $i <= count(Request::segments()); $i++)
                <li>
                {{ucfirst(Request::segment($i))}}
                </li>
            @endfor
        </ol>
        @endif

        <!-- breadcrumb end -->

    </section>

    <section class="content">
        <script src='https://cdnjs.cloudflare.com/ajax/libs/echarts/4.9.0-rc.1/echarts.min.js'></script>
        <div class="row" >
            <div class="col-lg-12  " id="" style="height:12px">
                <label for="place">選擇地點:</label>

                <select name="place" id="place">
                    <option value="20001">第1區雞場</option>
{{--                    <option value="saab">Saab</option>--}}
{{--                    <option value="mercedes">Mercedes</option>--}}
{{--                    <option value="audi">Audi</option>--}}
                </select>

            </div>


        </div>
        <div class="row" style="margin-right: 20px">
                <div class="col-lg-4  " id="main" style="height: 300px">


                </div>
                <div class="col-lg-4" id="wet" style="height: 300px;margin-top: 40px">

                </div>
                <div class="col-lg-4 " id="wind" style="height: 300px">

                </div>

            </div>
            <div class="row " style="margin-right: 10px">
                <div class="col-lg-8" id="option2" style="height: 400px">

                </div>
                <div class="col-lg-4" id="option3" style="height: 400px"></div>
            </div>

        <script>
            //<溫度>
            var temChart = echarts.init(document.getElementById('main'));
            // 指定图表的配置项和数据
            option1 = {
                tooltip: {
                    formatter: '{a} <br/>{b} : {c}℃'
                },
                toolbox: {
                    feature: {
                        // restore: { show: true, title: "restore", }, //不顯示下載等功能
                        // saveAsImage: { show: true, title: "Save as Image", },
                    }
                },
                series: [
                    {
                        name: '現在溫度',
                        type: 'gauge',
                        axisLine: {

                            lineStyle: {
                                color: [
                                    [0.4, "#4682b4"],
                                    [0.6, "#3cc391"],
                                    [1, "#fa4e4b"],
                                ],
                            },
                        },
                        detail: { formatter: '{value}℃' },
                        data: [{ value: 20, name: '氣溫' }],
                        max: 44,
                        min: 4
                    },
                    // radius: '80%',
                    // center: ["50%", "65%"],
                    // splitNumber: 0, //刻度数量
                    //startAngle: 180,
                    //  endAngle: 0,
                ]
            };
            setInterval(function () {
                option1.series[0].data[0].value = (Math.random() * 100).toFixed(2) - 0;
                temChart.setOption(option1, true);
            }, 2000);
            temChart.setOption(option1);
            //</溫度>

            //<濕度>
            var wetChart = echarts.init(document.getElementById('wet'));
            // 指定图表的配置项和数据
            option_wet = {
                tooltip: {
                    formatter: '{a} <br/>{b} : {c}%'
                },
                toolbox: {
                    feature: {
                        // restore: { show: true, title: "restore", },
                        // saveAsImage: { show: true, title: "Save as Image", },
                    }
                },
                series: [
                    {
                        name: '現在濕度',
                        type: 'gauge',
                        axisLine: {

                            lineStyle: {
                                color: [
                                    [0.7, "	#FFAA33"],
                                    [1, "#4682b4"],
                                ],
                            },
                        },
                        detail: { formatter: '{value}%' },
                        data: [{ value: 20, name: ' 濕度' }],
                        startAngle: 180,
                        endAngle: 0,
                        radius: "90%",
                    },
                    // radius: '80%',
                    // center: ["50%", "65%"],
                    // splitNumber: 0, //刻度数量
                    //startAngle: 180,
                    //  endAngle: 0,
                ]
            };

            wetChart.setOption(option_wet);
            //</濕度>

            //<風向風力>
            var windChart = echarts.init(document.getElementById('wind'));
            option_wind = {
                title: {
                    text: '風立風向',
                    subtext: '風向：342°  風力：0m/s',
                    left: 'center'
                },
                angleAxis: {

                    type: 'category',
                    data: ['北', '', 'NE', '', '東', '', 'SE', '', '南', '', 'SW', '', '西', '', 'NW', ''],
                    z: 0,
                    boundaryGap: false,
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#ddd',
                            type: 'solid'
                        }
                    },
                    axisLine: {
                        show: false
                    }
                },
                radiusAxis: {

                },
                //圓內外圈大小
                polar: {
                    radius: ["0%", "50%"]
                },
                series: [{
                    type: 'bar',
                    data: [0, 0, 0, 0, 0.62, 1.22, 1.61, 2.04, 2.66, 2.96, 2.53, 1.97, 1.64, 1.32, 1.58, 1.51],
                    coordinateSystem: 'polar',
                    name: '<0.5m/s',
                    stack: 'a',
                    itemStyle: {
                        normal: {
                            color: 'rgb(124, 181, 236)'
                        }
                    }
                }, {
                    type: 'bar',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    coordinateSystem: 'polar',
                    name: '0.5-2m/s',
                    stack: 'a',
                    itemStyle: {
                        normal: {
                            color: 'rgb(67, 67, 72)'
                        }
                    }
                }, {
                    type: 'bar',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    coordinateSystem: 'polar',
                    name: '2-4m/s',
                    stack: 'a',
                    itemStyle: {
                        normal: {
                            color: 'rgb(144, 237, 125)'
                        }
                    }
                },],
                legend: {
                    show: true,
                    top: 'bottom',
                    right: 'right',
                    data: ['<0.5m/s', '0.5-2m/s', '2-4m/s'],
                    orient: 'vertical',

                }
            };
            windChart.setOption(option_wind);
            //</風向風力>

            //<氣體1>
            var option2Chart = echarts.init(document.getElementById('option2'));

            option2 = {
                title: {
                    text: '氣體偵測',
                    subtext: '單位PPB'
                },
                backgroundColor: "#FFFFBB",
                tooltip: {
                    trigger: 'axis',
                    show: true,
                },
                legend: {
                    show: true,
                    icon: 'circle',
                    top: 20,
                    textStyle: {
                        fontSize: 14,
                        color: '#000'
                    },
                },
                grid: {
                    left: '5%',
                    right: '5%',
                    top: '15%',
                    bottom: '6%',
                    containLabel: true
                },
                xAxis: {
                    axisLine: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                    axisLabel: {
                        interval: 0,
                    },
                    data: ['1', '2', '3', '4', '5', '6', '7']
                },
                yAxis: {
                    axisLine: {
                        show: false,
                    },
                    axisTick: {
                        show: false
                    },
                },
                series: [{
                    name: '二氧化硫',
                    type: 'line',
                    smooth: true,
                    symbol: 'circle',
                    symbolSize: 13,
                    lineStyle: {
                        normal: {
                            width: 3,
                            color: '#fb7636',
                        }
                    },
                    itemStyle: {
                        color: '#fb7636',
                        borderColor: "#fff",
                        borderWidth: 2,
                    },

                    data: [32, 10, 41, 35, 51, 49, 62]
                },
                    {
                        name: '二氧化氮',
                        type: 'line',
                        smooth: true,
                        symbol: 'circle',
                        symbolSize: 13,
                        lineStyle: {
                            normal: {
                                width: 3,
                                color: '#24b314',
                            }
                        },
                        itemStyle: {
                            color: '#24b314',
                            borderColor: "#fff",
                            borderWidth: 2,
                        },

                        data: [236, 20, 35, 20, 75, 30, 60]
                    },

                    {
                        name: '臭氧',
                        type: 'line',
                        smooth: true,
                        symbol: 'circle',
                        symbolSize: 13,
                        lineStyle: {
                            normal: {
                                width: 3,
                                shadowColor: 'rgba(155, 18, 184, .4)',
                                color: '#8452e7',
                            }
                        },
                        itemStyle: {
                            color: '#8452e7',
                            borderColor: "#fff",
                            borderWidth: 2,
                        },

                        data: [107, 60, 20, 45, 15, 55, 25]
                    },
                ]
            };
            option2Chart.setOption(option2);

            //</氣體1>

            var option3Chart = echarts.init(document.getElementById('option3'));

            option3 = {

                backgroundColor: "#FFFFBB",
                tooltip: {
                    trigger: 'axis',
                    show: true,
                },
                legend: {
                    show: true,
                    icon: 'circle',
                    top: 20,
                    textStyle: {
                        fontSize: 14,
                        color: '#000'
                    },
                },
                grid: {
                    left: '5%',
                    right: '5%',
                    top: '15%',
                    bottom: '6%',
                    containLabel: true
                },
                xAxis: {
                    axisLine: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                    axisLabel: {
                        interval: 0,
                    },
                    data: ['1', '2', '3', '4', '5', '6', '7']
                },
                yAxis: {
                    axisLine: {
                        show: false,
                    },
                    axisTick: {
                        show: false
                    },
                },
                series: [
                    {
                        name: '一氧化碳(ppb)',
                        type: 'line',
                        smooth: true,
                        symbol: 'circle',
                        symbolSize: 13,
                        lineStyle: {
                            normal: {
                                width: 3,
                                shadowColor: 'rgba(155, 18, 184, .4)',
                                color: '#0088A8',
                            }
                        },
                        itemStyle: {
                            color: '#0088A8',
                            borderColor: "#fff",
                            borderWidth: 2,
                        },

                        data: [2421, 2630, 2201, 2435, 2215, 2355, 2125]
                    }, {
                        name: '二氧化碳(ppm)',
                        type: 'line',
                        smooth: true,
                        symbol: 'circle',
                        symbolSize: 13,
                        lineStyle: {
                            normal: {
                                width: 3,
                                color: '#CC0000',
                            }
                        },
                        itemStyle: {
                            color: '#CC0000',
                            borderColor: "#fff",
                            borderWidth: 2,
                        },

                        data: [1117, 1120, 1135, 1120, 1175, 1230, 1360]
                    },
                ]
            };
            option3Chart.setOption(option3);

        </script>
{{--        @include('admin::partials.alerts')--}}
{{--        @include('admin::partials.exception')--}}
{{--        @include('admin::partials.toastr')--}}

{{--        @if($_view_)--}}
{{--            @include($_view_['view'], $_view_['data'])--}}
{{--        @else--}}
{{--            {!! $_content_ !!}--}}
{{--        @endif--}}

    </section>
@endsection
