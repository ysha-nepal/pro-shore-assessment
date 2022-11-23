<?php

namespace Core\Middlewares;

use Carbon\Carbon;
use Core\Models\User;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(1); // keep online for 1 min
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
            $user =  User::where('id', Auth::user()->id)->first();
            $user->update([
                'last_seen' => (new \DateTime())->format("Y-m-d H:i:s"),
            ]);

            if($user->force_logout){
                $user->update([
                    'force_logout' => 0
                ]);
                Auth::logout();
                return redirect()->route('login');
            }
        }
        return $next($request);
    }
}
