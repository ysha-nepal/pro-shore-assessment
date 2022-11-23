<?php

namespace Core\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * @var Menu
     */
    private $model;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    public function order(Request $request)
    {
        $menus = $request->all();
        foreach($menus as $menu){
            $this->model->find($menu['id'])
                ->update([
                    'parent_id' => $menu['parent_id'],
                    'status' => $menu['status'],
                    'order' => $menu['order']
                ]);
        }
        return response()->json(['message' =>'Successfully Updated'],200);
    }
}
