<?php

namespace App\Admin\Controllers;

use App\Models\dashboard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\View;

class dashboardController extends AdminController
{

    public function index(Content $content)
    {
        $articleView =View('admin.dashboard');
        return $content->title('數據顯示')
            ->description('雞場概況')
            ->row($articleView);

    }
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'dashboard';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new dashboard());



        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(dashboard::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new dashboard());



        return $form;
    }
}
