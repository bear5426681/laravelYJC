<?php

namespace App\Admin\Controllers;
use App\Models\alldata;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

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

    public function getchartsData()
    {
        $q = Input::get('q', null);
        $Jdata = DB::select('select * from dc_a1000 where company_name like ?', ['%'.$q.'%']);
//        $Jdata = DB::table('dc_a1000')->where('*', 'like', ''%'.$q.'%'')->get();
        $data = json_decode(json_encode($Jdata), true);
//        print_r($data);
        $response = array();
        if (count ( $data ) > 0) {
            if (is_array ( $data ) && count ( $data ) > 0) {
                foreach ( $data as $id => $value ) {
//                    $str = $value['COMPANY_ID']." ".trim($value['COMPANY_NAME']);
//                    $response[$id] = ['label'=>$str,'value'=>$str,'id'=>$id,'memo'=>trim($value['acc_memo']),'name'=>trim($value['COMPANY_NAME'])];
                    $company_name = $value['company_name'];
                    $company_id = $value['company_id'];
                    $address = $value['address'];
                    $principal = $value['principal'];
                    $tel = $value['tel'];
                    $fax = $value['fax'];
                    $response[$id] = ['label'=>$company_name, 'companyId'=>$company_id, 'address'=>$address, 'principal'=>$principal, 'tel'=>$tel, 'fax'=>$fax];
                }
            }
        }

        return response()->json(json_encode($response));
    }
}
