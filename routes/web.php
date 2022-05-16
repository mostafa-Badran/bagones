<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');


// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/jquerymask', 'PagesController@jQueryMask');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

// Route::get('/', function () {
//     return view('login');
// })->name('login');
// Route::get('/', function () {
//     // $areas = json_decode(file_get_contents(storage_path() . "/data/locations/areas.json"), true);
//     // //Language::insert();
//     // $a = array();
//     // foreach ($areas as $key => $value) {
//     //     dd($value);
//     //     //array_push($a, ["short_code" => strtoupper($key), "name" => $value["name"]]);
//     // }

//     //echo json_encode($a, 256);
//     //return view('welcome');
// });

Route::post("/login",[UserController::class,'login']);
// Route::get("/",[ItemController::class,'index']);
Route::get("/login",[UserController::class,'index']);
// Route::get("/test",[UserController::class,'test']);

// Route::resource('country',CityController::class);
//Country Routes
Route::get('country', [CountryController::class, 'index'])->name('country.index');
Route::get('country/create', [CountryController::class, 'create'])->name('country.create');
Route::post('country', [CountryController::class, 'store'])->name('country.store');
Route::get('country/{country}', [CountryController::class, 'show'])->name('country.show');
Route::get('country/edit/{country}', [CountryController::class, 'edit'])->name('country.edit');
Route::put('country/{country}', [CountryController::class, 'update'])->name('country.update');
Route::post('country/{country}', [CountryController::class, 'destroy'])->name('country.destroy');

//State Routes
Route::get('state', [StateController::class, 'index'])->name('state.index');
Route::get('state/create', [StateController::class, 'create'])->name('state.create');
Route::post('state', [StateController::class, 'store'])->name('state.store');
Route::get('state/{state}', [StateController::class, 'show'])->name('state.show');
Route::get('state/edit/{state}', [StateController::class, 'edit'])->name('state.edit');
Route::put('state/{state}', [StateController::class, 'update'])->name('state.update');
Route::post('state/{state}', [StateController::class, 'destroy'])->name('state.destroy');
// Route::post('/dataAjax', [StateController::class, 'dataAjax'])->name('dataAjax');

//City Routes
Route::get('city', [CityController::class, 'index'])->name('city.index');
Route::get('city/create', [CityController::class, 'create'])->name('city.create');
Route::post('city', [CityController::class, 'store'])->name('city.store');
Route::get('city/{city}', [CityController::class, 'show'])->name('city.show');
Route::get('city/edit/{city}', [CityController::class, 'edit'])->name('city.edit');
Route::put('city/{city}', [CityController::class, 'update'])->name('city.update');
Route::post('city/{city}', [CityController::class, 'destroy'])->name('city.destroy');
Route::post('city/dataAjax', [CityController::class, 'dataAjax'])->name('city.dataAjax');
Route::post('/dataAjax', [CityController::class, 'dataAjax'])->name('dataAjax');


//Area Routes
Route::get('area', [AreaController::class, 'index'])->name('area.index');
Route::get('area/create', [AreaController::class, 'create'])->name('area.create');
Route::post('area', [AreaController::class, 'store'])->name('area.store');
Route::get('area/{area}', [AreaController::class, 'show'])->name('area.show');
Route::get('area/edit/{area}', [AreaController::class, 'edit'])->name('area.edit');
Route::put('area/{area}', [AreaController::class, 'update'])->name('area.update');
Route::post('area/{area}', [AreaController::class, 'destroy'])->name('area.destroy');



//Language Routes
Route::get('language', [LanguageController::class, 'index'])->name('language.index');
Route::get('language/create', [LanguageController::class, 'create'])->name('language.create');
Route::post('language', [LanguageController::class, 'store'])->name('language.store');
Route::get('language/{language}', [LanguageController::class, 'show'])->name('language.show');
Route::get('language/edit/{language}', [LanguageController::class, 'edit'])->name('language.edit');
Route::put('language/{language}', [LanguageController::class, 'update'])->name('language.update');
Route::post('language/{language}', [LanguageController::class, 'destroy'])->name('language.destroy');



//Category Routes
Route::get('category', [CategoryController::class, 'index']);
Route::get('category/create', [CategoryController::class, 'create']);
Route::post('category/store', [CategoryController::class, 'store']);
Route::get('category/{category}', [CategoryController::class, 'show']);
Route::get('category/edit/{category}', [CategoryController::class, 'edit']);
Route::put('category/update/{category}', [CategoryController::class, 'update']);
Route::post('category/{category}', [CategoryController::class, 'destroy']);
Route::post('category/dataAjax', [CategoryController::class, 'dataAjax']);
// Route::post('category/test', [CategoryController::class, 'test']);

//subCategory Routes
Route::get('subCategory', [SubCategoryController::class, 'index'])->name('subCategory.index');
Route::get('subCategory/create', [SubCategoryController::class, 'create']);
Route::post('subCategory/store', [SubCategoryController::class, 'store'])->name('subCategory.store');
Route::get('subCategory/{category}', [SubCategoryController::class, 'show']);
Route::get('subCategory/edit/{category}', [SubCategoryController::class, 'edit']);
Route::put('subCategory/update/{category}', [SubCategoryController::class, 'update']);
Route::post('subCategory/desrtoy/{category}', [SubCategoryController::class, 'destroy']);
// Route::post('category/dataAjax', [CategoryController::class, 'dataAjax']);
// Route::post('category/test', [CategoryController::class, 'test']);

// Route::post('/dataAjax', [CategoryController::class, 'dataAjax'])->name('dataAjax');


//content_type Routes
Route::get('content_type', [ContentTypeController::class, 'index']);
Route::get('content_type/create', [ContentTypeController::class, 'create']);
Route::post('content_type', [ContentTypeController::class, 'store']);
Route::get('content_type/{content_type}', [ContentTypeController::class, 'show']);
Route::get('content_type/edit/{content_type}', [ContentTypeController::class, 'edit']);
Route::put('content_type/update/{content_type}', [ContentTypeController::class, 'update']);
Route::post('content_type/destroy/{content_type}', [ContentTypeController::class, 'destroy']);

//appearance Routes
Route::get('appearance', [AppearanceController::class, 'index']);
Route::get('appearance/create', [AppearanceController::class, 'create']);
Route::post('appearance', [AppearanceController::class, 'store']);
Route::get('appearance/{appearance}', [AppearanceController::class, 'show']);
Route::get('appearance/edit/{apperance}', [AppearanceController::class, 'edit']);
Route::put('appearance/update/{appearance}', [AppearanceController::class, 'update']);
Route::post('appearance/destroy/{appearance}', [AppearanceController::class, 'destroy']);


//Home Routes
Route::get('home', [HomeController::class, 'index']);
Route::get('home/create', [HomeController::class, 'create']);
Route::post('home', [HomeController::class, 'store']);
Route::get('home/{home}', [HomeController::class, 'show']);
Route::get('home/edit/{home}', [HomeController::class, 'edit']);
Route::put('home/update/{home}', [HomeController::class, 'update']);
Route::post('home/destroy/{home}', [HomeController::class, 'destroy']);


//Store Routes
Route::get('store', [StoreController::class, 'index']);
Route::get('store/create', [StoreController::class, 'create']);
Route::post('store', [StoreController::class, 'store']);
Route::get('store/{store}', [StoreController::class, 'show']);
Route::get('store/edit/{store}', [StoreController::class, 'edit']);
Route::put('store/update/{store}', [StoreController::class, 'update']);
Route::post('store/destroy/{store}', [StoreController::class, 'destroy']);



// Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
