<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Resources\Country as CountryResource;
use Illuminate\Support\Facades\App;
class CountryController extends BaseController
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
            $countries = Country::select('id','name', 'iso' , 'phone', 'image')->get();
        }elseif($lang == 'ar'){
            $countries = Country::select('id','name_local as name', 'iso' , 'phone', 'image')->get();
        }
       

        //add image url 
        foreach($countries as $country){
            $country->image = asset('uploads/country/' . $country->image);
        }
    
        return $this->sendResponse(CountryResource::collection($countries), 'Countries retrieved successfully.');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
  
        if (is_null($country)) {
            return $this->sendError('Country not found.');
        }
   
        return $this->sendResponse(new CountryResource($country), 'Country retrieved successfully.');
    }
}
