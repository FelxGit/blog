<?php

namespace App\Http\Controllers\User\Authenticated;

use App\Model\User\Notification;
use App\Model\User\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
     public function __construct()
    {
        //you can't access the session or authenticated user in your controller's constructor because the middleware has not run yet. In that case, you can use middleware closure


        // $this->middleware(function ($request, $next) {
           
        //     if(Auth::guard('admin')->check() || Auth::check()){
                
        //         return $next($request);
        //     }

        //    return redirect()->route('login');

        // });
        
        $this->middleware('auth');
        // $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {       
        $posts = Post::orderBy('created_at','DESC')->paginate(5); //it seem query with paginate is not allowed
        
        $notifications = Auth::user()->notifications()->where([
                                      ['user_id',Auth::user()->id],
                                      ['from_user_id','!=',Auth::user()->id],
                 ])->orderBy('created_at','DESC')->get();  

        $count = 0;
        $most_popular_post = 0;

        foreach($posts as $post){

            if($post->notifications()->count() > $count){

                $count = $post->notifications()->count();
                $most_popular_post = $post;
            }
        } 

        return view('user/authenticated/post/index',compact('posts','notifications','most_popular_post'));
    }

}
