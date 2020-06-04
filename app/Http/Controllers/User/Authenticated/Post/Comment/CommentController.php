<?php

namespace App\Http\Controllers\User\Authenticated\Post\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Post;
use App\Model\user\Comment;
use Illuminate\Support\Facades\Auth;
use App\Model\user\Notification;
use App\Http\Requests\User\Post\Comment\CommentValidate;


class CommentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $post_id, CommentValidate $requestValidate)
    {
        
         //store
        if(!empty($post_id)){
            if(!empty($validated = $requestValidate->validated())){
                
                $comment = new Comment;
                $comment->user_id     = Auth::user()->id;
                $comment->post_id     = $post_id;
                $comment->title       = ($request->input('title')) ? '<strong>'.$request->input('title').'</strong>' : '';
                $comment->description = $request->input('description');
                $comment->approve     = true;

                $comment->save();

                if(!empty($comment)){
                    if(!empty($post = Post::find($post_id))){
                        
                    //make notification
                        $noti = new Notification;

                        $noti->user_id = ($post->user_id)? $post->user_id : $post->admin_id;
                        $noti->from_user_id  = Auth::user()->id;
                        $noti->post_id       = $post_id;
                        $noti->comment_id    = $comment->id;
                        $noti->message       = 'Your post recieved a comment from '.Auth::user()->name.'.<br/>'.'<small>'.date('m-d-Y').'</small>';
                        $noti->save();

                        return ['store' => 'Store Success.'];   
                        // return response()->json(['store' => 'Store Success.']);
                    } 
                }
            }
        }

            // return response()->json(['test1' => 'this is test 1','test2' => 'this is test 2']); will trigger only if no other return is  present and will be considered ajax success. not sure
    }

}
