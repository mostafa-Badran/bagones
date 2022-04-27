<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Http\Resources\Country as CountryResource;
use App\Http\Resources\Country as CityResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
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

    public function getCities($id){
        
        $lang = App::getLocale();
        $name = 'name as name' ; 
        if($lang == 'ar'){
            $name = 'name_local as name';
        }
        $cities= DB::table('countries')->join('cities','countries.id','=','cities.country_id')->select('cities.id as id','cities.'.$name,'country_id')->where('countries.id','=',$id)->get();
        
        return $this->sendResponse($cities, 'Cities retrieved successfully.');
    }
    public function getAreasByCountry($id){
        
        $lang = App::getLocale();
        $name = 'name as name' ; 
        if($lang == 'ar'){
            $name = 'name_local as name';
        }
        $areas= DB::table('countries')
        ->join('cities','countries.id','=','cities.country_id')
        ->join('areas','areas.city_id','=','cities.id')
        ->select('areas.id as id','areas.'.$name,'city_id')
        ->where('countries.id','=',$id)->get();

        
        return $this->sendResponse($areas, 'Areas retrieved successfully.');
    }
}
