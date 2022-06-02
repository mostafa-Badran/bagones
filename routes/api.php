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
use App\Http\Controllers\Api\CategoryController;
// use App\Http\Controllers\CategoryController;

use Database\Seeders\CategorySeeder;

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

Route::resource('categories', '\App\Http\Controllers\Api\CategoryController')->middleware('locale.check');

Route::get('/categories/{id}/subCategories',  [CategoryController::class,'getSubCategories' ])->middleware('locale.check');

Route::get('/subCategories/{id}/parent',  [CategoryController::class,'getParentCategory' ])->middleware('locale.check');

Route::resource('subCategories', '\App\Http\Controllers\Api\SubCategoryController')->middleware('locale.check');

Route::post('/category/dataAjax', [ App\Http\Controllers\CategoryController::class, 'dataAjax']);

Route::get('/subcategory/dataAjax', [ App\Http\Controllers\Api\SubCategoryController::class, 'dataAjax']);





Route::resource('contentTypes', '\App\Http\Controllers\Api\ContentTypeController')->middleware('locale.check');
Route::get('home', [\App\Http\Controllers\Api\HomeController::class , 'index'])->middleware('locale.check');

Route::post('/contentTypes/{id}/appearance',  [App\Http\Controllers\Api\ContentTypeController::class,'getAppearances' ])->middleware('locale.check');


Route::post('/country/cities', [App\Http\Controllers\CityController::class, 'get_city_select_list']);
Route::post('/city/areas', [App\Http\Controllers\AreaController::class, 'get_area_select_list']);


// Route::resource('item', '\App\Http\Controllers\Api\ContentTypeController')->middleware('locale.check');
Route::get('item/filter', [\App\Http\Controllers\Api\ItemController::class , 'items'])->middleware('locale.check');
Route::get('item/{item}', [\App\Http\Controllers\Api\ItemController::class , 'show'])->middleware('locale.check');
Route::get('item/suggested_items', [\App\Http\Controllers\Api\ItemController::class , 'suggested_items'])->middleware('locale.check');

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
