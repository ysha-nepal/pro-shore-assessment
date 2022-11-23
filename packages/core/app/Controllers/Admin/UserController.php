<?php

namespace Core\Controllers\Admin;

use App\Http\Controllers\Controller;
use Core\Controllers\Traits\CrudTrait;
use Core\Helpers\ActivityLogHelper;
use Core\Repositories\Admin\UserRepository;
use Core\UI\UserUI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;


class UserController extends Controller
{
    use CrudTrait;


    public function __construct(UserRepository $model)
    {
        $this->model = $model;
        $this->ui = new UserUI;
        $this->view = "users";
        $this->package = "core";
        $this->events = [
            'store' => "Core\Events\Admin\UserCreatedEvent"
        ];
        $this->title = "Users";
    }

    public function profile()
    {
        $model = Auth::user();
        $breadcrumbs = $this->generateBreadCrumbs($model,'Profile');
        $view = "core::admin.users.user-profile";
        return view($view, [
            'model' => $model,
            'title' => $this->title,
            'package' => $this->package,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function profileUpdate($id,Request $request)
    {
        $query = $this->model;
        $model = $query->find($id);
        $rules = $this->ui->getProfileUpdateRules($model)  + ['medias' => 'array|nullable'];
        $data = $this->validate($request, $rules,$this->ui->getMessages());
        $model = $this->model->update($id, $data);
        if ($model && $model->media) {
            $model->medias()->sync($data['medias'] ?? []);
        }
        $log = new ActivityLogHelper();
        $log->log('Updated',":causer.name Updated Profile",[
            'url' => $request->fullUrl()
        ]);
        return redirect()->route('admin.user.profile','Successfully Updated Profile');
    }
    public function changePassword()
    {
        $model =$user = Auth::user();;
        $breadcrumbs = $this->generateBreadCrumbs($model,'Change-Password');
        $view = "core::admin.users.change-password";
        return view($view, [
            'model' => $model,
            'title' => $this->title,
            'package' => $this->package,
            'breadcrumbs' => $breadcrumbs
        ]);

    }

    public function storeChangePassword(Request $request, $id)
    {
        $data = $this->validate($request,$this->ui->getChangePasswordRules());
        $user = Auth::user();
        if (!(Hash::check($data['current_password'], $user->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($data['current_password'], $data['password']) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $data['password'] = bcrypt($data['password']);
        $this->model->update($id, $data);

        return redirect()->back()->with("message","Password successfully changed!");

    }
}
