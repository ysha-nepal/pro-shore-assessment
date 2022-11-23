<?php

namespace Core\Controllers\Traits;

use Core\Helpers\ActivityLogHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

trait CrudTrait
{
    /**
     * @var string
     */
    private $table = ".layouts.index";
    /**
     * @var string
     */
    private $create = ".layouts.create";

    private $route = "admin";

    private $dir = "admin";


    public function generatePagination()
    {
        $pagination = setting_helper('app-settings', 'pagination');
        $pagination = $pagination !== "" ? $pagination : "10";
        return $pagination;
    }

    public function generateBreadCrumbs($params=[],$action = null)
    {
        $breadcrumbs = [ 'Dashboard' => route("$this->route.dashboard")];
        if(isset($this->parentUI)){
            $breadcrumbs[$this->parentUI->title ] = route($this->route . "." . $this->parentUI->route . ".index");
        }
        $breadcrumbs[$this->title] = route("$this->route.{$this->ui->route}.index",$params);
        if($action){
            $breadcrumbs[ucfirst($action)] = ucfirst($action);
        }
        return $breadcrumbs;
    }

    public function index(Request $request)
    {
        $this->checkPermission($this->ui->getPermission('index'));
        $model = $this->model->getModel();
        $query = $this->model;
        $query = $query->scope();
        $query = $query->select($this->ui->select ?? '*');
        $query = $query->with($this->ui->with);
        $params = $request->query();
        $query = $query->searchable($params);
        $query = $query->filterParent($params, $model);
        $records = $query->paginate($this->generatePagination());
        $breadcrumbs = $this->generateBreadCrumbs($params);
        $view = "core::admin" . $this->table;
        if(isset($params['SUBMIT']) && $params['SUBMIT'] === 'Export' && isset($this->export)){
            $log = new ActivityLogHelper();
            $log->log('Created',":causer.name Exported $this->title",[
                'url' => $request->fullUrl()
            ]);
            return Excel::download(new $this->export($query),'exports.xlsx');
        }
        if(view()->exists($this->package."::$this->dir/$this->view/index")){
            $view =     "$this->package::$this->dir/$this->view/index";
        }
        return view($view, [
            'records' => $records,
            'ui' => $this->ui,
            'params' => $params,
            'title' => $this->title,
            'model' => $model,
            'view' => $this->view,
            'package' => $this->package,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function create(Request $request)
    {
        $this->checkPermission($this->ui->getPermission('create'));
        $params = $request->query();
        $form = "$this->package::$this->dir.$this->view.form";
        $breadcrumbs = $this->generateBreadCrumbs($params,'create');
        $view = "core::admin" . $this->create;
        if(view()->exists($this->package."::$this->dir/$this->view/create")){
            $view = "$this->package::$this->dir/$this->view/create";
        }
        return view($view, [
            'ui' => $this->ui,
            'model' => $this->model->getModel(),
            'form' => $form,
            'params' => $params,
            'title' => $this->title,
            'package' => $this->package,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function store(Request $request)
    {
        $params = $request->query();
        $this->checkPermission($this->ui->getPermission('store'));
        $data = $this->validate($request,
            $this->ui->getStoreRules() + ['medias' => 'array|nullable'],
            $this->ui->getMessages());
        $model = $this->model->store($data);


        if ($model && $model->media) {
            $model->medias()->sync($data['medias'] ?? []);
        }
        if($request->get('submit') === "RSUBMIT"){
            return redirect()->route("$this->route.{$this->ui->route}.create",$params)
                ->with('message','Record Added Successfully');
        }
        if (isset($this->events) && isset($this->events['store'])) {
            event(new $this->events['store']($model));
        }
        $log = new ActivityLogHelper();
        $log->log('Created',":causer.name Created $this->title",[
            'url' => $request->fullUrl()
        ]);
        if($request->get('redirect_url')){
            return redirect($request->get('redirect_url'));
        }
        return $this->redirect('Record added successfully',$params);
    }



    public function edit($id,Request  $request)
    {
        $this->checkPermission($this->ui->getPermission('edit'));
        $params = $request->query();
        $query = $this->model;
        $query = $query->scope();
        $model = $query->findOrFail($id);
        $form = "$this->package::$this->dir.$this->view.form";
        $breadcrumbs = $this->generateBreadCrumbs($params,'edit');
        $view = "core::admin" . $this->create;
        if(view()->exists($this->package."::$this->dir/$this->view/edit")){
            $view = "$this->package::$this->dir/$this->view/edit";
        }
        return view($view, [
            'ui' => $this->ui,
            'model' => $model,
            'form' => $form,
            'title' => $this->title,
            'params' => $params,
            'package' => $this->package,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id, Request $request)
    {

        $this->checkPermission($this->ui->getPermission('update'));
        $params = $request->query();
        $query = $this->model;
        $query = $query->scope();
        $model = $query->find($id);
        $rules = $this->ui->getUpdateRules($model)  + ['medias' => 'array|nullable'];
        $data = $this->validate($request, $rules,$this->ui->getMessages());
        $model = $this->model->update($id, $data);
        if ($model && $model->media) {
            $model->medias()->sync($data['medias'] ?? []);
        }
        if (isset($this->events) && isset($this->events['update'])) {
            event(new $this->events['update']($model));
        }
        $log = new ActivityLogHelper();
        $log->log('Updated',":causer.name Updated $this->title",[
            'url' => $request->fullUrl()
        ]);
        if($request->get('redirect_url')){
            return redirect($request->get('redirect_url'));
        }
        return $this->redirect('Record updated successfully',$params);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id,Request $request)
    {
        $this->checkPermission($this->ui->getPermission('destroy'));
        $params = $request->query();
        $query = $this->model;
        $query = $query->scope();
        $model = $query->find($id);
        DB::beginTransaction();
        $message = "Record deleted successfully";
        try{
            if ($model && $model->media) {
                $model->medias()->sync([]);
            }
            $this->model->delete($id);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            $message = "Record could not be deleted.";
        }
        $log = new ActivityLogHelper();
        $log->log('Deleted',":causer.name deleted $this->title",[
            'url' => $request->fullUrl()
        ]);
        if($request->get('redirect_url')){
            return redirect($request->get('redirect_url'));
        }
        return $this->redirect($message,$params);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function changeStatus($id,Request $request)
    {
        $this->checkPermission($this->ui->getPermission('status'));
        $params = $request->query();
        $query = $this->model;
        $query = $query->scope();
        $query->toggleStatus($id);
        $log = new ActivityLogHelper();
        $log->log('Updated',":causer.name Updated $this->title",[
            'url' => $request->fullUrl()
        ]);
        return $this->redirect('Status Updated successfully',$params);
    }

    public function redirect($message,$params = [])
    {
        return redirect()->route("$this->route.{$this->ui->route}.index",$params)
            ->with('message',$message);
    }

    /**
     * @throws AuthorizationException
     */
    public function checkPermission($permission)
    {
        $user = Auth::user();
        if($user && $user->can($permission)){

            return true;
        }
        throw new AuthorizationException('You are not unauthorized to perform this action',403);
    }
}
