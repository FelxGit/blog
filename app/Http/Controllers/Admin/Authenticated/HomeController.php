<?php

namespace App\Http\Controllers\Admin\Authenticated;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
        $this->middleware('admin.verified');
    }

    public function index(){

    	return view('admin/authenticated/home');
    }
}
