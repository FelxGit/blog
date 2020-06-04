<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {   
        switch($guard){
            case 'admin': 
                if (Auth::guard($guard)->check()) {

                  foreach(Auth::guard($guard)->user()->roles as $role){

                    switch ($role->name) {
                    
                        case 'admin':
                                return redirect()->route('admin.home');
                            break;
                        case 'editor':
                                return redirect('editor/home');
                            break; 
                        default:
                                return redirect()->route('admin.login'); 
                            break;
                    }
                  }
                }
            break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('user.home');
                }
        }
        
        return $next($request);
    }
}
