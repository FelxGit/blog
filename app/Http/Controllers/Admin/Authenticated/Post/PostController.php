<?php

namespace App\Http\Controllers\Admin\Authenticated\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\Post;//
use App\Model\User\Category;//
use App\Model\User\Tag;//
use App\Http\Requests\Admin\Post\PostValidate;//
use DB;//
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
        // $this->middleware('admin.verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin/authenticated/post/index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/authenticated/post/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PostValidate $postRequest)
    {

    //Validate Post Request
        
        if(!empty($validated = $postRequest->validated())){

        //Insert data
            $post = new Post;

            $post->admin_id  = Auth::guard('admin')->user()->id;
            $post->title    = $request->input('title');
            $post->subtitle = $request->input('subtitle');
            $post->slug     = $request->input('slug');
            $post->body     = $request->input('body');

            $post->save();

            
            if(!empty($post)){

                //sync relationships
                $post->tags()->sync($request->tags);
                $post->categories()->sync($request->categories);

                $message = '';
                if($post){
                    $message = 'Successfully Added';
                }

                return redirect()->route('admin.post.index')->with('stored',$message);
            }
        }

        return redirect()->route('admin.post.index');

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
        return view('admin/authenticated/post/show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $post = Post::find($id);

        return view('admin/authenticated/post/edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id,PostValidate $postRequest)
    {

        if(!empty($validated = $postRequest->validated())){

            if(!empty($post = Post::find($id))){

                $post->update([
                    //'posted_by'  => Auth,
                    'title'      => $request->input('title'),
                    'subtitle'   => $request->input('subtitle'),
                    'slug'       => $request->input('slug'),
                    'body'       => $request->input('body'),
                    //'status'     => ($request->input('status')) ? 1:0,
                    //'image'      => $request->input('image'),
                    //'like'       => null,
                    //'dislike'    => null,
                ]);


                $post->tags()->sync($request->tags);
                $post->categories()->sync($request->tags);

                $message = '';
                if($post){
                    $message = 'Successfully Updated';
                }

                return redirect()->route('admin.post.index')->with('updated',$message);
            }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find post id
        if(!empty($post = Post::find($id))){
            
            //delete 
            if(!empty($delete = $post->delete())){
                
                //detach relations
                $post->tags()->detach();
                $post->categories()->detach();

                $message = '';
                if($delete){
                    $message = 'Successfully Deleted';
                }

                return redirect()->route('admin.post.index')->with('deleted',$message);          
            }
        }

        return redirect()->route('admin.post.index'); 
    }

}
