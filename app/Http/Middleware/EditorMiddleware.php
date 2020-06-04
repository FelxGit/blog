<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class EditorMiddleware
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
        if(!empty(Auth::guard('admin')->user())){
            
             foreach(Auth::guard('admin')->user()->roles as $role){
                if($role->name == 'editor'){
                    return $next($request);
                }
                else{ 
                    return redirect()->route($role->name.'.home');
                }
             }
        }

        return redirect('/');
  
    }
}
