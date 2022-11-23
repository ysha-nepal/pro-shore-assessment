<?php

namespace Core\Helpers;

use Core\Models\User;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Route;

class ActivityLogHelper
{

    private Agent $agent;


    private array $properties;


    public function __construct()
    {
        $this->agent = new Agent();
        $this->properties = [
            'browser' => $this->agent->browser(),
            'platform' => $this->agent->platform(),
            'version' => $this->agent->version($this->agent->browser()),
            'device' => $this->agent->device(),
            'ip' => request()->ip()
        ];
    }

    public function loggedIn($user)
    {
        activity()->causedBy($user)
            ->event('Login')
            ->withProperties($this->properties)
            ->log(":causer.name logged in.");
    }

    public function loginFailed($credentials)
    {
        $user = User::where(function($q) use ($credentials){
            $username = $credentials['username'] ?? $credentials['email'] ?? $credentials['phone'];
            $q->where('email',$username)
                ->orWhere('phone',$username);
        })->first();
        if($user){
            activity()->causedBy($user)
                ->event('Login Failed')
                ->withProperties($this->properties)
                ->log(":causer.name failed at login");
        }else{
            activity()
                ->event('Login Failed')
                ->withProperties($this->properties)
                ->log("Login Failed with invalid email address");
        }
    }

    public function route($request)
    {
        if(!Route::is('admin.activities.*')){
            $url = $request->fullUrl();;
            $properties = array_merge($this->properties, [
                'url' => $url,
                'method' => $request->method()
            ]);
            $user = Auth::user();
            if($user){
                activity()->causedBy($user)
                    ->event('Route')
                    ->withProperties($properties)
                    ->log(":causer.name visited $url");
            }else{
                activity()
                    ->event('Route')
                    ->withProperties($properties)
                    ->log("Guest visited $url");
            }
        }
    }

    public function log($event,$description,$properties = [])
    {
        $withProperties = array_merge($this->properties, $properties);
        if(!Route::is('admin.activities.*')) {
            $user = Auth::user();
            if ($user) {
                activity()->causedBy($user)
                    ->event($event)
                    ->withProperties($withProperties)
                    ->log($description);
            } else {
                activity()
                    ->event($event)
                    ->withProperties($withProperties)
                    ->log($description);
            }
        }
    }
}
