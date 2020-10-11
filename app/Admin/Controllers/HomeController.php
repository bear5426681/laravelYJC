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

    public function chartsData()
    {
        $temp_data = alldata::orderBy( 'pk', 'DESC' )->pluck( 'V6' )->first();
//        $temp_data = json_decode( $temp_data);
        $wet_data = alldata::orderBy( 'pk', 'DESC' )->pluck( 'V7' )->first();
        $wind_data = alldata::orderBy( 'pk', 'DESC' )->pluck( 'V11','V12' )->first();
        $wind_data = alldata::select('V11', 'V12')->orderBy( 'pk', 'DESC' )->get()->first();
        $allchartsdata = array(
            'temp_data'=>$temp_data,
            'wet_data'=>$wet_data,
            'wind_data'=>$wind_data,
        );
        return  $allchartsdata;
//return  response()->json($allchartsdata);
//        return response()->json(json_encode( $monthly_post_data_array));
    }
}
