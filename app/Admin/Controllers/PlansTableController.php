<?php

namespace App\Admin\Controllers;

use App\PlansTable;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PlansTableController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
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
        $grid = new Grid(new PlansTable);

        $grid->id('Id');
        $grid->plan_name('Plan name');
        $grid->plan_alias('Plan alias');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->server_access('Server access');
        $grid->speed_limit('Speed limit');
        $grid->months_limit('Months limit');
        $grid->price('Price');
        $grid->cents('Cents');
        $grid->button_text('Button text');
        $grid->button_color('Button color');
        $grid->advantages('Advantages');
        $grid->more_advantages('More advantages');

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
        $show = new Show(PlansTable::findOrFail($id));

        $show->id('Id');
        $show->plan_name('Plan name');
        $show->plan_alias('Plan alias');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->server_access('Server access');
        $show->speed_limit('Speed limit');
        $show->months_limit('Months limit');
        $show->price('Price');
        $show->cents('Cents');
        $show->button_text('Button text');
        $show->button_color('Button color');
        $show->advantages('Advantages');
        $show->more_advantages('More advantages');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PlansTable);

        $form->text('plan_name', 'Plan name');
        $form->text('plan_alias', 'Plan alias');
        $form->text('server_access', 'Server access')->default('basic');
        $form->text('speed_limit', 'Speed limit');
        $form->text('months_limit', 'Months limit');
        $form->text('price', 'Price');
        $form->text('cents', 'Cents')->default('00');
        $form->text('button_text', 'Button text')->default('subscribe');
        $form->text('button_color', 'Button color')->default('green');
        $form->textarea('advantages', 'Advantages');
        $form->textarea('more_advantages', 'More advantages');

        return $form;
    }
}
