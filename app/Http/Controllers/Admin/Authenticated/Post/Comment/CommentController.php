<?php

namespace App\Http\Controllers\Admin\Authenticated\Post\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\CommentValidate;
use App\Model\User\Comment;
use App\Model\User\Post;
use Illuminate\Support\Facades\Auth;
use App\Model\Admin\Admin;

class CommentController extends Controller
{
    public function __construct()
    {
        
        //$this->middleware('admin.verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::paginate(5);
        return view('admin/authenticated/post/comment/index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/authenticated/post/comment/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,CommentValidate $commentRequest)
    {
        //validate comment request
        if(!empty($validated = $commentRequest->validated())){
        //store
            $comment = new Comment;

            $comment->admin_id    = Auth::guard('admin')->user()->id;
            $comment->post_id     = $request->input('id');
            $comment->title       = ($request->input('title')) ? '<strong>'.$request->input('title').'</strong>' : '';
            $comment->description = $request->input('description');

            $comment->save();
        
            $message = '';

            if($comment){
                $message = 'Successfully Added';
            }

            return redirect()->route('admin.comment.index')->with('stored',$message);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin/authenticated/post/comment/show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('admin/authenticated/post/comment/edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, CommentValidate $commentRequest)
    {
        $validated = $commentRequest->validated();

        $comment = Comment::find($id);

        $comment->admin_id    = Auth::guard('admin')->user()->id;
        $comment->post_id     = $request->input('id');
        $comment->title       = ($request->input('title')) ? '<strong>'.$request->input('title').'</strong>' : '';
        $comment->description = $request->input('description');

        $comment->save();

        $message = '';

        if($comment){
            $message = 'Successfully Edited';
        }

        return redirect()->route('admin.comment.index')->with('updated',$message);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!empty($comment = Comment::find($id))){

            if(!empty($delete = $comment->delete())){

                $message = '';

                if($delete){
                    $message = 'Successfully Deleted';
                }

                return redirect()->route('admin.comment.index')->with('deleted',$message);

            }
        }
    }

}
