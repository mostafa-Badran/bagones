<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Home;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemImage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Models\Attribute;
use App\Models\Attribute_entry;
use App\Models\Compulsory_choice;
use App\Models\Compulsory_choice_entry;
use App\Models\Multiple_choice;
use App\Models\Multiple_choice_entry;

class ItemController extends BaseController
{
    

  
    public function index()
    {                 
    }

    public function items(Request $request){
        //add pagination
        //price filter is new price
        //price_from , price_to , sub_category_id , in_stock , city_id related to store  , Area_list 
        // $price_from = 0;
        // $price_to=0;
        // $sub_category_id=0;
        // $in_stock=0;
 
        // DB::enableQueryLog();
        // dd($request);
        
        $lang = App::getLocale();

        $query = DB::table('items')            
                    ->leftjoin('stores', 'stores.id', '=', 'items.store_id')
                    ->leftjoin('categories as sub_category', 'sub_category.id', '=', 'items.sub_category_id')
                    ->leftjoin('categories', 'categories.id', '=', 'sub_category.parent_id')
                    ->leftjoin('areas', 'stores.area_id', '=', 'areas.id')
                    ->leftjoin('cities', 'areas.city_id', '=', 'cities.id');

        if($lang == 'en'){          
           $query->select('items.id','items.name','items.description','items.price','items.new_price', 'items.main_screen_image','items.cover_image' , 'items.in_stock' , 'stores.name as store_name' , 'sub_category.name as sub_category_name' , 'stores.id as store_id', 'sub_category.id as sub_category_id' );
         
        }elseif($lang == 'ar'){         
           $query->select('items.id','items.name_locale as name','items.description_locale as description','items.price','items.new_price', 'items.main_screen_image','items.cover_image' , 'items.in_stock' , 'stores.name_locale as store_name' , 'sub_category.name_locale as sub_category_name','stores.id as store_id', 'sub_category.id as sub_category_id' );
        }

        if(!empty($request['sub_category_id'] ) ){
            $sub_category_id = $request['sub_category_id'];
            $query->where('sub_category.id' ,$sub_category_id);
        }
        
        if(!empty($request['category_id'] ) )
        {
            $category_id = $request['category_id'];

            // $query->where('categories.id' ,   $category_id);
            $query->where('sub_category.parent_id' , $category_id);
        }


        if(!empty($request['in_stock']) ){
            $in_stock = $request['in_stock'];            
            $query->where('items.in_stock' ,$in_stock);
        }

        if(!empty($request['price_from'])  ){        
            $price_from = $request['price_from'];
            $query->where('items.new_price' ,'>=' ,   $price_from);
        }

        if(!empty($request['price_to'] ) )
        {
            $price_to = $request['price_to'];
            $query->where('items.new_price' ,'<=' ,   $price_to);
        }       

       
       

        if(!empty($request['store_id']) ){
            $store_id = $request['store_id'];            
            $query->where('items.store_id' ,$store_id);
        }

        if(!empty($request['city_id']) ){
            $city_id = $request['city_id'];            
            $query->where('areas.city_id' ,$city_id);
        }
        

        if(!empty($request['area_id']) ){
            // $area_ids = explode(",",$request['area_id']); 
            $area_id = $request['area_id']; 
                      
            $query->where('stores.area_id' ,$area_id);
            // $query->where(function($inner_query) use ($area_ids){

            //     foreach ($$area_ids as $key => $area_id) {
            //         if($key == 0 ){
            //             $inner_query->where(function($inner_query) use ($area_id){
            //                 $query->where('starttime', '<=', $starttime);
            //             });
            //         }
                   
            //     }
               

            //     $query->orWhere(function($query) use ($otherStarttime,$otherEndtime){
            //         $query->where('starttime', '<=', $otherStarttime);
            //         $query->where('endtime', '>=', $otherEndtime);
            //     });

                
            // }
        }

        //the store needs to be active
        $query->where('stores.is_open' ,1);
       
        $result = $query->paginate(10);
        $updatedItems = $result->getCollection();
        foreach ($updatedItems as $key => $item) {
            if($item->main_screen_image != null){
                $item->main_screen_image = asset('uploads/items/' . $item->main_screen_image);
            }

        }
        $result->setCollection($updatedItems);
        // $result = $query->toSql();        
        // dd(DB::getQueryLog());
      
        return $this->sendResponse($result, 'items retrieved successfully.');

    }


