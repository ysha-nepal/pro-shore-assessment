<?php

namespace Core\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    private DatabaseNotification $model;

    public function __construct(DatabaseNotification $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications()->paginate(10,['*'],'page',$request->get('page'));
        $view = view('core::admin.layouts.components.notification',[
           'notifications' =>  $notifications
        ])->render();
        return response()->json([
            'view' => $view,
            'currentPage' => $notifications->currentPage(),
            'lastPage' => $notifications->lastPage()
        ],200);
    }

    public function read(Request $request)
    {
        $page = $request->get('page');
        $this->model->where('notifiable_type','Core\Models\User')->where('notifiable_id',auth()->id())
            ->latest()
            ->whereNull('read_at')
            ->limit($page * 10)
            ->update([
                'read_at' => Carbon::now()
            ]);
        return response()->json(['total' =>auth()->user()->unreadNotifications->count() ],200);
    }
}
