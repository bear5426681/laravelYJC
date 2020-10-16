

{{--<body>--}}
<div class="row"  >
    <div class="col-lg-12  " id="" style="height:12px">
        <form method="get" action="javascript:getMessage()" style="position: relative;z-index: 5;">
            @csrf
        <label for="place">選擇地點：</label>

        <select name="place" id="place">
            @foreach($dropdown_eid as $eid)
                <option value="{{$eid->eid_id}}">{{$eid->eid_name}}({{$eid->eid_id}})</option>

            @endforeach

        </select>
            <input type="submit" value="查詢">
        </form>
    </div>


</div>
<div class="row" style="margin-right: 20px" >
    <div class="col-lg-3  " id="main" style="height: 300px;">
{{--margin-top: 20px--}}
    </div>
    <div class="col-lg-3" id="wet" style="height: 300px;">
{{--        margin-top: 40px--}}
    </div>
    <div class="col-lg-3 " id="xx" style="height: 300px">
        <div class=" text-center" style="height: 90%; ">
            <div class="h3 "style=" padding-top: 10px" >風力風向</div>
            <p class="m-0 h4" id="winddata">0m/s　　0°</p>
            <p style="margin-bottom:0; "><strong>PM2.5　</strong> <span id="pm25">N/A</span> ug/m3</p>
<img src="{{ '/images/pngwing.png' }}" class="img-fluid" height="60%" width="60%">
        </div>
    </div>
    <div class="col-lg-3 " id="simple_opendata" style="height: 300px;text-align: center;">
        <p class="h3" id="">行情價錢</p>
        <p id="TaijinPrice_20kgup" style="font-size: 60px">N/A</p>
        <p>市場價格：<span id="Store_KP_TaijinPrice">N/A</span></p>
        <p>蛋價：<span id="egg_TaijinPrice">N/A</span></p>

        <p>資料更新時間：<span id="TransDate">N/A</span></p>
    </div>

</div>
<div class="row " style="margin-right: 10px">
    <div class="col-lg-7" id="option2" style="height: 400px">

    </div>
    <div class="col-lg-5" id="option3" style="height: 400px"></div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/echarts/4.9.0-rc.1/echarts.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
{{--<script src="{{ asset('js/echarts.js') }}" defer></script>--}}
{{--</head>--}}

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

            }
        },
        series: [
            {
                name: '氣體偵測',
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
                detail: {formatter: '{value}℃'},
                data: [{value: 4, name: '氣溫'}],
                max: 44,
                min: 4,
                center: ["50%", "55%"],
            },

        ]
    };

    temChart.setOption(option1);
    //</溫度>
    //<濕度>
    var wetChart = echarts.init(document.getElementById('wet'));
    // 指定图表的配置项和数据
    option_wet = {
        tooltip: {
            formatter: '{a} <br/>{b} : {c}%'
        },

        series: [
            {
                name: '現在濕度',
                type: 'gauge',
                axisLine: {

                    lineStyle: {
                        color: [

                            [0.7, "#FFAA33"],
                            [1, "#4682b4"],
                        ],
                    },
                },
                detail: {
                    formatter: '{value}%',
                    offsetCenter: [10, "30%"]
                },
                data: [{value: 0, name: ' 濕度'}],
                startAngle: 180,
                endAngle: 0,
                radius: "90%",
                center: ["50%", "70%"],
            },

        ]
    };

    wetChart.setOption(option_wet);



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
                        color: '#cc0000',
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

    // setInterval(getMessage, 5000);

    function getMessage(response){
        console.log(document.getElementById('place').value)
        $.ajax({
            type: 'get',
            url: './admin/chartsData',
            data:{place:document.getElementById('place').value},
            dataType: "json",
            success: function(allchartsdata) {
            response;

                 //console.log(allchartsdata);
                $('#winddata').text(allchartsdata.wind_data);
                $('#pm25').text(allchartsdata.pm25);
                $('#egg_TaijinPrice').text(allchartsdata.price.egg_TaijinPrice);
                $('#Store_KP_TaijinPrice').text(allchartsdata.price.Store_KP_TaijinPrice);
                $('#TransDate').text(allchartsdata.price.TransDate);
                $('#TaijinPrice_20kgup').text(allchartsdata.price['TaijinPrice_2.0kgup']);

                temChart.setOption({ //重新載入數據
                    series: [{
                        data: [{ value:allchartsdata.temp_data, name: '氣溫' }],
                    }]
                });
                wetChart.setOption({
                    series: [{
                        data: [{value: allchartsdata.wet_data, name: ' 濕度'}],
                    }]
                });
                option2Chart.setOption({
                xAxis: {
                   data: allchartsdata.temp_data_time
                } ,
                series: [{

                      data: allchartsdata.SO2
                },
                    {
                       data: allchartsdata.NO2
                    },

                    {
                        data: allchartsdata.O3
                    },]}

                );

                option3Chart.setOption({
                    xAxis: {
                        data: allchartsdata.temp_data_time
                    } ,
                    series: [{

                        data: allchartsdata.CO
                    },


                        {
                            data: allchartsdata.CO2
                        },]}

                );




            },
            error: function( errormessage) {
                console.log(errormessage);
            }
        });
    }

</script>

{{--</body>--}}


{{--</html>--}}
