<?php

namespace Core\Controllers\Admin;

use App\Http\Controllers\Controller;
use Core\Repositories\Admin\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(SettingRepository $model)
    {
        $this->model = $model;
        $this->view = "settings";
        $this->title = "Setting";
    }

    public function show($name = null)
    {
        if($name){
            $model = $this->model->find($name);
        }else{
            $model = $this->model->first();
        }
        if(!$model){
            return redirect()->back();
        }
        return view('core::admin.settings.index',['model' => $model,'title' => $this->title,'package' =>$model->package]);
    }

    public function update($name,Request $request)
    {
        $model = $this->model->find($name);
        $this->authorize('update', $model);
        $validated = $this->validate($request,[
            'values' => 'array'
        ]);
        $model->update($validated);

        return redirect()->back()->with('message','Setting Updated Successfully');
    }
}
