<?php

namespace Core\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\Repositories\Admin\MediaRepository;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function __construct(MediaRepository $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $query = $this->model;
        if (isset($data['type']) && $data['type'] !== 'all') {
            $query = $query->where('type', $data['type']);
        }
        $records = $query->orderBy('created_at','desc')->paginate(5);
        $view = view('core::admin.layouts.components.medias.list',[
            'records' => $records
        ])->render();
        return response()->json(['view' =>$view],200);
    }

    public function upload(Request $request)
    {
        $data = $this->validate($request, [
            'medias' => 'array|required',
            'title' => 'required|string|max:255',
            'description' => 'string|nullable|max:500'
        ]);
        $this->model->store($data);
        return response()->json('Success',200);
    }
}