    public function show($id)
    {
        //TODO join item images
        $lang = App::getLocale();
        $query = DB::table('items')
                ->leftjoin('stores', 'stores.id', '=', 'items.store_id')
                ->leftjoin('categories', 'categories.id', '=', 'items.sub_category_id');
        if($lang == 'en'){
            $query ->select('items.id','items.name','items.description','items.price','items.new_price', 'items.main_screen_image' , 'items.in_stock' , 'stores.id as store_id','stores.name as store_name' ,'categories.id as sub_category_id' ,'categories.name as sub_category_name' );
         
        }elseif($lang == 'ar'){
            $query ->select('items.id','items.name_locale as name','items.description_locale as description' , 'items.price','items.new_price', 'items.main_screen_image', 'items.cover_image' ,'items.in_stock','stores.id as store_id' ,'stores.name_locale as store_name' ,'categories.id as sub_category_id' ,'categories.name_locale  as sub_category_name' );
           
        }

        $item = $query->where('items.id', $id)->get();

        if($item[0] ->main_screen_image != null){
            $item[0]->main_screen_image  = asset('uploads/items/' . $item[0]->main_screen_image);
        }
        // if($item[0] ->cover_image != null){
        //      $item[0]->cover_image  = asset('uploads/items/' . $item[0]->cover_image);
        // }
        // ->leftjoin('attribute_item' , 'attribute_item.item_id','=',$id )
        // ->leftjoin('attributes' , 'attributes.id','=','attribute_item.attribute_id')
        // var_dump($item);exit;
        
        // $result = $query->toSql();        
        // dd($result);
        
        if (is_null($item)) {
            return $this->sendError('Item not found.');
        }

        //item images
        $images = ItemImage::where('item_id' , $id)->get();
        $item[0]->images= $images;

        //get attributes
       $attributes_query = Attribute ::leftjoin('attribute_item' , 'attribute_item.attribute_id' , '=' ,'attributes.id' );
       if($lang == 'en'){
        $attributes_query ->select('id','name' , 'description');
       }elseif($lang=='ar'){
        $attributes_query ->select('id','name_locale as name' , 'description_locale as description');
       }
       $attributes_query ->where('attribute_item.item_id' , $id);
       $attributes = $attributes_query->get();
       $item[0]->attributes= $attributes;
       $attribute_entries =[];
        //get attribute entries
        foreach ($attributes as $index => $attribute) {
            if($lang == 'en'){
                $attribute_entries = Attribute_entry::select('id','name')->where('attribute_id' ,$attribute->id )->get();
               
               }elseif($lang=='ar'){
                $attribute_entries = Attribute_entry::select('id','name_locale as name')->where('attribute_id' ,$attribute->id )->get();
               }

               $attribute->entries = $attribute_entries;
        }

        
        //get compulsory choices


        $compulsory_choice_query = Compulsory_choice ::leftjoin('compulsory_choice_item' , 'compulsory_choice_item.compulsory_choice_id' , '=' ,'compulsory_choices.id' );
        if($lang == 'en'){
         $compulsory_choice_query ->select('id','name' , 'description');
        }elseif($lang=='ar'){
         $compulsory_choice_query ->select('id','name_locale as name' , 'description_locale as description');
        }
        $compulsory_choice_query ->where('compulsory_choice_item.item_id' , $id);
        $compulsory_choices = $compulsory_choice_query->get();
        $item[0]->compulsory_choices= $compulsory_choices;
        $compulsory_choice_entries =[];
         //get attribute entries
         foreach ($compulsory_choices as $index => $compulsory_choice) {
             if($lang == 'en'){
                 $compulsory_choice_entries = Compulsory_choice_entry::select('id','name')->where('compulsory_choice_id' ,$compulsory_choice->id )->get();
                
                }elseif($lang=='ar'){
                 $compulsory_choice_entries = Compulsory_choice_entry::select('id','name_locale as name')->where('compulsory_choice_id' ,$compulsory_choice->id )->get();
                }
 
                $compulsory_choice->entries = $compulsory_choice_entries;
         }



        //get multiple choices

        $multiple_choice_query = Multiple_choice ::leftjoin('item_multiple_choice' , 'item_multiple_choice.multiple_choice_id' , '=' ,'multiple_choices.id' );
        if($lang == 'en'){
         $multiple_choice_query ->select('id','name' , 'description');
        }elseif($lang=='ar'){
         $multiple_choice_query ->select('id','name_locale as name' , 'description_locale as description');
        }
        $multiple_choice_query ->where('item_multiple_choice.item_id' , $id);
        $multiple_choices = $multiple_choice_query->get();

        $item[0]->multiple_choices= $multiple_choices;

        $multiple_choice_entries =[];
         //get attribute entries
         foreach ($multiple_choices as $index => $multiple_choice) {
             if($lang == 'en'){
                 $multiple_choice_entries = Multiple_choice_entry::select('id','name')->where('multiple_choice_id' ,$multiple_choice->id )->get();
                
                }elseif($lang=='ar'){
                 $multiple_choice_entries = Multiple_choice_entry::select('id','name_locale as name')->where('multiple_choice_id' ,$multiple_choice->id )->get();
                }
 
                $multiple_choice->entries = $multiple_choice_entries;
         }
     
   
        return $this->sendResponse($item[0], 'item retrieved successfully.');
    }



