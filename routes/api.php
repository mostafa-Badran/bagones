<?php

// use App\Http\Controllers\CityController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Language;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\CategoryController;

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




// Route::get("/countries/{id}", function(){    
//     $data =  Country::all();    
//     $results = [];
//     foreach($data as $country){
//         $country->image = asset('uploads/country/' . $country->image);
//         array_push($results, $country);
//     }
//     return $results;
// });
// Route::get('countriesArabic', [CountryController::class,'getCountryArabicNames']);
// Route::get('countriesEnglish', [CountryController::class,'getCountryEnglishNames']);



Route::resource('countries', '\App\Http\Controllers\Api\CountryController')->middleware('locale.check');
Route::get('/countries/{id}/cities', [CountryController::class,'getCities'])->middleware('locale.check');
Route::get('/countries/{id}/areas', [CountryController::class,'getAreasByCountry'])->middleware('locale.check');
Route::get('/cities/{id}/areas', [CityController::class,'getAreas'])->middleware('locale.check');
Route::resource('cities', '\App\Http\Controllers\Api\CityController')->middleware('locale.check');
Route::resource('areas', '\App\Http\Controllers\Api\AreaController')->middleware('locale.check');





// Route::get("/cities", function(){
//     return City::all();
// });
// Route::get('citiesArabic', [CityController::class,'getCityArabicNames']);
// Route::get('citiesEnglish', [CityController::class,'getCityEnglishNames']);



// Route::get("/areas", function(){
//     return Area::all();
// });
// Route::get('areasArabic', [AreaController::class,'getAreaArabicNames']);
// Route::get('areasEnglish', [AreaController::class,'getAreaEnglishNames']);
