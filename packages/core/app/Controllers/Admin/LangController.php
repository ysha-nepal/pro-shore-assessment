<?php

namespace Core\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function change($locale)
    {
        if(in_array($locale, language_helper())){
            session(['locale' => $locale]);
        }
        return redirect()->route('admin.dashboard');
    }
}