    public function suggested_items(Request $request ){

        $lang = App::getLocale();

        $query = DB::table('items') 
                    ->leftjoin('categories', 'categories.id', '=', 'items.sub_category_id');   
        

        if($lang == 'en'){          
            $query->select('items.id','items.name','items.description','items.price','items.new_price', 'items.main_screen_image' , 'items.in_stock' , 'stores.name as store_name' , 'categories.name as sub_category_name','stores.id as store_id', 'categories.id as sub_category_id' );
            
        }elseif($lang == 'ar'){         
            $query->select('items.id','items.name_locale as name','items.description_locale as description','items.price','items.new_price', 'items.main_screen_image' , 'items.in_stock' , 'stores.name_locale as store_name' , 'categories.name_locale as sub_category_name','stores.id as store_id', 'categories.id as sub_category_id' );
        }
            $query_one = $query;
            $query_two = $query;
            $query_three = $query;
        if(!empty($request['category_id'] ) )
        {
            $category_id = $request['category_id'];
            
        }
        if(!empty($request['sub_category_id'] ) ){
            $sub_category_id = $request['sub_category_id'];
           
        }
        if(!empty($request['price_to'] ) )
        {
            $price_to = $request['price_to'];
            
        }
        if(!empty($request['price_from'])  ){        
            $price_from = $request['price_from'];
            
        }  
        $query_one->where('categories.parent_id' , $category_id);
        $query_one->where('items.sub_category_id' ,$sub_category_id);
        $query_one->where('items.new_price' ,'<=' , $price_to);
        $query_one->where('items.new_price' ,'>=' , $price_from);
        $result = $query_one->paginate(10);
        if(!empty($result['data']['data']) ){
            return $this->sendResponse($result, 'Suggested Items retrieved successfully.');
           
        }else{
            $query_two->where('categories.parent_id' , $category_id);
            $query_two->where('items.new_price' ,'<=' , $price_to);
            $query_two->where('items.new_price' ,'>=' , $price_from);

            $result2 = $query_two->paginate(10);

            if(!empty($result2['data']['data'])){
                return $this->sendResponse($result2, 'Suggested Items retrieved successfully.');
            }else{
                $query_three->where('items.new_price' ,'<=' , $price_to);
                $query_three->where('items.new_price' ,'>=' , $price_from);
                $result3 = $query_three->paginate(10);
                if(!empty($result3['data']['data'])){
                    return $this->sendResponse($result2, 'Suggested Items retrieved successfully.');
                }else{
                    return $this->sendResponse([], 'No Suggested Items.');
                }
            }
        }
    


    }


    public function dataAjax(Request $request)
    {
        
        $search = $request->search;

        if($search == ''){
           $items = Item::orderby('name','asc')->limit(5)->get(['id','name']);
        }else{
           $items = Item::orderby('name','asc')->where('name', 'like', '%' .$search . '%')->limit(5)->get(['id','name']);
        }

        // $response = array();
        foreach($items as $item){
           $response[] = array(
                "id"=>$item->id,
                "text"=>$item->name
           );
        }
        return response()->json($response);
    }


}
