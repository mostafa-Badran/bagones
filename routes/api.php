<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Language;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use Faker\Extension\CountryExtension;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get("/languages", function(){
//     return Language::all();
// });


Route::get("/countries", function(){    
    $data =  Country::all();    
    $results = [];
    foreach($data as $country){
        $country->image = asset('uploads/country/' . $country->image);
        array_push($results, $country);
    }
    return $results;
});
Route::get('countriesArabic', [CountryController::class,'getCountryArabicNames']);
Route::get('countriesEnglish', [CountryController::class,'getCountryEnglishNames']);



Route::get("/cities", function(){
    return City::all();
});
Route::get('citiesArabic', [CityController::class,'getCityArabicNames']);
Route::get('citiesEnglish', [CityController::class,'getCityEnglishNames']);



Route::get("/areas", function(){
    return Area::all();
});
Route::get('areasArabic', [AreaController::class,'getAreaArabicNames']);
Route::get('areasEnglish', [AreaController::class,'getAreaEnglishNames']);
