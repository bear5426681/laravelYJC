<?php

namespace App\Admin\Controllers;
use App\Models\alldata;
use App\Models\z_eid;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        $dropdown_eid=z_eid::all();

        $articleView =View('admin.dashboard',compact(['dropdown_eid']));
        return $content
            ->title('數據顯示')
            ->description('雞場概況')
         ->row($articleView);

    }
    public function opendata(Content $content)
    {
        $articleView =View('admin.opendata');
        return $content
            ->title('公開資料')
            ->description('資料查詢')
            ->row($articleView);
    }

//    public function array_get($collunm)
//    {
//        $getdata=alldata::orderBy( 'pk', 'DESC' )->pluck( $collunm )->take(5);
//        $arr=array();
//        foreach ($getdata as $data){
//            array_push( $arr, $data->V4 );
//        }
//        return $arr;
//    }

    public function chartsData( Request $request )
    {
$place=$request->input('place');

        $url = "https://agridata.coa.gov.tw/api/v1/PoultryTransType_BoiledChicken_Eggs/?Start_time=2020%2F06%2F01";
        $json = file_get_contents($url);
//利用函數json_decode解析JSON格式資料
        $json_data = json_decode($json, true);
//取出第一筆資料
        $jsonarryopen_eggprice = $json_data['Data'][0];


        $temp_data = alldata::where('eid',$place)->orderBy( 'pk', 'DESC' )->pluck( 'V6' )->first();
$pm25= alldata::where('eid',$place)->orderBy( 'pk', 'DESC' )->pluck( 'V9' )->first();
//        $temp_data = json_decode( $temp_data);
        $wet_data = alldata::where('eid',$place)->orderBy( 'pk', 'DESC' )->pluck( 'V7' )->first();
        $wind1 = alldata::where('eid',$place)->orderBy( 'pk', 'DESC' )->pluck( 'V11' )->first();
        $wind2=alldata::where('eid',$place)->orderBy( 'pk', 'DESC' )->pluck( 'V12' )->first();
        $wind_data=$wind1.'m/s　　'.$wind2 .'°';
        $temp_data_time =alldata::where('eid',$place)->select('received_time')->orderBy( 'pk', 'DESC' )->take(5)->get();
      $O3_data=alldata::where('eid',$place)->orderBy( 'pk', 'DESC' )->pluck( 'V4' )->take(5);
      $NO2=alldata::where('eid',$place)->orderBy('pk','DESC')->pluck('V3')->take(5);
      $SO2=alldata::where('eid',$place)->orderBy('pk','DESC')->pluck('V1')->take(5);
      $CO=alldata::where('eid',$place)->orderBy('pk','DESC')->pluck('V2')->take(5);
          $CO2=alldata::where('eid',$place)->orderBy('pk','DESC')->pluck('V5')->take(5);

$time_array=array();
foreach ($temp_data_time as $times){
    $time = new \DateTime( $times->received_time );
        array_push( $time_array,  $time->format("m/d H:i:s"));
    }
        $allchartsdata = array(
            'temp_data'=>$temp_data,
            'wet_data'=>$wet_data,
            'wind_data'=>$wind_data,
            'temp_data_time'=>$time_array,
            'O3'=>$O3_data,
            'NO2'=>$NO2,
            'SO2'=>$SO2,
                'CO'=>$CO,
            'CO2'=>$CO2,
            'price'=>$jsonarryopen_eggprice,
            'place'=>$place,
            'pm25'=>$pm25
        );

        return  $allchartsdata;
//return  response()->json($allchartsdata);
//        return response()->json(json_encode( $monthly_post_data_array));
    }


}


