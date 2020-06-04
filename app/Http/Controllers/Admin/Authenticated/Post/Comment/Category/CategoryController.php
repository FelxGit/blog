<?php

namespace App\Http\Controllers\Admin\Authenticated\Post\Comment\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\Category;//
use App\Http\Requests\Admin\Post\CategoryValidate;//
use DB;


class CategoryController extends Controller
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
        $categories = Category::paginate(5);
        return view('admin/authenticated/post/comment/category/index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/authenticated/post/comment/category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CategoryValidate $categoryRequest)
    {
        
    //Validate Post Request
        
        if(!empty($validated = $categoryRequest->validated())){


        //Insert data

            $category = new Category;

            $category->name  = $request->input('name');
            $category->slug  = $request->input('slug');

            $category->save();


            return redirect()->route('admin.category.index');
        }


        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin/authenticated/post/comment/category/show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin/authenticated/post/comment/category/edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, CategoryValidate $categoryRequest)
    {

        //validated update data before save
        $validated = $categoryRequest->validated();

        //update 
        if(!empty($category = Category::find($id))){

            $category->name  = $request->input('name');
            $category->slug  = $request->input('slug');
            $category->save();
       
            return redirect()->route('admin.category.index');
        }

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!empty($id)){
    
            if(!empty($category = Category::find($id))){

                if(!empty($category = $category->delete())){
                    return redirect()->route('admin.category.index');
                }
            }
        }
        
        return redirect()->route('admin.category.index');    
    }
}
