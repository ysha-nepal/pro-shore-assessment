<?php

namespace Core\Controllers\Admin;

use App\Http\Controllers\Controller;
use Core\Controllers\Traits\CrudTrait;
use Core\Repositories\Admin\ActivityRepository;
use Core\UI\ActivityUI;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    use CrudTrait;

    public function __construct(ActivityRepository $model)
    {
        $this->model = $model;
        $this->ui = new ActivityUI();
        $this->view = "activities";
        $this->title = "Activities";
        $this->package = "core";
    }

    public function show($id,Request $request)
    {
        $model = $this->model->with(['causer'])->find($id);
        $this->checkPermission($this->ui->getPermission('index'));
        $params = $request->query();
        $form = "$this->package::$this->dir.$this->view.form";
        $breadcrumbs = $this->generateBreadCrumbs($params,'show');
        $view = "$this->package::$this->dir/$this->view/show";
        return view($view, [
            'ui' => $this->ui,
            'model' => $model,
            'form' => $form,
            'params' => $params,
            'title' => $this->title,
            'package' => $this->package,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
