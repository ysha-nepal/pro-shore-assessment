<?php

namespace Core\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    public function sendTestEmail(Request  $request)
    {
        $email = $request->get('email');
        if($email){
            try {
                Mail::to($email)->send(new TestEmail());
                return 'Mail Sent Successfully';
            }
            catch (\Exception $e){
                Log::info($e->getMessage());
                return 'Mail Configuration Error';
            }
        }
        return "Please provide a email address";
    }
}
