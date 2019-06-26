<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckLogedOut
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //guest neu nhu ma chua dang nhap thi se chuyen ve trang login
        if (Auth::guest()) {
            return redirect()->intended('login');
        }
        return $next($request);
    }
}
