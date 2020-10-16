<?php


namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\test2Model;
use App\Models\regularModel;
use App\Models\regular2Model;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\User;
//use App\Admin\Extensions\PostsExporter;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;
//use App\Admin\Controllers\Requests;


class Test2Contorller extends Controller
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '巡檢表';


    public function index(Content $content)
    {
        return $content
            ->header('每日巡檢表')
            ->description('列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        //DB::table('dc_b1002')->insert($Bdata);
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {


        $grid = new Grid(new test2Model());

        $grid->column('id', '流水號')->sortable();
        $grid->column('batch_number', '批號');
        $grid->column('site_id', '場域');
        $grid->column('inspection_num', '日期單號');
        $grid->column('ampm', '早/晚');
        $grid->column('breed_id', '品種');
        $grid->column('dead', '死亡數量');
        $grid->column('failed', '淘汰數量');
        $grid->column('failed_remark', '淘汰原因');
        $grid->column('feed', '來料噸數');
        $grid->column('feed_id', '飼料種類');
        $grid->column('editor', '填表/最後編輯者');
        $grid->column('remark', '備註');

        //$grid->column('regular_check_d.chk1', '00');
        //$grid->column('regular_check_d.chk2', '00');


        /*$grid->actions(function ($actions) {

            // 当前行的数据数组
            $actions->row;

            // 获取当前行主键值
            $actions->getKey();

            // append一个操作
            $actions->append('<a href="https://tw.yahoo.com/"><i class="fa fa-eye"></i></a>');
        });*/

        $grid->export(function ($export) {

            $export->filename('Filename.csv');
            $export->originalValue(['T1']);
        });

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
        $show = new Show(test2Model::findOrFail($id));
        //$show2 = new Show(regular2Model::findOrFail($id));

        $show->id('流水號');
        $show->batch_number('批號');
        $show->site_id('場域');
        $show->inspection_num('日期單號');
        $show->ampm('早/晚');
        $show->breed_id('品種');
        $show->dead('死亡數量');
        $show->failed('淘汰數量');
        $show->failed_remark('淘汰原因');
        $show->feed('來料噸數');
        $show->feed_id('飼料種類');
        $show->editor('填表/最後編輯者');
        $show->remark('備註');
        //$show->field('regular_check_d.chk1', __('00'));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new test2Model);
        $form->text('id', '流水號')->readonly();;
        $form->text('batch_number', '批號');
        $ere = [
            1 => '第一',
            2 => '第二',
        ];
        $form->select('site_id', '場域')->options($ere);
        $form->text('inspection_num', '日期單號');
        $times = [
            1 => '早',
            2 => '晚',
            3 => '其他',
        ];
        $form->select('ampm', '早/晚')->options($times);
        $varietys = [
            1 => '土雞',
            2 => '仿土雞',
            3 => '放山雞',
            4 => '肉雞',
        ];
        $form->select('breed_id', '品種')->options($varietys)->default(1);
        $form->divider();
        $form->text('dead', '死亡數量');
        $form->text('failed', '淘汰數量');
        $form->text('failed_remark', '淘汰原因');
        $form->divider();
        $form->text('feed', '來料噸數');
        $types = [
            1 => '飼料1',
            2 => '飼料2',
            3 => '飼料3',
            12 => '飼料12',
        ];
        $form->select('feed_id', '飼料種類')->options($types);
        $form->divider();
        $form->text('editor', '填表/最後編輯者');
        $form->textarea('remark', '備註');
        // $form->text('regular_check_d.chk1', '00');
        // $form->text('remember_token', 'Remember token');
        //$form->checkbox('regular_check_d',  __(''))->options(['chk1' => '料線運作', 'chk2' => '水線確認', 'chk3' => '溫度確認', 'chk5' => '消毒作業', 'chk6' => '噴霧消毒', 'chk7' => '入口消毒池', 'chk8' => '清潔作業', 'chk9' => '地面', 'chk10' => '水池', 'chk11' => '料線', 'chk12' => '水線']);

        return $form;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
/*    public function store(Requests $requests){
        $this->validate($requests,[

        ]);
        return;
    }*/

}

