{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}

{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <!-- Bootstrap CSS -->--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"--}}
{{--          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}

{{--    <!-- Optional JavaScript -->--}}
{{--    <!-- jQuery first, then Popper.js, then Bootstrap JS -->--}}
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

{{--</head>--}}


{{--<body>--}}
<div class="row" >
    <div class="col-lg-12  " id="" style="height:12px">
        <label for="place">選擇地點：</label>

        <select name="place" id="place">
            <option value="20001">第1區雞場</option>
            {{--                    <option value="saab">Saab</option>--}}
            {{--                    <option value="mercedes">Mercedes</option>--}}
            {{--                    <option value="audi">Audi</option>--}}
        </select>

    </div>


</div>
<div class="row" style="margin-right: 20px">
    <div class="col-lg-3  " id="main" style="height: 300px;">
{{--margin-top: 20px--}}
    </div>
    <div class="col-lg-3" id="wet" style="height: 300px;">
{{--        margin-top: 40px--}}
    </div>
    <div class="col-lg-3 " id="xx" style="height: 300px">
        <div class="bg-danger" style="height: 90%">
            <div class="h3 "style=" padding-top: 10px;padding-left: 10px" >風力風向</div>

        </div>
    </div>
    <div class="col-lg-3 " id="simple_opendata" style="height: 300px">
<div class="bg-danger" style="height: 90%">
    <div class="h3 "style=" padding-top: 10px;padding-left: 10px" >Tips：</div>
</div>
    </div>

</div>
<div class="row " style="margin-right: 10px">
    <div class="col-lg-8" id="option2" style="height: 400px">

    </div>
    <div class="col-lg-4" id="option3" style="height: 400px"></div>
</div>
<script src="{{ asset('js/echarts.js') }}" defer></script>
<script>

    function getMessage(response){
        $.ajax({
            type: 'get',
            url: './admin/chartsData',
            dataType: "json",
            success: function(allchartsdata) {
            response;

                //console.log(allchartsdata)
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
                // windChart.setOption({
                //     title: {
                //      subtext: allchartsdata.wet_data.V11,
                //
                //     },
                // });


            },
            error: function( errormessage) {
                console.log(errormessage);
            }
        });
    }

</script>

{{--</body>--}}


{{--</html>--}}
