<?php

namespace App\Admin\Controllers;

use App\AppsInfo;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AppsInfoController extends Controller
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
        $grid = new Grid(new AppsInfo);

        $grid->id('Id');
        $grid->header('Header');
        $grid->content('Content');
        $grid->client('Client');
        $grid->version('Version');
        $grid->link_install('Link install');
        $grid->link_update('Link update');
        $grid->button_text('Button text');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

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
        $show = new Show(AppsInfo::findOrFail($id));

        $show->id('Id');
        $show->header('Header');
        $show->content('Content');
        $show->client('Client');
        $show->version('Version');
        $show->link_install('Link install');
        $show->link_update('Link update');
        $show->button_text('Button text');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AppsInfo);

        $form->text('header', 'Header')->default('download');
        $form->textarea('content', 'Content');
        $form->text('client', 'Client');
        $form->text('version', 'Version')->default('1.0.0');
        $form->text('link_install', 'Link install');
        $form->text('link_update', 'Link update');
        $form->text('button_text', 'Button text')->default('download');

        return $form;
    }
}
