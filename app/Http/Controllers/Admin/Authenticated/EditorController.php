<?php

namespace App\Http\Controllers\Admin\Authenticated;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('editor');
        $this->middleware('admin.verified');
    }

    public function index(){

    	return view('admin/authenticated/home');
    }
}
