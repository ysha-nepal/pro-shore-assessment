<?php

namespace Core\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('core::admin.dashboard');
    }
}