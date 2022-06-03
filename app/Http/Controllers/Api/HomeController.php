<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Home;
use App\Models\Category;

class HomeController extends BaseController
{
    

  
    public function index()
    {

            //select all records
            $homeRecords = Home::all();
            // $ = Home::all();
            $result =[];

            foreach ($homeRecords as $key => $homeRecord) {
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
                $subCategory = $homeRecord->subCategory;
                $subCategory->image = asset('uploads/category/' . $subCategory->image);
                $data['sub_category']=$subCategory;

               }
               elseif( strtolower( $homeRecord->content_type->name) == 'item'){
                $data['content_type'] = 'item';
                $data['appearance'] = $homeRecord->appearance->number;
                //item 
                //Todo bring item
                $data['item'] = [];
               }
               elseif(strtolower( $homeRecord->content_type->name) == 'store'){
                $data['content_type'] = 'store';
                $data['appearance'] = $homeRecord->appearance->number;
                //store 
            
               }
               array_push($result , $data);
               
            }//end for
        
            return $this->sendResponse($homeRecords, 'home retrieved successfully.');
            
       
    }



}