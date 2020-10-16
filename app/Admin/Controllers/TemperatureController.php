<?php


namespace App\Admin\Controllers;


use Encore\Admin\Controllers\AdminController;
use App\Models\akkdataModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\test2Model;
use App\Models\alldata;

class TemperatureController extends AdminController
{
    protected $title = '平均狀態';

    protected function grid()
    {
        /*$grid = new Grid(new test2Model());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;*/
        //$gasModel = config('admin.database.gas_model');

        $grid = new Grid(new alldata());
        //$grid->column('pk', 'pk');
        //$grid->column('eid', 'ID')->sortable();

        //$grid->column('T5', trans('名稱'))->editable();
        /*$grid->column('V5', trans('二氧化碳'))->display(function ($name) {
            return "<a tabindex=\"0\" class=\"btn btn-xs btn-twitter\" role=\"button\" data-toggle=\"popover\" data-html=true title=\"Usage\" data-content=\"<code>config('$name');</code>\">$name</a>";
        });*/
        $grid->column('V5', trans('二氧化碳'));
        //$grid->column('U5', '單位');

        //$grid->column('T6', trans('名稱'))->editable();
        $grid->column('V6', trans('溫度'));
        //$grid->column('U6', '單位');

        //$grid->column('T7', trans('名稱'))->editable();
        $grid->column('V7', trans('濕度'));
        //$grid->column('U7', '單位');

        //$grid->column('T11', trans('名稱'))->editable();
        $grid->column('V11', trans('風速'));
        //$grid->column('U11', '單位');

        //$grid->column('T12', trans('名稱'))->editable();
        $grid->column('V12', trans('風向'));
        //$grid->column('U12', '單位');

        //$grid->column('T21', trans('名稱'))->editable();
        $grid->column('', trans('飼料量'));
        //$grid->column('U21', '單位');

        //$grid->column('T21', trans('名稱'))->editable();
        $grid->column('', trans('飲水量'));
        //$grid->column('U21', '單位');

        //$grid->column('T21', trans('名稱'))->editable();
        $grid->column('', trans('光照狀態'));
        //$grid->column('U21', '單位');

        //$grid->column('T21', trans('名稱'))->editable();
        $grid->column('', trans('前、後段壓差'));
        //$grid->column('U21', '單位');

        $grid->column('received_time', '時間')->sortable();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('pk');
            // 设置created_at字段的范围查询
            $filter->between('received_time', '日期區間')->datetime();
        });

        /*$grid->actions(function ($actions) {

            // 当前行的数据数组
            $actions->row;

            // 获取当前行主键值
            $actions->getKey();

            // append一个操作
            $actions->append('<a href="https://tw.yahoo.com/"><i class="fa fa-eye"></i></a>');
        });*/

        $grid->export(function ($export) {

            $export->filename('Temp.csv');
            $export->originalValue(['T1']);
        });

        $grid->disableCreateButton();
        $grid->disableActions();
        $grid->disableColumnSelector();
        //$grid->quickSearch('title');

        /*$grid->actions(function ($actions) {

            if ($actions->getKey() % 2 == 0) {
                $actions->disableDelete();
                $actions->append('<a href=""><i class="fa fa-paper-plane"></i></a>');
            } else {
                $actions->disableEdit();
                $actions->prepend('<a href=""><i class="fa fa-paper-plane"></i></a>');
            }
        });*/

        return $grid;
    }

}
