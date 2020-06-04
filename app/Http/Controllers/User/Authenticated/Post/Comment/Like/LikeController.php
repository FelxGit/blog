<?php

namespace App\Http\Controllers\User\Authenticated\Post\Comment\Like;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    
    public function like(Request $request){

    	$store = new Like;
    	$store->user_id     = Auth::user()->id; 
    	$store->comment_id  = $request->comment_id; 
    	$store->likes       = 1;
    	$store->save();

    	if(!empty($store)){

    		return ['confirmed_like' => true,'comment_id' => $request->comment_id];

    	}

    }

    public function delete(Request $request, $id){
    	
        if(!empty($id)){ //too many click can cause empty parameter, check id.
            
            if(!empty($todo = Like::find($id))){
                $todo->delete();

                return ['request' => $request, 'like_id' => $id];

            }
        }

    }
}
