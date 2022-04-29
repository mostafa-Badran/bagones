<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Resources\Category as CategoryResourse;
class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = App::getLocale();
        // dd($lang );
        if($lang == 'en'){
            $categories = Category::select('id','name','image' )->where('parent_id', null)->paginate(10);
        }elseif($lang == 'ar'){
            $categories = Category::select('id','name_locale as name', 'image' )->where('parent_id', null)->paginate(10);
        }
        

        foreach($categories as $category){
            $category->image = asset('uploads/category/' . $category->image);
            // array_push($results, $category);
        }

        return $this->sendResponse($categories, 'categories retrieved successfully.');
    }

    public function getSubCategories($id){
        $lang = App::getLocale();
        $name = 'name as name' ; 

        if($lang == 'ar'){
            $name = 'name_locale as name';
        }
        $categories = Category::select('id',$name,'image', 'parent_id' )->where('parent_id', $id)->paginate(10);   
        
        foreach($categories as $category){
            $category->image = asset('uploads/category/' . $category->image);
            // array_push($results, $category);
        }
     
        return $this->sendResponse($categories, 'SubCategories retrieved successfully.');
    }

    public function getParentCategory($id){

        

        $category = Category::find($id);
        if (is_null($category)) {
            return $this->sendError('category not found.');
        }
        if (is_null($category->parent_id)) {
            return $this->sendError('This is a main category');
        }
   
        $lang = App::getLocale();
        $name = 'name as name' ;        
        if($lang == 'ar'){
            $name = 'name_locale as name';
        }
        $categories = Category::select('id',$name,'image', 'parent_id' )->where('id', $category->parent_id)->get(); 
        
        
        foreach($categories as $category){
            $category->image = asset('uploads/category/' . $category->image);
            // array_push($results, $category);
        }

        $message = $categories->parent_id == null ? 'category': 'subCategory';
        return $this->sendResponse($categories, $message .' retrieved successfully.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
