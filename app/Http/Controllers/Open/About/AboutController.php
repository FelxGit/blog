<?php

namespace App\Http\Controllers\Open\About;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\user\Post;

class AboutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){ 

        return view('open/about/about');
    }
}
