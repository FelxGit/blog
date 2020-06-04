<?php

namespace App\Http\Controllers\Open;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('status',1)->paginate(5);
      
        return view('open/home',compact('posts'));
    }
}
