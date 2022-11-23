<?php

namespace Core\Controllers\Website;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return config('website.view.home') ? view(config('website.view.home')) :  view('core::website.home');
    }
}
