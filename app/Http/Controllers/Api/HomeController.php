<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Home;
use App\Models\Category;
use Illuminate\Support\Facades\App;

class HomeController extends BaseController
{
    

  
    public function index()
    {

            $lang = App::getLocale();
            //select all records
            $homeRecords = Home::paginate(6);
            $updatedItems = $homeRecords->getCollection();


            // $ = Home::all();
            $result =[];

            foreach ($updatedItems as $key => $homeRecord) {
                $data = [];
               if(strtolower( $homeRecord->content_type->name) == 'offer'){
                $data['content_type'] = 'offer';
                $data['appearance'] = $homeRecord->appearance->number;
               }
               elseif(strtolower( $homeRecord->content_type->name) == 'category'){
                $data['content_type'] = 'category';
                $data['appearance'] = $homeRecord->appearance->number;
               }
               elseif(strtolower( $homeRecord->content_type->name) == 'sub category'){
                $data['content_type'] = 'sub_category';
                $data['appearance'] = $homeRecord->appearance->number;
                
                $subCategory =[
                    'id'=>$homeRecord->subCategory->id,
                    'name'=>$lang == 'en' ? $homeRecord->subCategory->name : $homeRecord->subCategory->name_locale,
                    'parent_id' => $homeRecord->subCategory->parent_id,
                    'image'=> $homeRecord->subCategory->image != null ? asset('uploads/category/' . $homeRecord->subCategory->image): $homeRecord->subCategory->image 
                ];
                
                $data['sub_category']=$subCategory;

               }
               elseif( strtolower( $homeRecord->content_type->name) == 'item'){
                $data['content_type'] = 'item';
                $data['appearance'] = $homeRecord->appearance->number;
                //item 
                //Todo bring item  
                $data['item']= $homeRecord->item->getByLang($lang);
                
               }
               elseif(strtolower( $homeRecord->content_type->name) == 'store'){
                $data['content_type'] = 'store';
                $data['appearance'] = $homeRecord->appearance->number;
                //store 
            
               }
               array_push($result , $data);
               
            }//end for
          

            $homeRecords->setCollection(collect($result));
            return $this->sendResponse($homeRecords, 'home retrieved successfully.');
            
       
    }



}
