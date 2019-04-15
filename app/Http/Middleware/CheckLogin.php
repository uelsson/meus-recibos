<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $login_status = $request->session()->get('login_status');
        $email = $request->session()->get('user_data')['email'];

        if($login_status === 'logged' && $email !== null){
            return $next($request);
        } else {
            return redirect('/login')->with('messageError', 'Access denied');
        }
    }
}
