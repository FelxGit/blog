<?php

namespace App\Http\Controllers\User\Authenticated\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User\Post;
use App\Http\Controllers\Controller;
use App\Model\User\Category;
use App\Model\User\Tag;
use App\Http\Requests\User\Post\PostValidate;
use App\Model\User\User;
use App\Model\User\Profile;
use App\Model\User\File;



class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('verified');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $categories = Category::all();
        $tags = Tag::all();
        $notifications = Auth::user()->notifications()->where([
                                              ['user_id',Auth::user()->id],
                                              ['from_user_id','!=',Auth::user()->id],
                         ])->orderBy('created_at','DESC')->get();  


        return view('user/authenticated/post/create',compact('categories','tags','notifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PostValidate $requestValidate)
    {

        if(!empty($requestValidate->validated())){
        

            if(!empty($post = new Post)){
               
                $post->user_id  = Auth::user()->id;
                $post->title    = $request->input('title');
                $post->subtitle = $request->input('subtitle');
                $post->slug     = $request->input('slug');
                $post->status   = (!empty($request->input('status')))? 1 : 0;
                $post->body     = $request->input('body');
                $post->save();

                if(!empty($post)){

                    //sync relationships
                    $post->tags()->sync($request->input('tags'));
                    $post->categories()->sync($request->input('categories'));

                    return redirect()->route('user.post.show',['slug' => $post->slug])->with('message','Create success');
                }
            }
        }

        return redirect()->route('user.post.show',['slug' => $post->slug])->with('message','Create failed');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Post $post)
    {
        if(!empty($post)){

            //by default, get is used by mapping. Unless, if a query is present then you implement get() manually
            $comments = $post->comments()->orderBy('created_at','DESC')->get();

            $notifications = Auth::user()->notifications()->where([
                                  ['user_id',Auth::user()->id],
                                  ['from_user_id','!=',Auth::user()->id],
             ])->orderBy('created_at','DESC')->get();  

            return view('user/authenticated/post/show',compact('post','comments','notifications'));
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        if(!empty($post)){

             $notifications = Auth::user()->notifications()->where([
                                      ['user_id',Auth::user()->id],
                                      ['from_user_id','!=',Auth::user()->id],
                 ])->orderBy('created_at','DESC')->get();  


            return view('user/authenticated/post/edit',compact('post','notifications'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Post $post, PostValidate $requestValidate)
    {
        
        $validated = $requestValidate->validated();
        
        if(!empty($post = Post::find($post->id))){

            $post->user_id  = Auth::user()->id;
            $post->title    = $request->input('title');
            $post->subtitle = $request->input('subtitle');
            $post->slug     = $request->input('slug');
            $post->status   = (!empty($request->input('status')))? 1 : 0;
            $post->body     = $request->input('body');
            $post->save();

            if(!empty($post)){

                //sync relationships
                $post->tags()->sync($request->input('tags'));
                $post->categories()->sync($request->input('categories'));

                return redirect()->route('user.post.show',['slug' => $post->slug])->with('message','Update successs');
            }
        }

        return redirect()->route('user.post.show',['slug' => $post->slug])->with('message','Failed to update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(!empty($method1 = Post::find($post->id))){
                
                $method1->delete();
                $method1->tags()->detach();
                $method1->categories()->detach();

                return redirect()->route('user.home')->with('message','Delete success');

        }
        // else{
            
        //     if(!empty($post = Auth::user()->posts->where('id',$post->id);
        // }

        return redirect()->route('user.post.show',['post' => $post->slug])->with('message','Delete failed');
    }
}
