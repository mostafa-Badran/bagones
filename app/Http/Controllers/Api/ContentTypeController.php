<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Models\Content_type;
use App\Models\Category;
class ContentTypeController extends BaseController
{

    public function index(){
        $content_types =  Content_type::paginate(10);
        return $this->sendResponse($content_types, 'appearances retrieved successfully.');
    }
    public function getAppearances($id){
        
        // return $this->sendResponse($content_types, 'appearances retrieved successfully.');
        $content_type = Content_type::find($id);
        $appearances = $content_type->appearances;
        foreach($appearances as $appearance){
            $response[] = array(
                 "id"=>$appearance->id,
                 "text"=>$appearance->number
            );
         }
         return response()->json($response);
    }


    public function show($id){
        
        $data =[];
        $response =[];
        $lang = App::getLocale();
        $content_type = Content_type::find($id);
        $response['content_type'] = $content_type->appearances;
        // $response['appearances'] = $content_type->appearances;

        
        

        // switch ($id) {
        //     case $id === 1 :
        //         //1 - offer
        //         break;
        //     case $id === 2 :
        //         //2 - category               
        //         if($lang == 'en'){
        //             $data = Category::select('id','name','image' )->where('parent_id', null)->paginate(10);
        //         }elseif($lang == 'ar'){
        //             $data = Category::select('id','name_locale as name', 'image' )->where('parent_id', null)->paginate(10);
        //         }
        //         foreach($data as $category){
        //             $category->image = asset('uploads/category/' . $category->image);
        //         }
        //         // $data  = $categories;
        //         break;
        //     case $id === 3 :
        //         //3 - subCategory
        //         if($lang == 'en'){
        //             $data = Category::select('id','name', 'parent_id' )->where('parent_id','!=', null)->paginate(10);
        //         }elseif($lang == 'ar'){
        //             $data = Category::select('id','name_locale as name', 'parent_id' )->where('parent_id','!=', null)->paginate(10);
        //         }
        //         foreach($data as $category){
        //             $category->image = asset('uploads/category/' . $category->image);
        //         }
        //         // $data = $categories;
        //         break;
        //     case $id === 4 :
        //         //1 - item
        //         break;
        //     case $id === 5 :
        //         //1 - store
        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }
        // dd($data);
        // $response['data'] = $data;
        return $this->sendResponse($response, 'appearances retrieved successfully.');


    }



      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $content_type = Content_type::find($id);
    // }



}