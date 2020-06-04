<?php

namespace App\Http\Controllers\Admin\Authenticated\Post\Comment\Tag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\Tag;//
use App\Http\Requests\Admin\Post\TagValidate;//
use DB;


class TagController extends Controller
{
    public function __construct()
    {
        // $this->middleware('admin.verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('admin/authenticated/post/comment/tag/index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/authenticated/post/comment/tag/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TagValidate $tagRequest)
    {
        
    //Validate Post Request
        if(!empty($validated = $tagRequest->validated())){

        //Insert data
            $tag = new Tag;
            $tag->name  = $request->input('name');
            $tag->slug  = $request->input('slug');
            $tag->save();
            
            if(!empty($tag)){
                return redirect()->route('admin.tag.index');
            }
        }

        return redirect()->route('admin.tag.index');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tags = Tag::find($id);
        return view('admin/authenticated/post/comment/tag/show',compact('tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin/authenticated/post/comment/tag/edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, TagValidate $tagRequest)
    {

        //validated update data before save
        if(!empty($validated = $tagRequest->validated())){

            //update 
            if(!empty($tag = Tag::find($id))){
              
                $tag->name = $request->input('name');
                $tag->slug = $request->input('slug');
                $tag->save();

                return redirect()->route('admin.tag.index');
            }       
        }

        return redirect()->route('admin.tag.index');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get tag
        if(!empty($tag = DB::table('tags')->where('id',$id)->first())){
            
            //delete tag
            if(!empty($tag->delete())){

               return redirect()->route('admin.tag.index'); 
            }
        }

        return redirect()->route('admin.tag.index')->with('message','Delete failed.');        
    }

}
