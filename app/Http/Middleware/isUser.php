<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isUser
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
        if(!Auth::guest()){
            if( Auth::user()->type == 1){
                return redirect('/admin');
            }elseif(Auth::user()->type == 2){
                return redirect('/sale');
            }elseif(Auth::user()->type == 6){
                return redirect('/logistic');
            // }elseif(Auth::user()->type == 4){
            //     return redirect('/company');
            }else{
                return $next($request);
            }
        }else{
            return redirect('login');
        }
    }
}
