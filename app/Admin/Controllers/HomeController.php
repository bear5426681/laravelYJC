<?php

namespace App\Admin\Controllers;
use App\Models\alldata;
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
        $articleView =View('admin.dashboard');
        return $content
            ->title('數據顯示')
            ->description('雞場概況')
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

    public function chartsData()
    {
        $temp_data = alldata::orderBy( 'pk', 'DESC' )->pluck( 'V6' )->first();
//        $temp_data = json_decode( $temp_data);
        $wet_data = alldata::orderBy( 'pk', 'DESC' )->pluck( 'V7' )->first();
        $wind1 = alldata::orderBy( 'pk', 'DESC' )->pluck( 'V11' )->first();
        $wind2=alldata::orderBy( 'pk', 'DESC' )->pluck( 'V12' )->first();
        $wind_data=$wind1.'m/s　　'.$wind2 .'°';
        $temp_data_time =alldata::select('received_time')->orderBy( 'pk', 'DESC' )->take(5)->get();
      $O3_data=alldata::orderBy( 'pk', 'DESC' )->pluck( 'V4' )->take(5);
      $NO2=alldata::orderBy('pk','DESC')->pluck('V3')->take(5);
      $SO2=alldata::orderBy('pk','DESC')->pluck('V1')->take(5);
      $CO=alldata::orderBy('pk','DESC')->pluck('V2')->take(5);
          $CO2=alldata::orderBy('pk','DESC')->pluck('V5')->take(5);
////            select('V11', 'V12')->orderBy( 'pk', 'DESC' )->get()->first();
//
//        $O3_array=array();
//        foreach ($O3_data as $data){
//            array_push( $O3_array, $data->V4 );
//        }
$time_array=array();
foreach ($temp_data_time as $times){
        array_push( $time_array, $times->received_time );
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
        );

        return  $allchartsdata;
//return  response()->json($allchartsdata);
//        return response()->json(json_encode( $monthly_post_data_array));
    }
}
