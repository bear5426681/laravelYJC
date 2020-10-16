<?php


namespace App\Admin\Controllers;


use Encore\Admin\Controllers\AdminController;
use App\Models\raiseModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\test2Model;

class RaiseController extends AdminController
{
    protected $title = '入雛';

    protected function grid()
    {
        /*$grid = new Grid(new test2Model());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;*/
        //$gasModel = config('admin.database.gas_model');

        $grid = new Grid(new raiseModel());
        //$grid->column('id', 'ID')->sortable();
        //$grid->column('batch_number', trans('批號'))->editable();
        $grid->column('breed_id', '入雛品種');
        $grid->column('', '鳥禽平均重量');
        $grid->column('', '當日總飼料量');
        $grid->column('', '當日總飲水量');
        $grid->column('enter_day', trans('入雛日'));
        /*$grid->column('enter_day', trans('入雛日'))->display(function ($name) {
            return "<a tabindex=\"0\" class=\"btn btn-xs btn-twitter\" role=\"button\" data-toggle=\"popover\" data-html=true title=\"Usage\" data-content=\"<code>config('$name');</code>\">$name</a>";
        });*/
        $grid->column('enter_count', '入雛數量');
        //$grid->column('age', trans('入雛天數'))->editable();
        $grid->column('age', trans('入雛天數'));
        $grid->column('end_day', trans('出雛日'));
        $grid->column('end_count', '出雛數量');

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            // 设置created_at字段的范围查询
            $filter->between('enter_day', '入雛日期區間')->datetime();
            // 设置created_at字段的范围查询
            $filter->between('end_day', '出雛日期區間')->datetime();
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

            $export->filename('Raise.csv');
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
