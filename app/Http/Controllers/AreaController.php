<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\City;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    protected $namespace = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = DB::table('areas as aaa')
            ->join('cities as c', 'c.id', '=', 'aaa.city_id')
            ->select('aaa.id','aaa.name','aaa.name_local','c.name as city_name')
            ->get();
            return DataTables::of($data)->make(true);
        }

        $page_title = 'Areas';
        $page_description = 'This page is to show all the records in area table';

        return view('areas.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $page_title = 'Add New Area';
        $page_description = 'This page is to add new record in area table';

        //
        return view('areas.create', compact('page_title', 'page_description','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'unique:areas', 'max:50'],
            'name_local' => ['unique:areas', 'max:50'],
            'city_id' => ['required'],
        ]);

        Area::create($request->all());

        return redirect()->route('area.index')
                        ->with('success','Area created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        $city = City::find($area->city_id);
        $page_title = 'Show Area';
        $page_description = 'This page is to show area details';
        //
        return view('areas.show',compact('area', 'page_title', 'page_description','city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        $city = City::find($area->city_id);
        $page_title = 'Edit Area';
        $page_description = 'This page is to edit record in area table';
        //
        return view('areas.edit',compact('area', 'page_title', 'page_description','city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
        $request->validate([
            'name' => ['required', Rule::unique('areas', 'name')->ignore($area), 'max:50'],
            'name_local' => [Rule::unique('areas', 'name_local')->ignore($area), 'max:50'],
            'city_id' => ['required'],
        ]);

        $area->update($request->all());

        return redirect()->route('area.index')
                        ->with('success','Area updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $com = Area::where('id',$request->id)->delete();
        return Response()->json($com);
    }


     /**
     * get area Arabic names list
     */
    public function getAreaArabicNames(){
        $data = City::select('id','name_local','city_id')->get();        
        return $data;
    }
    /**
     * get area Arabic names list
     */
    public function getAreaEnglishNames(){
        
        $data = City::select('id','name','city_id')->get();        
        return $data;
    }

    public function genrateAreas(){

        $allCities = [];


        $areasAbuDhabi =
            [
                0 => 
                array (
                  '_id' => '60082b2de4afcdaf7e1cb9e5',
                  'name_en' => 'Abu Dhabi Gate City',
                  'name_local' => 'بوابة ابوظبي',
                  'published_at' => '2021-01-20T13:07:57.306Z',
                  'createdAt' => '2021-01-20T13:07:57.323Z',
                  'updatedAt' => '2021-01-20T13:07:57.466Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9e5',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                1 => 
                array (
                  '_id' => '60082b2de4afcdaf7e1cb9e6',
                  'name_en' => 'Airport Road',
                  'name_local' => 'شارع المطار',
                  'published_at' => '2021-01-20T13:07:57.327Z',
                  'createdAt' => '2021-01-20T13:07:57.333Z',
                  'updatedAt' => '2021-01-20T13:07:57.467Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9e6',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                2 => 
                array (
                  '_id' => '60082b2de4afcdaf7e1cb9e9',
                  'name_en' => 'Al Bahia',
                  'name_local' => 'الباهية',
                  'published_at' => '2021-01-20T13:07:57.409Z',
                  'createdAt' => '2021-01-20T13:07:57.427Z',
                  'updatedAt' => '2021-01-20T13:07:57.492Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9e9',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                3 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba14',
                  'name_en' => 'Al Baniyas',
                  'name_local' => 'بني ياس',
                  'published_at' => '2021-01-20T13:08:00.388Z',
                  'createdAt' => '2021-01-20T13:08:00.395Z',
                  'updatedAt' => '2021-01-20T13:08:00.453Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba14',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                4 => 
                array (
                  '_id' => '60082b2de4afcdaf7e1cb9e7',
                  'name_en' => 'Al Baraha',
                  'name_local' => 'البراحة',
                  'published_at' => '2021-01-20T13:07:57.337Z',
                  'createdAt' => '2021-01-20T13:07:57.347Z',
                  'updatedAt' => '2021-03-13T07:13:36.972Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'updated_by' => 
                  array (
                    'isActive' => true,
                    'blocked' => false,
                    '_id' => '600454b4eb44d770c0928cf3',
                    'username' => NULL,
                    'registrationToken' => NULL,
                    'firstname' => 'mohmmad',
                    'lastname' => 'rhahleh',
                    'email' => 'admin@strapi.com',
                    '__v' => 0,
                    'id' => '600454b4eb44d770c0928cf3',
                  ),
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9e7',
                ),
                5 => 
                array (
                  '_id' => '60082b2de4afcdaf7e1cb9ea',
                  'name_en' => 'Al Bateen',
                  'name_local' => 'البطين',
                  'published_at' => '2021-01-20T13:07:57.737Z',
                  'createdAt' => '2021-01-20T13:07:57.741Z',
                  'updatedAt' => '2021-01-20T13:07:57.833Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9ea',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                6 => 
                array (
                  '_id' => '60082b2de4afcdaf7e1cb9eb',
                  'name_en' => 'Al Dhafrah',
                  'name_local' => 'الظفرة',
                  'published_at' => '2021-01-20T13:07:57.744Z',
                  'createdAt' => '2021-01-20T13:07:57.748Z',
                  'updatedAt' => '2021-01-20T13:07:57.835Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9eb',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                7 => 
                array (
                  '_id' => '60082b2de4afcdaf7e1cb9ec',
                  'name_en' => 'Al Falah City',
                  'name_local' => 'مدينة الفلاح',
                  'published_at' => '2021-01-20T13:07:57.783Z',
                  'createdAt' => '2021-01-20T13:07:57.787Z',
                  'updatedAt' => '2021-01-20T13:07:57.861Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9ec',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                8 => 
                array (
                  '_id' => '60082b2de4afcdaf7e1cb9ee',
                  'name_en' => 'Al Ghadeer',
                  'name_local' => 'الغدير',
                  'published_at' => '2021-01-20T13:07:57.812Z',
                  'createdAt' => '2021-01-20T13:07:57.816Z',
                  'updatedAt' => '2021-01-20T13:07:57.875Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9ee',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                9 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9ef',
                  'name_en' => 'Al Gurm',
                  'name_local' => 'القرم',
                  'published_at' => '2021-01-20T13:07:58.040Z',
                  'createdAt' => '2021-01-20T13:07:58.044Z',
                  'updatedAt' => '2021-01-20T13:07:58.095Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9ef',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                10 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9f0',
                  'name_en' => 'Al Gurm West',
                  'name_local' => 'القرم الغربية',
                  'published_at' => '2021-01-20T13:07:58.067Z',
                  'createdAt' => '2021-01-20T13:07:58.070Z',
                  'updatedAt' => '2021-01-20T13:07:58.134Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9f0',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                11 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9f1',
                  'name_en' => 'Al Hudayriat Island',
                  'name_local' => 'جزيرة الحضيريات',
                  'published_at' => '2021-01-20T13:07:58.103Z',
                  'createdAt' => '2021-01-20T13:07:58.109Z',
                  'updatedAt' => '2021-01-20T13:07:58.197Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9f1',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                
                13 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba3b',
                  'name_en' => 'Al Ittihad Road',
                  'name_local' => 'شارع الاتحاد',
                  'published_at' => '2021-01-20T13:08:02.623Z',
                  'createdAt' => '2021-01-20T13:08:02.631Z',
                  'updatedAt' => '2021-01-20T13:08:02.669Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba3b',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                14 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9f3',
                  'name_en' => 'Al Karama',
                  'name_local' => 'الكرامة',
                  'published_at' => '2021-01-20T13:07:58.190Z',
                  'createdAt' => '2021-01-20T13:07:58.194Z',
                  'updatedAt' => '2021-01-20T13:07:58.242Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9f3',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                15 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9f4',
                  'name_en' => 'Al Khalidiya',
                  'name_local' => 'الخالدية',
                  'published_at' => '2021-01-20T13:07:58.333Z',
                  'createdAt' => '2021-01-20T13:07:58.340Z',
                  'updatedAt' => '2021-01-20T13:07:58.352Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9f4',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                16 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9f5',
                  'name_en' => 'Al Khatim',
                  'name_local' => 'الخاتم',
                  'published_at' => '2021-01-20T13:07:58.388Z',
                  'createdAt' => '2021-01-20T13:07:58.395Z',
                  'updatedAt' => '2021-01-20T13:07:58.432Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9f5',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                17 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9f6',
                  'name_en' => 'Al Maffraq',
                  'name_local' => 'المفرق',
                  'published_at' => '2021-01-20T13:07:58.425Z',
                  'createdAt' => '2021-01-20T13:07:58.430Z',
                  'updatedAt' => '2021-01-20T13:07:58.476Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9f6',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                18 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9f7',
                  'name_en' => 'Al Manaseer',
                  'name_local' => 'المناصير',
                  'published_at' => '2021-01-20T13:07:58.455Z',
                  'createdAt' => '2021-01-20T13:07:58.458Z',
                  'updatedAt' => '2021-01-20T13:07:58.498Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9f7',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                19 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9f8',
                  'name_en' => 'Al Manhal',
                  'name_local' => 'المنهل',
                  'published_at' => '2021-01-20T13:07:58.486Z',
                  'createdAt' => '2021-01-20T13:07:58.489Z',
                  'updatedAt' => '2021-01-20T13:07:58.527Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9f8',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                20 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9f9',
                  'name_en' => 'Al Maqtaa',
                  'name_local' => 'منطقة المقطع',
                  'published_at' => '2021-01-20T13:07:58.578Z',
                  'createdAt' => '2021-01-20T13:07:58.582Z',
                  'updatedAt' => '2021-01-20T13:07:58.618Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9f9',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                21 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9fa',
                  'name_en' => 'Al Markaziyah',
                  'name_local' => 'المركزية',
                  'published_at' => '2021-01-20T13:07:58.647Z',
                  'createdAt' => '2021-01-20T13:07:58.649Z',
                  'updatedAt' => '2021-01-20T13:07:58.656Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9fa',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                22 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9fb',
                  'name_en' => 'Al Maryah',
                  'name_local' => 'جزيرة الماريه الصواح',
                  'published_at' => '2021-01-20T13:07:58.689Z',
                  'createdAt' => '2021-01-20T13:07:58.692Z',
                  'updatedAt' => '2021-01-20T13:07:58.701Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9fb',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                23 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9fc',
                  'name_en' => 'Al Mina',
                  'name_local' => 'ميتاء زايد',
                  'published_at' => '2021-01-20T13:07:58.739Z',
                  'createdAt' => '2021-01-20T13:07:58.749Z',
                  'updatedAt' => '2021-01-20T13:07:58.762Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9fc',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                24 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9fd',
                  'name_en' => 'Al Mushrif',
                  'name_local' => 'المشرف',
                  'published_at' => '2021-01-20T13:07:58.788Z',
                  'createdAt' => '2021-01-20T13:07:58.790Z',
                  'updatedAt' => '2021-01-20T13:07:58.818Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9fd',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                25 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9fe',
                  'name_en' => 'Al Nahda',
                  'name_local' => 'النهضة ابوظبي',
                  'published_at' => '2021-01-20T13:07:58.812Z',
                  'createdAt' => '2021-01-20T13:07:58.816Z',
                  'updatedAt' => '2021-01-20T13:07:58.845Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9fe',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                26 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cb9ff',
                  'name_en' => 'Al Nahyan Camp',
                  'name_local' => 'معسكر ال نهيان',
                  'published_at' => '2021-01-20T13:07:58.870Z',
                  'createdAt' => '2021-01-20T13:07:58.873Z',
                  'updatedAt' => '2021-01-20T13:07:58.900Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cb9ff',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                27 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cba00',
                  'name_en' => 'Al Najda Street',
                  'name_local' => 'شارع النجدة',
                  'published_at' => '2021-01-20T13:07:58.910Z',
                  'createdAt' => '2021-01-20T13:07:58.913Z',
                  'updatedAt' => '2021-01-20T13:07:58.934Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cba00',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                28 => 
                array (
                  '_id' => '60082b2ee4afcdaf7e1cba01',
                  'name_en' => 'Al Raha Beach',
                  'name_local' => 'شاطئ الراحه',
                  'published_at' => '2021-01-20T13:07:58.964Z',
                  'createdAt' => '2021-01-20T13:07:58.969Z',
                  'updatedAt' => '2021-01-20T13:07:58.981Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2ee4afcdaf7e1cba01',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                29 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba03',
                  'name_en' => 'Al Raha Gardens',
                  'name_local' => 'حدائق الراحة',
                  'published_at' => '2021-01-20T13:07:59.118Z',
                  'createdAt' => '2021-01-20T13:07:59.125Z',
                  'updatedAt' => '2021-01-20T13:07:59.388Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba03',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                30 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba02',
                  'name_en' => 'Al Raha Golf Gardens',
                  'name_local' => 'حدائق الجولف في الراحة',
                  'published_at' => '2021-01-20T13:07:59.048Z',
                  'createdAt' => '2021-01-20T13:07:59.062Z',
                  'updatedAt' => '2021-01-20T13:07:59.225Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba02',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                31 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba04',
                  'name_en' => 'Al Rahba',
                  'name_local' => 'الرجبة',
                  'published_at' => '2021-01-20T13:07:59.309Z',
                  'createdAt' => '2021-01-20T13:07:59.344Z',
                  'updatedAt' => '2021-01-20T13:07:59.422Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba04',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                32 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba05',
                  'name_en' => 'Al Rawdah',
                  'name_local' => 'الروضة',
                  'published_at' => '2021-01-20T13:07:59.377Z',
                  'createdAt' => '2021-01-20T13:07:59.383Z',
                  'updatedAt' => '2021-01-20T13:07:59.431Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba05',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                33 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba06',
                  'name_en' => 'Al Rayhan',
                  'name_local' => 'الريحان',
                  'published_at' => '2021-01-20T13:07:59.404Z',
                  'createdAt' => '2021-01-20T13:07:59.408Z',
                  'updatedAt' => '2021-01-20T13:07:59.456Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba06',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                34 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba07',
                  'name_en' => 'Al Reef',
                  'name_local' => 'مشروع الريف',
                  'published_at' => '2021-01-20T13:07:59.569Z',
                  'createdAt' => '2021-01-20T13:07:59.582Z',
                  'updatedAt' => '2021-01-20T13:07:59.596Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba07',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                35 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba08',
                  'name_en' => 'Al Reem Island',
                  'name_local' => 'جزيرة الريم',
                  'published_at' => '2021-01-20T13:07:59.653Z',
                  'createdAt' => '2021-01-20T13:07:59.656Z',
                  'updatedAt' => '2021-01-20T13:07:59.718Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba08',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                36 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba09',
                  'name_en' => 'Al Ruwais',
                  'name_local' => 'الرويس',
                  'published_at' => '2021-01-20T13:07:59.674Z',
                  'createdAt' => '2021-01-20T13:07:59.678Z',
                  'updatedAt' => '2021-01-20T13:07:59.727Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba09',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                37 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba0b',
                  'name_en' => 'Al Salam Street',
                  'name_local' => 'شارع السلام',
                  'published_at' => '2021-01-20T13:07:59.714Z',
                  'createdAt' => '2021-01-20T13:07:59.716Z',
                  'updatedAt' => '2021-01-20T13:07:59.749Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba0b',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                38 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba0a',
                  'name_en' => 'Al Samha',
                  'name_local' => 'السمحة',
                  'published_at' => '2021-01-20T13:07:59.698Z',
                  'createdAt' => '2021-01-20T13:07:59.702Z',
                  'updatedAt' => '2021-01-20T13:07:59.736Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba0a',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                39 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba0c',
                  'name_en' => 'Al Shahama',
                  'name_local' => 'الشهامة',
                  'published_at' => '2021-01-20T13:07:59.794Z',
                  'createdAt' => '2021-01-20T13:07:59.797Z',
                  'updatedAt' => '2021-01-20T13:07:59.806Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba0c',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                40 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba0d',
                  'name_en' => 'Al Shamkha',
                  'name_local' => 'الشمخة',
                  'published_at' => '2021-01-20T13:07:59.929Z',
                  'createdAt' => '2021-01-20T13:07:59.938Z',
                  'updatedAt' => '2021-01-20T13:08:00.053Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba0d',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                41 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba0f',
                  'name_en' => 'Al Shawamekh',
                  'name_local' => 'الشوامخ',
                  'published_at' => '2021-01-20T13:07:59.990Z',
                  'createdAt' => '2021-01-20T13:07:59.994Z',
                  'updatedAt' => '2021-01-20T13:08:00.101Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba0f',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                42 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba10',
                  'name_en' => 'Al Wahda',
                  'name_local' => 'الوحدة',
                  'published_at' => '2021-01-20T13:08:00.067Z',
                  'createdAt' => '2021-01-20T13:08:00.073Z',
                  'updatedAt' => '2021-01-20T13:08:00.134Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba10',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                43 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba11',
                  'name_en' => 'Al Wathba',
                  'name_local' => 'الوثبة',
                  'published_at' => '2021-01-20T13:08:00.076Z',
                  'createdAt' => '2021-01-20T13:08:00.080Z',
                  'updatedAt' => '2021-01-20T13:08:00.138Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba11',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                44 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba12',
                  'name_en' => 'Al Zaab',
                  'name_local' => 'الزعاب',
                  'published_at' => '2021-01-20T13:08:00.282Z',
                  'createdAt' => '2021-01-20T13:08:00.288Z',
                  'updatedAt' => '2021-01-20T13:08:00.305Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba12',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                45 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba13',
                  'name_en' => 'Al Zahraa',
                  'name_local' => 'الزهراء',
                  'published_at' => '2021-01-20T13:08:00.341Z',
                  'createdAt' => '2021-01-20T13:08:00.344Z',
                  'updatedAt' => '2021-01-20T13:08:00.437Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba13',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                46 => 
                array (
                  '_id' => '60082b2de4afcdaf7e1cb9ed',
                  'name_en' => 'Al-Forsan',
                  'name_local' => 'قرية الفرسان',
                  'published_at' => '2021-01-20T13:07:57.805Z',
                  'createdAt' => '2021-01-20T13:07:57.810Z',
                  'updatedAt' => '2021-01-20T13:07:57.874Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9ed',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                
                48 => 
                array (
                  '_id' => '60082b2de4afcdaf7e1cb9e8',
                  'name_en' => 'Badaa',
                  'name_local' => 'البدع',
                  'published_at' => '2021-01-20T13:07:57.400Z',
                  'createdAt' => '2021-01-20T13:07:57.406Z',
                  'updatedAt' => '2021-01-20T13:07:57.491Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9e8',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
               
                50 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba15',
                  'name_en' => 'Between Tow Bridges',
                  'name_local' => 'منطقة بين الجسرين',
                  'published_at' => '2021-01-20T13:08:00.416Z',
                  'createdAt' => '2021-01-20T13:08:00.420Z',
                  'updatedAt' => '2021-01-20T13:08:00.463Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba15',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                51 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba16',
                  'name_en' => 'Building Materials City',
                  'name_local' => 'مدينة خامات البناء',
                  'published_at' => '2021-01-20T13:08:00.422Z',
                  'createdAt' => '2021-01-20T13:08:00.426Z',
                  'updatedAt' => '2021-01-20T13:08:00.465Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba16',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                52 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba17',
                  'name_en' => 'Capital Centre',
                  'name_local' => 'كابيتال سنتر',
                  'published_at' => '2021-01-20T13:08:00.521Z',
                  'createdAt' => '2021-01-20T13:08:00.525Z',
                  'updatedAt' => '2021-01-20T13:08:00.533Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba17',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                
                54 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba3c',
                  'name_en' => 'City Downtown',
                  'name_local' => 'وسط المدينة',
                  'published_at' => '2021-01-20T13:08:02.677Z',
                  'createdAt' => '2021-01-20T13:08:02.682Z',
                  'updatedAt' => '2021-01-20T13:08:02.729Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba3c',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                55 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba1b',
                  'name_en' => 'Corniche Area',
                  'name_local' => 'منطقة خلف شارع الكورنيش',
                  'published_at' => '2021-01-20T13:08:00.710Z',
                  'createdAt' => '2021-01-20T13:08:00.714Z',
                  'updatedAt' => '2021-01-20T13:08:00.761Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba1b',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                56 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba19',
                  'name_en' => 'Corniche Road',
                  'name_local' => 'شارع الكورنيش',
                  'published_at' => '2021-01-20T13:08:00.669Z',
                  'createdAt' => '2021-01-20T13:08:00.673Z',
                  'updatedAt' => '2021-01-20T13:08:00.725Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba19',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
               
                58 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba1c',
                  'name_en' => 'Danet Abu Dhabi',
                  'name_local' => 'دانة ابوظبي',
                  'published_at' => '2021-01-20T13:08:00.753Z',
                  'createdAt' => '2021-01-20T13:08:00.757Z',
                  'updatedAt' => '2021-01-20T13:08:00.801Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba1c',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                59 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba1d',
                  'name_en' => 'Defence Street',
                  'name_local' => 'شارع الدفاع',
                  'published_at' => '2021-01-20T13:08:00.866Z',
                  'createdAt' => '2021-01-20T13:08:00.876Z',
                  'updatedAt' => '2021-01-20T13:08:00.894Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba1d',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                60 => 
                array (
                  '_id' => '60082b30e4afcdaf7e1cba1e',
                  'name_en' => 'Desert Village',
                  'name_local' => 'القرية الصحراوية',
                  'published_at' => '2021-01-20T13:08:00.970Z',
                  'createdAt' => '2021-01-20T13:08:00.983Z',
                  'updatedAt' => '2021-01-20T13:08:01.060Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b30e4afcdaf7e1cba1e',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                61 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba1f',
                  'name_en' => 'Eastern Road',
                  'name_local' => 'الطريق الشرقي',
                  'published_at' => '2021-01-20T13:08:01.023Z',
                  'createdAt' => '2021-01-20T13:08:01.027Z',
                  'updatedAt' => '2021-01-20T13:08:01.089Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba1f',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                62 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba20',
                  'name_en' => 'Electra Street',
                  'name_local' => 'شارع الكترا',
                  'published_at' => '2021-01-20T13:08:01.069Z',
                  'createdAt' => '2021-01-20T13:08:01.074Z',
                  'updatedAt' => '2021-01-20T13:08:01.127Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba20',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                63 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba21',
                  'name_en' => 'Ghantoot',
                  'name_local' => 'غنتوت',
                  'published_at' => '2021-01-20T13:08:01.076Z',
                  'createdAt' => '2021-01-20T13:08:01.079Z',
                  'updatedAt' => '2021-01-20T13:08:01.128Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba21',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                64 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba22',
                  'name_en' => 'Grand Mosque District',
                  'name_local' => 'منطقة المسجد الكبير',
                  'published_at' => '2021-01-20T13:08:01.122Z',
                  'createdAt' => '2021-01-20T13:08:01.125Z',
                  'updatedAt' => '2021-01-20T13:08:01.155Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba22',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                65 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba23',
                  'name_en' => 'Hamdan Street',
                  'name_local' => 'شارع حمدان',
                  'published_at' => '2021-01-20T13:08:01.271Z',
                  'createdAt' => '2021-01-20T13:08:01.285Z',
                  'updatedAt' => '2021-01-20T13:08:01.304Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba23',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                66 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba24',
                  'name_en' => 'Hameem',
                  'name_local' => 'حميم',
                  'published_at' => '2021-01-20T13:08:01.309Z',
                  'createdAt' => '2021-01-20T13:08:01.312Z',
                  'updatedAt' => '2021-01-20T13:08:01.348Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba24',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                67 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba25',
                  'name_en' => 'Hydra Village',
                  'name_local' => 'قرية هيدار',
                  'published_at' => '2021-01-20T13:08:01.374Z',
                  'createdAt' => '2021-01-20T13:08:01.379Z',
                  'updatedAt' => '2021-01-20T13:08:01.435Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba25',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                68 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba26',
                  'name_en' => 'Jawazat Street',
                  'name_local' => 'شارع الجوازات',
                  'published_at' => '2021-01-20T13:08:01.398Z',
                  'createdAt' => '2021-01-20T13:08:01.402Z',
                  'updatedAt' => '2021-01-20T13:08:01.444Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba26',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                69 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba27',
                  'name_en' => 'Khalifa City',
                  'name_local' => 'مدينة خليفة',
                  'published_at' => '2021-01-20T13:08:01.405Z',
                  'createdAt' => '2021-01-20T13:08:01.409Z',
                  'updatedAt' => '2021-01-20T13:08:01.445Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba27',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                70 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba28',
                  'name_en' => 'Khalifa Street',
                  'name_local' => 'شارع خليفة',
                  'published_at' => '2021-01-20T13:08:01.522Z',
                  'createdAt' => '2021-01-20T13:08:01.525Z',
                  'updatedAt' => '2021-01-20T13:08:01.532Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba28',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                71 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba29',
                  'name_en' => 'Liwa',
                  'name_local' => 'ليوا',
                  'published_at' => '2021-01-20T13:08:01.586Z',
                  'createdAt' => '2021-01-20T13:08:01.591Z',
                  'updatedAt' => '2021-01-20T13:08:01.604Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba29',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                72 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba2a',
                  'name_en' => 'Lulu Island',
                  'name_local' => 'جزيرة اللولو',
                  'published_at' => '2021-01-20T13:08:01.641Z',
                  'createdAt' => '2021-01-20T13:08:01.649Z',
                  'updatedAt' => '2021-01-20T13:08:01.691Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba2a',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                73 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba2b',
                  'name_en' => 'Madinat Zayed',
                  'name_local' => 'مدينة زايد',
                  'published_at' => '2021-01-20T13:08:01.705Z',
                  'createdAt' => '2021-01-20T13:08:01.708Z',
                  'updatedAt' => '2021-01-20T13:08:01.758Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba2b',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                74 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba2c',
                  'name_en' => 'Marina Village',
                  'name_local' => 'قرية مارينا',
                  'published_at' => '2021-01-20T13:08:01.727Z',
                  'createdAt' => '2021-01-20T13:08:01.730Z',
                  'updatedAt' => '2021-01-20T13:08:01.766Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba2c',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                75 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba2d',
                  'name_en' => 'Masdar City',
                  'name_local' => 'مدينة مصدر',
                  'published_at' => '2021-01-20T13:08:01.743Z',
                  'createdAt' => '2021-01-20T13:08:01.746Z',
                  'updatedAt' => '2021-01-20T13:08:01.776Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba2d',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                76 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba2e',
                  'name_en' => 'Mina Zayed',
                  'name_local' => 'مناء زايد',
                  'published_at' => '2021-01-20T13:08:01.837Z',
                  'createdAt' => '2021-01-20T13:08:01.841Z',
                  'updatedAt' => '2021-01-20T13:08:01.851Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba2e',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                77 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba2f',
                  'name_en' => 'Mohammad Bin Zayed City',
                  'name_local' => 'مدينة محمد بن زايد',
                  'published_at' => '2021-01-20T13:08:01.908Z',
                  'createdAt' => '2021-01-20T13:08:01.912Z',
                  'updatedAt' => '2021-01-20T13:08:01.923Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba2f',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                78 => 
                array (
                  '_id' => '60082b31e4afcdaf7e1cba30',
                  'name_en' => 'Muroor Area',
                  'name_local' => 'منطقة المرور',
                  'published_at' => '2021-01-20T13:08:01.967Z',
                  'createdAt' => '2021-01-20T13:08:01.970Z',
                  'updatedAt' => '2021-01-20T13:08:02.009Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b31e4afcdaf7e1cba30',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                79 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba31',
                  'name_en' => 'Mussafah',
                  'name_local' => 'مصفح',
                  'published_at' => '2021-01-20T13:08:01.998Z',
                  'createdAt' => '2021-01-20T13:08:02.006Z',
                  'updatedAt' => '2021-01-20T13:08:02.078Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba31',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                80 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba32',
                  'name_en' => 'Nurai Island',
                  'name_local' => 'جزيرة نوراي',
                  'published_at' => '2021-01-20T13:08:02.049Z',
                  'createdAt' => '2021-01-20T13:08:02.052Z',
                  'updatedAt' => '2021-01-20T13:08:02.104Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba32',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                81 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba33',
                  'name_en' => 'Saadiyat Island',
                  'name_local' => 'جزيرة السعديات',
                  'published_at' => '2021-01-20T13:08:02.087Z',
                  'createdAt' => '2021-01-20T13:08:02.094Z',
                  'updatedAt' => '2021-01-20T13:08:02.129Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba33',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                82 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba34',
                  'name_en' => 'Sas Al Nakheel',
                  'name_local' => 'ساس النخيل',
                  'published_at' => '2021-01-20T13:08:02.136Z',
                  'createdAt' => '2021-01-20T13:08:02.139Z',
                  'updatedAt' => '2021-01-20T13:08:02.163Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba34',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                83 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba35',
                  'name_en' => 'Tourist Club Area',
                  'name_local' => 'منطقة النادي السياحي',
                  'published_at' => '2021-01-20T13:08:02.248Z',
                  'createdAt' => '2021-01-20T13:08:02.258Z',
                  'updatedAt' => '2021-01-20T13:08:02.270Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba35',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                84 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba36',
                  'name_en' => 'Umm Al Nar',
                  'name_local' => 'ام النار',
                  'published_at' => '2021-01-20T13:08:02.308Z',
                  'createdAt' => '2021-01-20T13:08:02.312Z',
                  'updatedAt' => '2021-01-20T13:08:02.386Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba36',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                85 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba37',
                  'name_en' => 'Yas Island',
                  'name_local' => 'جزيرة الياس',
                  'published_at' => '2021-01-20T13:08:02.313Z',
                  'createdAt' => '2021-01-20T13:08:02.319Z',
                  'updatedAt' => '2021-01-20T13:08:02.388Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba37',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                86 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba38',
                  'name_en' => 'Zayed Military City',
                  'name_local' => 'مدينة زايد العسكرية',
                  'published_at' => '2021-01-20T13:08:02.353Z',
                  'createdAt' => '2021-01-20T13:08:02.359Z',
                  'updatedAt' => '2021-01-20T13:08:02.444Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba38',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                87 => 
                array (
                  '_id' => '60082b32e4afcdaf7e1cba39',
                  'name_en' => 'Zayed Sports City',
                  'name_local' => 'مدينة زايد الرياضية',
                  'published_at' => '2021-01-20T13:08:02.394Z',
                  'createdAt' => '2021-01-20T13:08:02.399Z',
                  'updatedAt' => '2021-01-20T13:08:02.476Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b32e4afcdaf7e1cba39',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
                88 => 
                array (
                  '_id' => '60082b2fe4afcdaf7e1cba0e',
                  'name_en' => 'sila\'a',
                  'name_local' => 'السلع',
                  'published_at' => '2021-01-20T13:07:59.976Z',
                  'createdAt' => '2021-01-20T13:07:59.988Z',
                  'updatedAt' => '2021-01-20T13:08:00.099Z',
                  '__v' => 0,
                  'city' => 
                  array (
                    '_id' => '600815f9731d75ae35f558b6',
                    'name_en' => 'Abu Dhabi',
                    'name_local' => 'ابو ظبي',
                    'published_at' => '2021-01-20T11:37:32.705Z',
                    'createdAt' => '2021-01-20T11:37:29.825Z',
                    'updatedAt' => '2021-01-20T11:53:00.414Z',
                    '__v' => 0,
                    'country' => '600814ac731d75ae35f558b3',
                    'created_by' => '6004649e1c86b983d285e5fb',
                    'updated_by' => '600454b4eb44d770c0928cf3',
                    'id' => '600815f9731d75ae35f558b6',
                  ),
                  'id' => '60082b2fe4afcdaf7e1cba0e',
                  'stores' => 
                  array (
                    'count' => 0,
                  ),
                ),
            ];

       
       $sharjaAreas =  
       [
        [
              "_id" => "6008292be4afcdaf7e1cb8f9", 
              "name_en" => "Aalwan", 
              "name_local" => "حلوان", 
              "published_at" => "2021-01-20T12:59:23.656Z", 
              "createdAt" => "2021-01-20T12:59:23.659Z", 
              "updatedAt" => "2021-01-20T12:59:23.708Z", 
              "__v" => 0, 
              "city" => [
                 "_id" => "60081756731d75ae35f558ba", 
                 "name_en" => "Sharjah", 
                 "name_local" => "الشارقة", 
                 "published_at" => "2021-01-20T11:43:22.182Z", 
                 "createdAt" => "2021-01-20T11:43:18.929Z", 
                 "updatedAt" => "2021-01-20T11:53:34.324Z", 
                 "__v" => 0, 
                 "country" => "600814ac731d75ae35f558b3", 
                 "created_by" => "6004649e1c86b983d285e5fb", 
                 "updated_by" => "600454b4eb44d770c0928cf3", 
                 "id" => "60081756731d75ae35f558ba" 
              ], 
              "id" => "6008292be4afcdaf7e1cb8f9", 
              "stores" => [
                    "count" => 0 
                 ] 
           ], 
        [
                       "_id" => "6008292ce4afcdaf7e1cb908", 
                       "name_en" => "Aaterfront City Marina", 
                       "name_local" => "الواجهة المائية", 
                       "published_at" => "2021-01-20T12:59:24.634Z", 
                       "createdAt" => "2021-01-20T12:59:24.638Z", 
                       "updatedAt" => "2021-01-20T12:59:24.717Z", 
                       "__v" => 0, 
                       "city" => [
                          "_id" => "60081756731d75ae35f558ba", 
                          "name_en" => "Sharjah", 
                          "name_local" => "الشارقة", 
                          "published_at" => "2021-01-20T11:43:22.182Z", 
                          "createdAt" => "2021-01-20T11:43:18.929Z", 
                          "updatedAt" => "2021-01-20T11:53:34.324Z", 
                          "__v" => 0, 
                          "country" => "600814ac731d75ae35f558b3", 
                          "created_by" => "6004649e1c86b983d285e5fb", 
                          "updated_by" => "600454b4eb44d770c0928cf3", 
                          "id" => "60081756731d75ae35f558ba" 
                       ], 
                       "id" => "6008292ce4afcdaf7e1cb908", 
                       "stores" => [
                             "count" => 0 
                          ] 
                    ], 
        [
                                "_id" => "60082928e4afcdaf7e1cb8cc", 
                                "name_en" => "Abu Shagra", 
                                "name_local" => "ابو شغارة", 
                                "published_at" => "2021-01-20T12:59:20.724Z", 
                                "createdAt" => "2021-01-20T12:59:20.732Z", 
                                "updatedAt" => "2021-01-20T12:59:20.891Z", 
                                "__v" => 0, 
                                "city" => [
                                   "_id" => "60081756731d75ae35f558ba", 
                                   "name_en" => "Sharjah", 
                                   "name_local" => "الشارقة", 
                                   "published_at" => "2021-01-20T11:43:22.182Z", 
                                   "createdAt" => "2021-01-20T11:43:18.929Z", 
                                   "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                   "__v" => 0, 
                                   "country" => "600814ac731d75ae35f558b3", 
                                   "created_by" => "6004649e1c86b983d285e5fb", 
                                   "updated_by" => "600454b4eb44d770c0928cf3", 
                                   "id" => "60081756731d75ae35f558ba" 
                                ], 
                                "id" => "60082928e4afcdaf7e1cb8cc", 
                                "stores" => [
                                      "count" => 0 
                                   ] 
                             ], 
        [
                                         "_id" => "6008292ce4afcdaf7e1cb900", 
                                         "name_en" => "Airport Freezon", 
                                         "name_local" => "المنطقة الحرة بمطار الشارقة", 
                                         "published_at" => "2021-01-20T12:59:24.053Z", 
                                         "createdAt" => "2021-01-20T12:59:24.056Z", 
                                         "updatedAt" => "2021-01-20T12:59:24.086Z", 
                                         "__v" => 0, 
                                         "city" => [
                                            "_id" => "60081756731d75ae35f558ba", 
                                            "name_en" => "Sharjah", 
                                            "name_local" => "الشارقة", 
                                            "published_at" => "2021-01-20T11:43:22.182Z", 
                                            "createdAt" => "2021-01-20T11:43:18.929Z", 
                                            "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                            "__v" => 0, 
                                            "country" => "600814ac731d75ae35f558b3", 
                                            "created_by" => "6004649e1c86b983d285e5fb", 
                                            "updated_by" => "600454b4eb44d770c0928cf3", 
                                            "id" => "60081756731d75ae35f558ba" 
                                         ], 
                                         "id" => "6008292ce4afcdaf7e1cb900", 
                                         "stores" => [
                                               "count" => 0 
                                            ] 
                                      ], 
        [
                                                  "_id" => "6008292ce4afcdaf7e1cb90c", 
                                                  "name_en" => "Al Azra", 
                                                  "name_local" => "العزرة", 
                                                  "published_at" => "2021-01-20T12:59:24.882Z", 
                                                  "createdAt" => "2021-01-20T12:59:24.889Z", 
                                                  "updatedAt" => "2021-01-20T12:59:24.903Z", 
                                                  "__v" => 0, 
                                                  "city" => [
                                                     "_id" => "60081756731d75ae35f558ba", 
                                                     "name_en" => "Sharjah", 
                                                     "name_local" => "الشارقة", 
                                                     "published_at" => "2021-01-20T11:43:22.182Z", 
                                                     "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                     "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                     "__v" => 0, 
                                                     "country" => "600814ac731d75ae35f558b3", 
                                                     "created_by" => "6004649e1c86b983d285e5fb", 
                                                     "updated_by" => "600454b4eb44d770c0928cf3", 
                                                     "id" => "60081756731d75ae35f558ba" 
                                                  ], 
                                                  "id" => "6008292ce4afcdaf7e1cb90c", 
                                                  "stores" => [
                                                        "count" => 0 
                                                     ] 
                                               ], 
        [
                                                           "_id" => "60082928e4afcdaf7e1cb8ce", 
                                                           "name_en" => "Al Badie", 
                                                           "name_local" => "البادي", 
                                                           "published_at" => "2021-01-20T12:59:20.822Z", 
                                                           "createdAt" => "2021-01-20T12:59:20.838Z", 
                                                           "updatedAt" => "2021-01-20T12:59:20.919Z", 
                                                           "__v" => 0, 
                                                           "city" => [
                                                              "_id" => "60081756731d75ae35f558ba", 
                                                              "name_en" => "Sharjah", 
                                                              "name_local" => "الشارقة", 
                                                              "published_at" => "2021-01-20T11:43:22.182Z", 
                                                              "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                              "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                              "__v" => 0, 
                                                              "country" => "600814ac731d75ae35f558b3", 
                                                              "created_by" => "6004649e1c86b983d285e5fb", 
                                                              "updated_by" => "600454b4eb44d770c0928cf3", 
                                                              "id" => "60081756731d75ae35f558ba" 
                                                           ], 
                                                           "id" => "60082928e4afcdaf7e1cb8ce", 
                                                           "stores" => [
                                                                 "count" => 0 
                                                              ] 
                                                        ], 
        [
                                                                    "_id" => "60082928e4afcdaf7e1cb8d0", 
                                                                    "name_en" => "Al Brashi", 
                                                                    "name_local" => "البراشي", 
                                                                    "published_at" => "2021-01-20T12:59:20.867Z", 
                                                                    "createdAt" => "2021-01-20T12:59:20.871Z", 
                                                                    "updatedAt" => "2021-01-20T12:59:20.923Z", 
                                                                    "__v" => 0, 
                                                                    "city" => [
                                                                       "_id" => "60081756731d75ae35f558ba", 
                                                                       "name_en" => "Sharjah", 
                                                                       "name_local" => "الشارقة", 
                                                                       "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                       "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                       "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                       "__v" => 0, 
                                                                       "country" => "600814ac731d75ae35f558b3", 
                                                                       "created_by" => "6004649e1c86b983d285e5fb", 
                                                                       "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                       "id" => "60081756731d75ae35f558ba" 
                                                                    ], 
                                                                    "id" => "60082928e4afcdaf7e1cb8d0", 
                                                                    "stores" => [
                                                                          "count" => 0 
                                                                       ] 
                                                                 ], 
        [
                                                                             "_id" => "60082928e4afcdaf7e1cb8cd", 
                                                                             "name_en" => "Al Butina", 
                                                                             "name_local" => "البطينة", 
                                                                             "published_at" => "2021-01-20T12:59:20.797Z", 
                                                                             "createdAt" => "2021-01-20T12:59:20.819Z", 
                                                                             "updatedAt" => "2021-01-20T12:59:20.917Z", 
                                                                             "__v" => 0, 
                                                                             "city" => [
                                                                                "_id" => "60081756731d75ae35f558ba", 
                                                                                "name_en" => "Sharjah", 
                                                                                "name_local" => "الشارقة", 
                                                                                "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                "__v" => 0, 
                                                                                "country" => "600814ac731d75ae35f558b3", 
                                                                                "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                "id" => "60081756731d75ae35f558ba" 
                                                                             ], 
                                                                             "id" => "60082928e4afcdaf7e1cb8cd", 
                                                                             "stores" => [
                                                                                   "count" => 0 
                                                                                ] 
                                                                          ], 
        [
                                                                                      "_id" => "60082928e4afcdaf7e1cb8cf", 
                                                                                      "name_en" => "Al Ettihad Street", 
                                                                                      "name_local" => "شارع الاتحاد", 
                                                                                      "published_at" => "2021-01-20T12:59:20.842Z", 
                                                                                      "createdAt" => "2021-01-20T12:59:20.862Z", 
                                                                                      "updatedAt" => "2021-01-20T12:59:20.921Z", 
                                                                                      "__v" => 0, 
                                                                                      "city" => [
                                                                                         "_id" => "60081756731d75ae35f558ba", 
                                                                                         "name_en" => "Sharjah", 
                                                                                         "name_local" => "الشارقة", 
                                                                                         "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                         "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                         "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                         "__v" => 0, 
                                                                                         "country" => "600814ac731d75ae35f558b3", 
                                                                                         "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                         "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                         "id" => "60081756731d75ae35f558ba" 
                                                                                      ], 
                                                                                      "id" => "60082928e4afcdaf7e1cb8cf", 
                                                                                      "stores" => [
                                                                                            "count" => 0 
                                                                                         ] 
                                                                                   ], 
        [
                                                                                               "_id" => "6008292ce4afcdaf7e1cb90e", 
                                                                                               "name_en" => "Al Falaj", 
                                                                                               "name_local" => "الفلج", 
                                                                                               "published_at" => "2021-01-20T12:59:24.975Z", 
                                                                                               "createdAt" => "2021-01-20T12:59:24.983Z", 
                                                                                               "updatedAt" => "2021-01-20T12:59:25.035Z", 
                                                                                               "__v" => 0, 
                                                                                               "city" => [
                                                                                                  "_id" => "60081756731d75ae35f558ba", 
                                                                                                  "name_en" => "Sharjah", 
                                                                                                  "name_local" => "الشارقة", 
                                                                                                  "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                  "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                  "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                  "__v" => 0, 
                                                                                                  "country" => "600814ac731d75ae35f558b3", 
                                                                                                  "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                  "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                  "id" => "60081756731d75ae35f558ba" 
                                                                                               ], 
                                                                                               "id" => "6008292ce4afcdaf7e1cb90e", 
                                                                                               "stores" => [
                                                                                                     "count" => 0 
                                                                                                  ] 
                                                                                            ], 
        [
                                                                                                        "_id" => "60082929e4afcdaf7e1cb8d1", 
                                                                                                        "name_en" => "Al Fayha", 
                                                                                                        "name_local" => "الفيحاء", 
                                                                                                        "published_at" => "2021-01-20T12:59:21.157Z", 
                                                                                                        "createdAt" => "2021-01-20T12:59:21.165Z", 
                                                                                                        "updatedAt" => "2021-01-20T12:59:21.283Z", 
                                                                                                        "__v" => 0, 
                                                                                                        "city" => [
                                                                                                           "_id" => "60081756731d75ae35f558ba", 
                                                                                                           "name_en" => "Sharjah", 
                                                                                                           "name_local" => "الشارقة", 
                                                                                                           "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                           "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                           "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                           "__v" => 0, 
                                                                                                           "country" => "600814ac731d75ae35f558b3", 
                                                                                                           "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                           "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                           "id" => "60081756731d75ae35f558ba" 
                                                                                                        ], 
                                                                                                        "id" => "60082929e4afcdaf7e1cb8d1", 
                                                                                                        "stores" => [
                                                                                                              "count" => 0 
                                                                                                           ] 
                                                                                                     ], 
        [
                                                                                                                 "_id" => "60082929e4afcdaf7e1cb8d2", 
                                                                                                                 "name_en" => "Al Fisht", 
                                                                                                                 "name_local" => "منطقة الفشت", 
                                                                                                                 "published_at" => "2021-01-20T12:59:21.168Z", 
                                                                                                                 "createdAt" => "2021-01-20T12:59:21.172Z", 
                                                                                                                 "updatedAt" => "2021-01-20T12:59:21.285Z", 
                                                                                                                 "__v" => 0, 
                                                                                                                 "city" => [
                                                                                                                    "_id" => "60081756731d75ae35f558ba", 
                                                                                                                    "name_en" => "Sharjah", 
                                                                                                                    "name_local" => "الشارقة", 
                                                                                                                    "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                    "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                    "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                    "__v" => 0, 
                                                                                                                    "country" => "600814ac731d75ae35f558b3", 
                                                                                                                    "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                    "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                    "id" => "60081756731d75ae35f558ba" 
                                                                                                                 ], 
                                                                                                                 "id" => "60082929e4afcdaf7e1cb8d2", 
                                                                                                                 "stores" => [
                                                                                                                       "count" => 0 
                                                                                                                    ] 
                                                                                                              ], 
        [
                                                                                                                          "_id" => "60082929e4afcdaf7e1cb8d5", 
                                                                                                                          "name_en" => "Al Garayen", 
                                                                                                                          "name_local" => "القرائن", 
                                                                                                                          "published_at" => "2021-01-20T12:59:21.246Z", 
                                                                                                                          "createdAt" => "2021-01-20T12:59:21.250Z", 
                                                                                                                          "updatedAt" => "2021-01-20T12:59:21.314Z", 
                                                                                                                          "__v" => 0, 
                                                                                                                          "city" => [
                                                                                                                             "_id" => "60081756731d75ae35f558ba", 
                                                                                                                             "name_en" => "Sharjah", 
                                                                                                                             "name_local" => "الشارقة", 
                                                                                                                             "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                             "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                             "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                             "__v" => 0, 
                                                                                                                             "country" => "600814ac731d75ae35f558b3", 
                                                                                                                             "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                             "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                             "id" => "60081756731d75ae35f558ba" 
                                                                                                                          ], 
                                                                                                                          "id" => "60082929e4afcdaf7e1cb8d5", 
                                                                                                                          "stores" => [
                                                                                                                                "count" => 0 
                                                                                                                             ] 
                                                                                                                       ], 
        [
                                                                                                                                   "_id" => "60082929e4afcdaf7e1cb8d3", 
                                                                                                                                   "name_en" => "Al Ghafeyah Area", 
                                                                                                                                   "name_local" => "الغافية", 
                                                                                                                                   "published_at" => "2021-01-20T12:59:21.229Z", 
                                                                                                                                   "createdAt" => "2021-01-20T12:59:21.237Z", 
                                                                                                                                   "updatedAt" => "2021-01-20T12:59:21.310Z", 
                                                                                                                                   "__v" => 0, 
                                                                                                                                   "city" => [
                                                                                                                                      "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                      "name_en" => "Sharjah", 
                                                                                                                                      "name_local" => "الشارقة", 
                                                                                                                                      "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                      "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                      "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                      "__v" => 0, 
                                                                                                                                      "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                      "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                      "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                      "id" => "60081756731d75ae35f558ba" 
                                                                                                                                   ], 
                                                                                                                                   "id" => "60082929e4afcdaf7e1cb8d3", 
                                                                                                                                   "stores" => [
                                                                                                                                         "count" => 0 
                                                                                                                                      ] 
                                                                                                                                ], 
        [
                                                                                                                                            "_id" => "60082929e4afcdaf7e1cb8d4", 
                                                                                                                                            "name_en" => "Al Gharb", 
                                                                                                                                            "name_local" => "الغرب", 
                                                                                                                                            "published_at" => "2021-01-20T12:59:21.239Z", 
                                                                                                                                            "createdAt" => "2021-01-20T12:59:21.243Z", 
                                                                                                                                            "updatedAt" => "2021-01-20T12:59:21.312Z", 
                                                                                                                                            "__v" => 0, 
                                                                                                                                            "city" => [
                                                                                                                                               "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                               "name_en" => "Sharjah", 
                                                                                                                                               "name_local" => "الشارقة", 
                                                                                                                                               "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                               "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                               "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                               "__v" => 0, 
                                                                                                                                               "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                               "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                               "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                               "id" => "60081756731d75ae35f558ba" 
                                                                                                                                            ], 
                                                                                                                                            "id" => "60082929e4afcdaf7e1cb8d4", 
                                                                                                                                            "stores" => [
                                                                                                                                                  "count" => 0 
                                                                                                                                               ] 
                                                                                                                                         ], 
        [
                                                                                                                                                     "_id" => "60082929e4afcdaf7e1cb8d6", 
                                                                                                                                                     "name_en" => "Al Ghuair", 
                                                                                                                                                     "name_local" => "الغوير", 
                                                                                                                                                     "published_at" => "2021-01-20T12:59:21.487Z", 
                                                                                                                                                     "createdAt" => "2021-01-20T12:59:21.494Z", 
                                                                                                                                                     "updatedAt" => "2021-01-20T12:59:21.555Z", 
                                                                                                                                                     "__v" => 0, 
                                                                                                                                                     "city" => [
                                                                                                                                                        "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                        "name_en" => "Sharjah", 
                                                                                                                                                        "name_local" => "الشارقة", 
                                                                                                                                                        "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                        "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                        "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                        "__v" => 0, 
                                                                                                                                                        "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                        "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                        "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                        "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                     ], 
                                                                                                                                                     "id" => "60082929e4afcdaf7e1cb8d6", 
                                                                                                                                                     "stores" => [
                                                                                                                                                           "count" => 0 
                                                                                                                                                        ] 
                                                                                                                                                  ], 
        [
                                                                                                                                                              "_id" => "6008292ce4afcdaf7e1cb907", 
                                                                                                                                                              "name_en" => "Al Jada", 
                                                                                                                                                              "name_local" => "شارع الاتحاد", 
                                                                                                                                                              "published_at" => "2021-01-20T12:59:24.595Z", 
                                                                                                                                                              "createdAt" => "2021-01-20T12:59:24.600Z", 
                                                                                                                                                              "updatedAt" => "2021-01-20T12:59:24.643Z", 
                                                                                                                                                              "__v" => 0, 
                                                                                                                                                              "city" => [
                                                                                                                                                                 "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                 "name_en" => "Sharjah", 
                                                                                                                                                                 "name_local" => "الشارقة", 
                                                                                                                                                                 "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                 "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                 "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                 "__v" => 0, 
                                                                                                                                                                 "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                 "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                 "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                 "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                              ], 
                                                                                                                                                              "id" => "6008292ce4afcdaf7e1cb907", 
                                                                                                                                                              "stores" => [
                                                                                                                                                                    "count" => 0 
                                                                                                                                                                 ] 
                                                                                                                                                           ], 
        [
                                                                                                                                                                       "_id" => "60082929e4afcdaf7e1cb8d7", 
                                                                                                                                                                       "name_en" => "Al Jubail", 
                                                                                                                                                                       "name_local" => "الجبيل", 
                                                                                                                                                                       "published_at" => "2021-01-20T12:59:21.517Z", 
                                                                                                                                                                       "createdAt" => "2021-01-20T12:59:21.521Z", 
                                                                                                                                                                       "updatedAt" => "2021-01-20T12:59:21.716Z", 
                                                                                                                                                                       "__v" => 0, 
                                                                                                                                                                       "city" => [
                                                                                                                                                                          "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                          "name_en" => "Sharjah", 
                                                                                                                                                                          "name_local" => "الشارقة", 
                                                                                                                                                                          "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                          "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                          "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                          "__v" => 0, 
                                                                                                                                                                          "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                          "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                          "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                          "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                       ], 
                                                                                                                                                                       "id" => "60082929e4afcdaf7e1cb8d7", 
                                                                                                                                                                       "stores" => [
                                                                                                                                                                             "count" => 0 
                                                                                                                                                                          ] 
                                                                                                                                                                    ], 
        [
                                                                                                                                                                                "_id" => "60082929e4afcdaf7e1cb8d8", 
                                                                                                                                                                                "name_en" => "Al Jurainah", 
                                                                                                                                                                                "name_local" => "الجرينة", 
                                                                                                                                                                                "published_at" => "2021-01-20T12:59:21.571Z", 
                                                                                                                                                                                "createdAt" => "2021-01-20T12:59:21.583Z", 
                                                                                                                                                                                "updatedAt" => "2021-01-20T12:59:21.844Z", 
                                                                                                                                                                                "__v" => 0, 
                                                                                                                                                                                "city" => [
                                                                                                                                                                                   "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                   "name_en" => "Sharjah", 
                                                                                                                                                                                   "name_local" => "الشارقة", 
                                                                                                                                                                                   "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                   "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                   "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                   "__v" => 0, 
                                                                                                                                                                                   "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                   "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                   "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                   "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                ], 
                                                                                                                                                                                "id" => "60082929e4afcdaf7e1cb8d8", 
                                                                                                                                                                                "stores" => [
                                                                                                                                                                                      "count" => 0 
                                                                                                                                                                                   ] 
                                                                                                                                                                             ], 
        [
                                                                                                                                                                                         "_id" => "60082929e4afcdaf7e1cb8d9", 
                                                                                                                                                                                         "name_en" => "Al Khezamia", 
                                                                                                                                                                                         "name_local" => "الحزامية", 
                                                                                                                                                                                         "published_at" => "2021-01-20T12:59:21.586Z", 
                                                                                                                                                                                         "createdAt" => "2021-01-20T12:59:21.598Z", 
                                                                                                                                                                                         "updatedAt" => "2021-01-20T12:59:21.845Z", 
                                                                                                                                                                                         "__v" => 0, 
                                                                                                                                                                                         "city" => [
                                                                                                                                                                                            "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                            "name_en" => "Sharjah", 
                                                                                                                                                                                            "name_local" => "الشارقة", 
                                                                                                                                                                                            "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                            "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                            "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                            "__v" => 0, 
                                                                                                                                                                                            "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                            "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                            "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                            "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                         ], 
                                                                                                                                                                                         "id" => "60082929e4afcdaf7e1cb8d9", 
                                                                                                                                                                                         "stores" => [
                                                                                                                                                                                               "count" => 0 
                                                                                                                                                                                            ] 
                                                                                                                                                                                      ], 
        [
                                                                                                                                                                                                  "_id" => "60082929e4afcdaf7e1cb8da", 
                                                                                                                                                                                                  "name_en" => "Al Majaz", 
                                                                                                                                                                                                  "name_local" => "المجاز", 
                                                                                                                                                                                                  "published_at" => "2021-01-20T12:59:21.817Z", 
                                                                                                                                                                                                  "createdAt" => "2021-01-20T12:59:21.821Z", 
                                                                                                                                                                                                  "updatedAt" => "2021-01-20T12:59:21.863Z", 
                                                                                                                                                                                                  "__v" => 0, 
                                                                                                                                                                                                  "city" => [
                                                                                                                                                                                                     "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                     "name_en" => "Sharjah", 
                                                                                                                                                                                                     "name_local" => "الشارقة", 
                                                                                                                                                                                                     "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                     "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                     "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                     "__v" => 0, 
                                                                                                                                                                                                     "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                     "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                     "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                     "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                  ], 
                                                                                                                                                                                                  "id" => "60082929e4afcdaf7e1cb8da", 
                                                                                                                                                                                                  "stores" => [
                                                                                                                                                                                                        "count" => 0 
                                                                                                                                                                                                     ] 
                                                                                                                                                                                               ], 
        [
                                                                                                                                                                                                           "_id" => "60082929e4afcdaf7e1cb8db", 
                                                                                                                                                                                                           "name_en" => "Al Mareija", 
                                                                                                                                                                                                           "name_local" => "المريجة", 
                                                                                                                                                                                                           "published_at" => "2021-01-20T12:59:21.992Z", 
                                                                                                                                                                                                           "createdAt" => "2021-01-20T12:59:21.997Z", 
                                                                                                                                                                                                           "updatedAt" => "2021-01-20T12:59:22.027Z", 
                                                                                                                                                                                                           "__v" => 0, 
                                                                                                                                                                                                           "city" => [
                                                                                                                                                                                                              "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                              "name_en" => "Sharjah", 
                                                                                                                                                                                                              "name_local" => "الشارقة", 
                                                                                                                                                                                                              "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                              "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                              "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                              "__v" => 0, 
                                                                                                                                                                                                              "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                              "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                              "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                              "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                           ], 
                                                                                                                                                                                                           "id" => "60082929e4afcdaf7e1cb8db", 
                                                                                                                                                                                                           "stores" => [
                                                                                                                                                                                                                 "count" => 0 
                                                                                                                                                                                                              ] 
                                                                                                                                                                                                        ], 
        [
                                                                                                                                                                                                                    "_id" => "6008292ae4afcdaf7e1cb8dc", 
                                                                                                                                                                                                                    "name_en" => "Al Mujarrah", 
                                                                                                                                                                                                                    "name_local" => "المجرة", 
                                                                                                                                                                                                                    "published_at" => "2021-01-20T12:59:22.032Z", 
                                                                                                                                                                                                                    "createdAt" => "2021-01-20T12:59:22.037Z", 
                                                                                                                                                                                                                    "updatedAt" => "2021-01-20T12:59:22.133Z", 
                                                                                                                                                                                                                    "__v" => 0, 
                                                                                                                                                                                                                    "city" => [
                                                                                                                                                                                                                       "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                       "name_en" => "Sharjah", 
                                                                                                                                                                                                                       "name_local" => "الشارقة", 
                                                                                                                                                                                                                       "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                       "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                       "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                       "__v" => 0, 
                                                                                                                                                                                                                       "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                       "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                       "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                       "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                    ], 
                                                                                                                                                                                                                    "id" => "6008292ae4afcdaf7e1cb8dc", 
                                                                                                                                                                                                                    "stores" => [
                                                                                                                                                                                                                          "count" => 0 
                                                                                                                                                                                                                       ] 
                                                                                                                                                                                                                 ], 
        [
                                                                                                                                                                                                                             "_id" => "6008292ae4afcdaf7e1cb8dd", 
                                                                                                                                                                                                                             "name_en" => "Al Nabba", 
                                                                                                                                                                                                                             "name_local" => "النباعة", 
                                                                                                                                                                                                                             "published_at" => "2021-01-20T12:59:22.087Z", 
                                                                                                                                                                                                                             "createdAt" => "2021-01-20T12:59:22.093Z", 
                                                                                                                                                                                                                             "updatedAt" => "2021-01-20T12:59:22.160Z", 
                                                                                                                                                                                                                             "__v" => 0, 
                                                                                                                                                                                                                             "city" => [
                                                                                                                                                                                                                                "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                "name_en" => "Sharjah", 
                                                                                                                                                                                                                                "name_local" => "الشارقة", 
                                                                                                                                                                                                                                "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                "__v" => 0, 
                                                                                                                                                                                                                                "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                             ], 
                                                                                                                                                                                                                             "id" => "6008292ae4afcdaf7e1cb8dd", 
                                                                                                                                                                                                                             "stores" => [
                                                                                                                                                                                                                                   "count" => 0 
                                                                                                                                                                                                                                ] 
                                                                                                                                                                                                                          ], 
        [
                                                                                                                                                                                                                                      "_id" => "6008292ae4afcdaf7e1cb8de", 
                                                                                                                                                                                                                                      "name_en" => "Al Nahda", 
                                                                                                                                                                                                                                      "name_local" => "النهدة", 
                                                                                                                                                                                                                                      "published_at" => "2021-01-20T12:59:22.095Z", 
                                                                                                                                                                                                                                      "createdAt" => "2021-01-20T12:59:22.099Z", 
                                                                                                                                                                                                                                      "updatedAt" => "2021-01-20T12:59:22.162Z", 
                                                                                                                                                                                                                                      "__v" => 0, 
                                                                                                                                                                                                                                      "city" => [
                                                                                                                                                                                                                                         "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                         "name_en" => "Sharjah", 
                                                                                                                                                                                                                                         "name_local" => "الشارقة", 
                                                                                                                                                                                                                                         "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                         "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                         "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                         "__v" => 0, 
                                                                                                                                                                                                                                         "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                         "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                         "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                         "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                      ], 
                                                                                                                                                                                                                                      "id" => "6008292ae4afcdaf7e1cb8de", 
                                                                                                                                                                                                                                      "stores" => [
                                                                                                                                                                                                                                            "count" => 0 
                                                                                                                                                                                                                                         ] 
                                                                                                                                                                                                                                   ], 
        [
                                                                                                                                                                                                                                               "_id" => "6008292ae4afcdaf7e1cb8df", 
                                                                                                                                                                                                                                               "name_en" => "Al Naimiya Area", 
                                                                                                                                                                                                                                               "name_local" => "منطقة النعيمية", 
                                                                                                                                                                                                                                               "published_at" => "2021-01-20T12:59:22.142Z", 
                                                                                                                                                                                                                                               "createdAt" => "2021-01-20T12:59:22.145Z", 
                                                                                                                                                                                                                                               "updatedAt" => "2021-01-20T12:59:22.197Z", 
                                                                                                                                                                                                                                               "__v" => 0, 
                                                                                                                                                                                                                                               "city" => [
                                                                                                                                                                                                                                                  "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                  "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                  "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                  "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                  "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                  "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                  "__v" => 0, 
                                                                                                                                                                                                                                                  "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                  "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                  "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                  "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                               ], 
                                                                                                                                                                                                                                               "id" => "6008292ae4afcdaf7e1cb8df", 
                                                                                                                                                                                                                                               "stores" => [
                                                                                                                                                                                                                                                     "count" => 0 
                                                                                                                                                                                                                                                  ] 
                                                                                                                                                                                                                                            ], 
        [
                                                                                                                                                                                                                                                        "_id" => "6008292ae4afcdaf7e1cb8e1", 
                                                                                                                                                                                                                                                        "name_en" => "Al Nasreya", 
                                                                                                                                                                                                                                                        "name_local" => "الناصرية", 
                                                                                                                                                                                                                                                        "published_at" => "2021-01-20T12:59:22.364Z", 
                                                                                                                                                                                                                                                        "createdAt" => "2021-01-20T12:59:22.368Z", 
                                                                                                                                                                                                                                                        "updatedAt" => "2021-01-20T12:59:22.445Z", 
                                                                                                                                                                                                                                                        "__v" => 0, 
                                                                                                                                                                                                                                                        "city" => [
                                                                                                                                                                                                                                                           "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                           "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                           "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                           "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                           "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                           "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                           "__v" => 0, 
                                                                                                                                                                                                                                                           "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                           "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                           "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                           "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                        ], 
                                                                                                                                                                                                                                                        "id" => "6008292ae4afcdaf7e1cb8e1", 
                                                                                                                                                                                                                                                        "stores" => [
                                                                                                                                                                                                                                                              "count" => 0 
                                                                                                                                                                                                                                                           ] 
                                                                                                                                                                                                                                                     ], 
        [
                                                                                                                                                                                                                                                                 "_id" => "6008292ae4afcdaf7e1cb8e0", 
                                                                                                                                                                                                                                                                 "name_en" => "Al Nekhailat", 
                                                                                                                                                                                                                                                                 "name_local" => "النخيلات", 
                                                                                                                                                                                                                                                                 "published_at" => "2021-01-20T12:59:22.340Z", 
                                                                                                                                                                                                                                                                 "createdAt" => "2021-01-20T12:59:22.344Z", 
                                                                                                                                                                                                                                                                 "updatedAt" => "2021-01-20T12:59:22.403Z", 
                                                                                                                                                                                                                                                                 "__v" => 0, 
                                                                                                                                                                                                                                                                 "city" => [
                                                                                                                                                                                                                                                                    "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                    "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                    "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                    "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                    "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                    "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                    "__v" => 0, 
                                                                                                                                                                                                                                                                    "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                    "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                    "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                    "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                 ], 
                                                                                                                                                                                                                                                                 "id" => "6008292ae4afcdaf7e1cb8e0", 
                                                                                                                                                                                                                                                                 "stores" => [
                                                                                                                                                                                                                                                                       "count" => 0 
                                                                                                                                                                                                                                                                    ] 
                                                                                                                                                                                                                                                              ], 
        [
                                                                                                                                                                                                                                                                          "_id" => "6008292ae4afcdaf7e1cb8e3", 
                                                                                                                                                                                                                                                                          "name_en" => "Al Nouf", 
                                                                                                                                                                                                                                                                          "name_local" => "النوف", 
                                                                                                                                                                                                                                                                          "published_at" => "2021-01-20T12:59:22.417Z", 
                                                                                                                                                                                                                                                                          "createdAt" => "2021-01-20T12:59:22.420Z", 
                                                                                                                                                                                                                                                                          "updatedAt" => "2021-01-20T12:59:22.496Z", 
                                                                                                                                                                                                                                                                          "__v" => 0, 
                                                                                                                                                                                                                                                                          "city" => [
                                                                                                                                                                                                                                                                             "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                             "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                             "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                             "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                             "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                             "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                             "__v" => 0, 
                                                                                                                                                                                                                                                                             "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                             "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                             "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                             "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                          ], 
                                                                                                                                                                                                                                                                          "id" => "6008292ae4afcdaf7e1cb8e3", 
                                                                                                                                                                                                                                                                          "stores" => [
                                                                                                                                                                                                                                                                                "count" => 0 
                                                                                                                                                                                                                                                                             ] 
                                                                                                                                                                                                                                                                       ], 
        [
                                                                                                                                                                                                                                                                                   "_id" => "6008292ae4afcdaf7e1cb8e2", 
                                                                                                                                                                                                                                                                                   "name_en" => "Al Nujoom Islands", 
                                                                                                                                                                                                                                                                                   "name_local" => "جزيرة النجوم", 
                                                                                                                                                                                                                                                                                   "published_at" => "2021-01-20T12:59:22.411Z", 
                                                                                                                                                                                                                                                                                   "createdAt" => "2021-01-20T12:59:22.415Z", 
                                                                                                                                                                                                                                                                                   "updatedAt" => "2021-01-20T12:59:22.491Z", 
                                                                                                                                                                                                                                                                                   "__v" => 0, 
                                                                                                                                                                                                                                                                                   "city" => [
                                                                                                                                                                                                                                                                                      "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                      "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                      "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                      "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                      "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                      "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                      "__v" => 0, 
                                                                                                                                                                                                                                                                                      "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                      "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                      "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                      "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                   ], 
                                                                                                                                                                                                                                                                                   "id" => "6008292ae4afcdaf7e1cb8e2", 
                                                                                                                                                                                                                                                                                   "stores" => [
                                                                                                                                                                                                                                                                                         "count" => 0 
                                                                                                                                                                                                                                                                                      ] 
                                                                                                                                                                                                                                                                                ], 
        [
                                                                                                                                                                                                                                                                                            "_id" => "6008292ae4afcdaf7e1cb8e4", 
                                                                                                                                                                                                                                                                                            "name_en" => "Al Qarain", 
                                                                                                                                                                                                                                                                                            "name_local" => "القرين", 
                                                                                                                                                                                                                                                                                            "published_at" => "2021-01-20T12:59:22.462Z", 
                                                                                                                                                                                                                                                                                            "createdAt" => "2021-01-20T12:59:22.466Z", 
                                                                                                                                                                                                                                                                                            "updatedAt" => "2021-01-20T12:59:22.521Z", 
                                                                                                                                                                                                                                                                                            "__v" => 0, 
                                                                                                                                                                                                                                                                                            "city" => [
                                                                                                                                                                                                                                                                                               "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                               "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                               "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                               "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                               "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                               "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                               "__v" => 0, 
                                                                                                                                                                                                                                                                                               "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                               "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                               "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                               "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                            ], 
                                                                                                                                                                                                                                                                                            "id" => "6008292ae4afcdaf7e1cb8e4", 
                                                                                                                                                                                                                                                                                            "stores" => [
                                                                                                                                                                                                                                                                                                  "count" => 0 
                                                                                                                                                                                                                                                                                               ] 
                                                                                                                                                                                                                                                                                         ], 
        [
                                                                                                                                                                                                                                                                                                     "_id" => "6008292ae4afcdaf7e1cb8e5", 
                                                                                                                                                                                                                                                                                                     "name_en" => "Al Qasbaa", 
                                                                                                                                                                                                                                                                                                     "name_local" => "القصباء", 
                                                                                                                                                                                                                                                                                                     "published_at" => "2021-01-20T12:59:22.638Z", 
                                                                                                                                                                                                                                                                                                     "createdAt" => "2021-01-20T12:59:22.641Z", 
                                                                                                                                                                                                                                                                                                     "updatedAt" => "2021-01-20T12:59:22.661Z", 
                                                                                                                                                                                                                                                                                                     "__v" => 0, 
                                                                                                                                                                                                                                                                                                     "city" => [
                                                                                                                                                                                                                                                                                                        "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                        "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                        "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                        "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                        "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                        "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                        "__v" => 0, 
                                                                                                                                                                                                                                                                                                        "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                        "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                        "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                        "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                     ], 
                                                                                                                                                                                                                                                                                                     "id" => "6008292ae4afcdaf7e1cb8e5", 
                                                                                                                                                                                                                                                                                                     "stores" => [
                                                                                                                                                                                                                                                                                                           "count" => 0 
                                                                                                                                                                                                                                                                                                        ] 
                                                                                                                                                                                                                                                                                                  ], 
        [
                                                                                                                                                                                                                                                                                                              "_id" => "6008292ae4afcdaf7e1cb8e6", 
                                                                                                                                                                                                                                                                                                              "name_en" => "Al Qasemiya", 
                                                                                                                                                                                                                                                                                                              "name_local" => "القاسمية", 
                                                                                                                                                                                                                                                                                                              "published_at" => "2021-01-20T12:59:22.693Z", 
                                                                                                                                                                                                                                                                                                              "createdAt" => "2021-01-20T12:59:22.696Z", 
                                                                                                                                                                                                                                                                                                              "updatedAt" => "2021-01-20T12:59:22.727Z", 
                                                                                                                                                                                                                                                                                                              "__v" => 0, 
                                                                                                                                                                                                                                                                                                              "city" => [
                                                                                                                                                                                                                                                                                                                 "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                 "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                 "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                 "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                 "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                 "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                 "__v" => 0, 
                                                                                                                                                                                                                                                                                                                 "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                 "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                 "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                 "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                              ], 
                                                                                                                                                                                                                                                                                                              "id" => "6008292ae4afcdaf7e1cb8e6", 
                                                                                                                                                                                                                                                                                                              "stores" => [
                                                                                                                                                                                                                                                                                                                    "count" => 0 
                                                                                                                                                                                                                                                                                                                 ] 
                                                                                                                                                                                                                                                                                                           ], 
        [
                                                                                                                                                                                                                                                                                                                       "_id" => "6008292ae4afcdaf7e1cb8e7", 
                                                                                                                                                                                                                                                                                                                       "name_en" => "Al Rahmaniya", 
                                                                                                                                                                                                                                                                                                                       "name_local" => "الرحمانية", 
                                                                                                                                                                                                                                                                                                                       "published_at" => "2021-01-20T12:59:22.738Z", 
                                                                                                                                                                                                                                                                                                                       "createdAt" => "2021-01-20T12:59:22.741Z", 
                                                                                                                                                                                                                                                                                                                       "updatedAt" => "2021-01-20T12:59:22.769Z", 
                                                                                                                                                                                                                                                                                                                       "__v" => 0, 
                                                                                                                                                                                                                                                                                                                       "city" => [
                                                                                                                                                                                                                                                                                                                          "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                          "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                          "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                          "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                          "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                          "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                          "__v" => 0, 
                                                                                                                                                                                                                                                                                                                          "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                          "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                          "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                          "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                       ], 
                                                                                                                                                                                                                                                                                                                       "id" => "6008292ae4afcdaf7e1cb8e7", 
                                                                                                                                                                                                                                                                                                                       "stores" => [
                                                                                                                                                                                                                                                                                                                             "count" => 0 
                                                                                                                                                                                                                                                                                                                          ] 
                                                                                                                                                                                                                                                                                                                    ], 
        [
                                                                                                                                                                                                                                                                                                                                "_id" => "6008292ce4afcdaf7e1cb90d", 
                                                                                                                                                                                                                                                                                                                                "name_en" => "Al Ramaqiya", 
                                                                                                                                                                                                                                                                                                                                "name_local" => "الرماقية", 
                                                                                                                                                                                                                                                                                                                                "published_at" => "2021-01-20T12:59:24.942Z", 
                                                                                                                                                                                                                                                                                                                                "createdAt" => "2021-01-20T12:59:24.945Z", 
                                                                                                                                                                                                                                                                                                                                "updatedAt" => "2021-01-20T12:59:24.970Z", 
                                                                                                                                                                                                                                                                                                                                "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                "city" => [
                                                                                                                                                                                                                                                                                                                                   "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                   "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                   "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                   "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                   "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                   "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                   "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                   "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                   "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                   "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                   "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                ], 
                                                                                                                                                                                                                                                                                                                                "id" => "6008292ce4afcdaf7e1cb90d", 
                                                                                                                                                                                                                                                                                                                                "stores" => [
                                                                                                                                                                                                                                                                                                                                      "count" => 0 
                                                                                                                                                                                                                                                                                                                                   ] 
                                                                                                                                                                                                                                                                                                                             ], 
        [
                                                                                                                                                                                                                                                                                                                                         "_id" => "6008292ae4afcdaf7e1cb8e8", 
                                                                                                                                                                                                                                                                                                                                         "name_en" => "Al Ramla", 
                                                                                                                                                                                                                                                                                                                                         "name_local" => "الرملة", 
                                                                                                                                                                                                                                                                                                                                         "published_at" => "2021-01-20T12:59:22.750Z", 
                                                                                                                                                                                                                                                                                                                                         "createdAt" => "2021-01-20T12:59:22.754Z", 
                                                                                                                                                                                                                                                                                                                                         "updatedAt" => "2021-01-20T12:59:22.786Z", 
                                                                                                                                                                                                                                                                                                                                         "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                         "city" => [
                                                                                                                                                                                                                                                                                                                                            "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                            "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                            "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                            "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                            "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                            "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                            "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                            "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                            "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                            "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                            "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                         ], 
                                                                                                                                                                                                                                                                                                                                         "id" => "6008292ae4afcdaf7e1cb8e8", 
                                                                                                                                                                                                                                                                                                                                         "stores" => [
                                                                                                                                                                                                                                                                                                                                               "count" => 0 
                                                                                                                                                                                                                                                                                                                                            ] 
                                                                                                                                                                                                                                                                                                                                      ], 
        [
                                                                                                                                                                                                                                                                                                                                                  "_id" => "6008292ae4afcdaf7e1cb8e9", 
                                                                                                                                                                                                                                                                                                                                                  "name_en" => "Al Ramtha", 
                                                                                                                                                                                                                                                                                                                                                  "name_local" => "الرمثاء", 
                                                                                                                                                                                                                                                                                                                                                  "published_at" => "2021-01-20T12:59:22.791Z", 
                                                                                                                                                                                                                                                                                                                                                  "createdAt" => "2021-01-20T12:59:22.793Z", 
                                                                                                                                                                                                                                                                                                                                                  "updatedAt" => "2021-01-20T12:59:22.818Z", 
                                                                                                                                                                                                                                                                                                                                                  "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                  "city" => [
                                                                                                                                                                                                                                                                                                                                                     "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                     "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                     "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                     "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                     "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                     "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                     "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                     "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                     "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                     "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                     "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                  ], 
                                                                                                                                                                                                                                                                                                                                                  "id" => "6008292ae4afcdaf7e1cb8e9", 
                                                                                                                                                                                                                                                                                                                                                  "stores" => [
                                                                                                                                                                                                                                                                                                                                                        "count" => 0 
                                                                                                                                                                                                                                                                                                                                                     ] 
                                                                                                                                                                                                                                                                                                                                               ], 
        [
                                                                                                                                                                                                                                                                                                                                                           "_id" => "6008292ae4afcdaf7e1cb8ea", 
                                                                                                                                                                                                                                                                                                                                                           "name_en" => "Al Riffa Area", 
                                                                                                                                                                                                                                                                                                                                                           "name_local" => "منطقة الرفاع", 
                                                                                                                                                                                                                                                                                                                                                           "published_at" => "2021-01-20T12:59:22.870Z", 
                                                                                                                                                                                                                                                                                                                                                           "createdAt" => "2021-01-20T12:59:22.876Z", 
                                                                                                                                                                                                                                                                                                                                                           "updatedAt" => "2021-01-20T12:59:22.883Z", 
                                                                                                                                                                                                                                                                                                                                                           "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                           "city" => [
                                                                                                                                                                                                                                                                                                                                                              "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                              "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                              "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                              "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                              "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                              "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                              "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                              "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                              "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                              "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                              "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                           ], 
                                                                                                                                                                                                                                                                                                                                                           "id" => "6008292ae4afcdaf7e1cb8ea", 
                                                                                                                                                                                                                                                                                                                                                           "stores" => [
                                                                                                                                                                                                                                                                                                                                                                 "count" => 0 
                                                                                                                                                                                                                                                                                                                                                              ] 
                                                                                                                                                                                                                                                                                                                                                        ], 
        [
                                                                                                                                                                                                                                                                                                                                                                    "_id" => "6008292ae4afcdaf7e1cb8eb", 
                                                                                                                                                                                                                                                                                                                                                                    "name_en" => "Al Riqqa", 
                                                                                                                                                                                                                                                                                                                                                                    "name_local" => "ضاحية الرقة", 
                                                                                                                                                                                                                                                                                                                                                                    "published_at" => "2021-01-20T12:59:22.917Z", 
                                                                                                                                                                                                                                                                                                                                                                    "createdAt" => "2021-01-20T12:59:22.920Z", 
                                                                                                                                                                                                                                                                                                                                                                    "updatedAt" => "2021-01-20T12:59:22.928Z", 
                                                                                                                                                                                                                                                                                                                                                                    "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                    "city" => [
                                                                                                                                                                                                                                                                                                                                                                       "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                       "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                       "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                       "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                       "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                       "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                       "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                       "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                       "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                       "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                       "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                    ], 
                                                                                                                                                                                                                                                                                                                                                                    "id" => "6008292ae4afcdaf7e1cb8eb", 
                                                                                                                                                                                                                                                                                                                                                                    "stores" => [
                                                                                                                                                                                                                                                                                                                                                                          "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                       ] 
                                                                                                                                                                                                                                                                                                                                                                 ], 
        [
                                                                                                                                                                                                                                                                                                                                                                             "_id" => "6008292ae4afcdaf7e1cb8ec", 
                                                                                                                                                                                                                                                                                                                                                                             "name_en" => "Al Sajaa", 
                                                                                                                                                                                                                                                                                                                                                                             "name_local" => "السجع", 
                                                                                                                                                                                                                                                                                                                                                                             "published_at" => "2021-01-20T12:59:22.958Z", 
                                                                                                                                                                                                                                                                                                                                                                             "createdAt" => "2021-01-20T12:59:22.962Z", 
                                                                                                                                                                                                                                                                                                                                                                             "updatedAt" => "2021-01-20T12:59:22.995Z", 
                                                                                                                                                                                                                                                                                                                                                                             "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                             "city" => [
                                                                                                                                                                                                                                                                                                                                                                                "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                             ], 
                                                                                                                                                                                                                                                                                                                                                                             "id" => "6008292ae4afcdaf7e1cb8ec", 
                                                                                                                                                                                                                                                                                                                                                                             "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                   "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                ] 
                                                                                                                                                                                                                                                                                                                                                                          ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                      "_id" => "6008292ae4afcdaf7e1cb8ed", 
                                                                                                                                                                                                                                                                                                                                                                                      "name_en" => "Al Shahba", 
                                                                                                                                                                                                                                                                                                                                                                                      "name_local" => "الشهباء", 
                                                                                                                                                                                                                                                                                                                                                                                      "published_at" => "2021-01-20T12:59:22.986Z", 
                                                                                                                                                                                                                                                                                                                                                                                      "createdAt" => "2021-01-20T12:59:22.992Z", 
                                                                                                                                                                                                                                                                                                                                                                                      "updatedAt" => "2021-01-20T12:59:23.044Z", 
                                                                                                                                                                                                                                                                                                                                                                                      "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                      "city" => [
                                                                                                                                                                                                                                                                                                                                                                                         "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                         "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                         "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                         "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                         "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                         "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                         "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                         "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                         "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                         "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                         "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                      ], 
                                                                                                                                                                                                                                                                                                                                                                                      "id" => "6008292ae4afcdaf7e1cb8ed", 
                                                                                                                                                                                                                                                                                                                                                                                      "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                            "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                         ] 
                                                                                                                                                                                                                                                                                                                                                                                   ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                               "_id" => "6008292be4afcdaf7e1cb8ef", 
                                                                                                                                                                                                                                                                                                                                                                                               "name_en" => "Al Sharq", 
                                                                                                                                                                                                                                                                                                                                                                                               "name_local" => "الشرق", 
                                                                                                                                                                                                                                                                                                                                                                                               "published_at" => "2021-01-20T12:59:23.081Z", 
                                                                                                                                                                                                                                                                                                                                                                                               "createdAt" => "2021-01-20T12:59:23.084Z", 
                                                                                                                                                                                                                                                                                                                                                                                               "updatedAt" => "2021-01-20T12:59:23.117Z", 
                                                                                                                                                                                                                                                                                                                                                                                               "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                               "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                  "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                  "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                  "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                  "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                  "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                  "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                  "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                  "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                  "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                  "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                  "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                               ], 
                                                                                                                                                                                                                                                                                                                                                                                               "id" => "6008292be4afcdaf7e1cb8ef", 
                                                                                                                                                                                                                                                                                                                                                                                               "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                     "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                  ] 
                                                                                                                                                                                                                                                                                                                                                                                            ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                        "_id" => "6008292be4afcdaf7e1cb8f0", 
                                                                                                                                                                                                                                                                                                                                                                                                        "name_en" => "Al Suyoh", 
                                                                                                                                                                                                                                                                                                                                                                                                        "name_local" => "السيوح", 
                                                                                                                                                                                                                                                                                                                                                                                                        "published_at" => "2021-01-20T12:59:23.121Z", 
                                                                                                                                                                                                                                                                                                                                                                                                        "createdAt" => "2021-01-20T12:59:23.124Z", 
                                                                                                                                                                                                                                                                                                                                                                                                        "updatedAt" => "2021-01-20T12:59:23.142Z", 
                                                                                                                                                                                                                                                                                                                                                                                                        "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                        "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                           "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                           "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                           "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                           "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                           "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                           "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                           "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                           "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                           "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                           "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                           "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                        ], 
                                                                                                                                                                                                                                                                                                                                                                                                        "id" => "6008292be4afcdaf7e1cb8f0", 
                                                                                                                                                                                                                                                                                                                                                                                                        "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                              "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                           ] 
                                                                                                                                                                                                                                                                                                                                                                                                     ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                 "_id" => "6008292be4afcdaf7e1cb8f1", 
                                                                                                                                                                                                                                                                                                                                                                                                                 "name_en" => "Al Suyoh Suburb", 
                                                                                                                                                                                                                                                                                                                                                                                                                 "name_local" => "ضاحية السيوح", 
                                                                                                                                                                                                                                                                                                                                                                                                                 "published_at" => "2021-01-20T12:59:23.226Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                 "createdAt" => "2021-01-20T12:59:23.236Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                 "updatedAt" => "2021-01-20T12:59:23.285Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                 "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                 "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                    "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                    "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                    "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                    "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                    "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                    "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                    "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                    "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                    "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                    "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                    "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                 ], 
                                                                                                                                                                                                                                                                                                                                                                                                                 "id" => "6008292be4afcdaf7e1cb8f1", 
                                                                                                                                                                                                                                                                                                                                                                                                                 "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                       "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                    ] 
                                                                                                                                                                                                                                                                                                                                                                                                              ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                          "_id" => "6008292be4afcdaf7e1cb8ee", 
                                                                                                                                                                                                                                                                                                                                                                                                                          "name_en" => "Al Taawun", 
                                                                                                                                                                                                                                                                                                                                                                                                                          "name_local" => "التعاون", 
                                                                                                                                                                                                                                                                                                                                                                                                                          "published_at" => "2021-01-20T12:59:23.030Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                          "createdAt" => "2021-01-20T12:59:23.034Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                          "updatedAt" => "2021-01-20T12:59:23.074Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                          "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                          "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                             "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                             "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                             "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                             "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                             "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                             "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                             "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                             "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                             "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                             "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                             "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                          ], 
                                                                                                                                                                                                                                                                                                                                                                                                                          "id" => "6008292be4afcdaf7e1cb8ee", 
                                                                                                                                                                                                                                                                                                                                                                                                                          "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                             ] 
                                                                                                                                                                                                                                                                                                                                                                                                                       ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                   "_id" => "6008292be4afcdaf7e1cb8f2", 
                                                                                                                                                                                                                                                                                                                                                                                                                                   "name_en" => "Al Tai", 
                                                                                                                                                                                                                                                                                                                                                                                                                                   "name_local" => "الطي", 
                                                                                                                                                                                                                                                                                                                                                                                                                                   "published_at" => "2021-01-20T12:59:23.300Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                   "createdAt" => "2021-01-20T12:59:23.304Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                   "updatedAt" => "2021-01-20T12:59:23.384Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                   "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                   "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                      "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                      "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                      "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                      "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                      "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                      "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                      "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                      "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                      "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                      "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                      "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                   ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                   "id" => "6008292be4afcdaf7e1cb8f2", 
                                                                                                                                                                                                                                                                                                                                                                                                                                   "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                         "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                      ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                            "_id" => "6008292be4afcdaf7e1cb8f3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                            "name_en" => "Al Tayy Suburb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                            "name_local" => "ضاحية الطي", 
                                                                                                                                                                                                                                                                                                                                                                                                                                            "published_at" => "2021-01-20T12:59:23.325Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                            "createdAt" => "2021-01-20T12:59:23.333Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                            "updatedAt" => "2021-01-20T12:59:23.395Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                            "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                            "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                               "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                               "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                               "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                               "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                               "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                               "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                               "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                               "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                               "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                               "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                               "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                            ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                            "id" => "6008292be4afcdaf7e1cb8f3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                            "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                  "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                               ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                         ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                     "_id" => "6008292be4afcdaf7e1cb8f4", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                     "name_en" => "Al Wahda", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                     "name_local" => "الوحدة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                     "published_at" => "2021-01-20T12:59:23.356Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                     "createdAt" => "2021-01-20T12:59:23.359Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                     "updatedAt" => "2021-01-20T12:59:23.413Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                     "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                     "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                     ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                     "id" => "6008292be4afcdaf7e1cb8f4", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                     "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                           "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                        ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                  ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                              "_id" => "6008292be4afcdaf7e1cb8f5", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              "name_en" => "Al Yarmouk", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              "name_local" => "اليرموك", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              "published_at" => "2021-01-20T12:59:23.378Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              "createdAt" => "2021-01-20T12:59:23.382Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              "updatedAt" => "2021-01-20T12:59:23.430Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              "id" => "6008292be4afcdaf7e1cb8f5", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                              "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                           ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "_id" => "6008292de4afcdaf7e1cb90f", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "name_en" => "Al Yash", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "name_local" => "الياش", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "published_at" => "2021-01-20T12:59:25.015Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "createdAt" => "2021-01-20T12:59:25.019Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "updatedAt" => "2021-01-20T12:59:25.046Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "id" => "6008292de4afcdaf7e1cb90f", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "_id" => "6008292be4afcdaf7e1cb8f6", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "name_en" => "Al Zubair", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "name_local" => "الزبير", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "published_at" => "2021-01-20T12:59:23.555Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "createdAt" => "2021-01-20T12:59:23.562Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "updatedAt" => "2021-01-20T12:59:23.580Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "id" => "6008292be4afcdaf7e1cb8f6", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "_id" => "6008292ce4afcdaf7e1cb90b", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "name_en" => "Bu Tina", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "name_local" => "بوطينة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "published_at" => "2021-01-20T12:59:24.774Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "createdAt" => "2021-01-20T12:59:24.778Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "updatedAt" => "2021-01-20T12:59:24.818Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "id" => "6008292ce4afcdaf7e1cb90b", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "_id" => "6008292be4afcdaf7e1cb8f7", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "name_en" => "Cornich Al Buhaira", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "name_local" => "كورنيش البحيرة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "published_at" => "2021-01-20T12:59:23.605Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "createdAt" => "2021-01-20T12:59:23.609Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "updatedAt" => "2021-01-20T12:59:23.686Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "id" => "6008292be4afcdaf7e1cb8f7", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "_id" => "6008292be4afcdaf7e1cb8f8", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "name_en" => "Hamriyah Free Zone", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "name_local" => "المنطقة الحرة بالحامرية", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "published_at" => "2021-01-20T12:59:23.649Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "createdAt" => "2021-01-20T12:59:23.653Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "updatedAt" => "2021-01-20T12:59:23.704Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "id" => "6008292be4afcdaf7e1cb8f8", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "_id" => "6008292ce4afcdaf7e1cb909", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "name_en" => "Hoshi", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "name_local" => "حوشي", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "published_at" => "2021-01-20T12:59:24.662Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "createdAt" => "2021-01-20T12:59:24.666Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "updatedAt" => "2021-01-20T12:59:24.739Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "id" => "6008292ce4afcdaf7e1cb909", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "_id" => "6008292ce4afcdaf7e1cb901", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "name_en" => "Industrial Area", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "name_local" => "المنطقة الصناعية", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "published_at" => "2021-01-20T12:59:24.235Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "createdAt" => "2021-01-20T12:59:24.239Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "updatedAt" => "2021-01-20T12:59:24.261Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "id" => "6008292ce4afcdaf7e1cb901", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "_id" => "6008292be4afcdaf7e1cb8fa", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "name_en" => "Jwezaa", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "name_local" => "جويرة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "published_at" => "2021-01-20T12:59:23.692Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "createdAt" => "2021-01-20T12:59:23.695Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "updatedAt" => "2021-01-20T12:59:23.724Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "id" => "6008292be4afcdaf7e1cb8fa", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "_id" => "6008292be4afcdaf7e1cb8fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "name_en" => "Maysaloon", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "name_local" => "ميسلون", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "published_at" => "2021-01-20T12:59:23.760Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "createdAt" => "2021-01-20T12:59:23.762Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "updatedAt" => "2021-01-20T12:59:23.768Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "id" => "6008292be4afcdaf7e1cb8fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "_id" => "6008292be4afcdaf7e1cb8fc", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "name_en" => "Muelih", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "name_local" => "مويلح", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "published_at" => "2021-01-20T12:59:23.879Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "createdAt" => "2021-01-20T12:59:23.886Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "updatedAt" => "2021-01-20T12:59:23.982Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "id" => "6008292be4afcdaf7e1cb8fc", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "_id" => "6008292ce4afcdaf7e1cb8fe", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "name_en" => "Muelih Commercial", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "name_local" => "تجارية مويلح", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "published_at" => "2021-01-20T12:59:24.007Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "createdAt" => "2021-01-20T12:59:24.011Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "updatedAt" => "2021-01-20T12:59:24.073Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "id" => "6008292ce4afcdaf7e1cb8fe", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "_id" => "6008292be4afcdaf7e1cb8fd", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "name_en" => "Mughaidir", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "name_local" => "مغيدر", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "published_at" => "2021-01-20T12:59:23.947Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "createdAt" => "2021-01-20T12:59:23.953Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "updatedAt" => "2021-01-20T12:59:24.058Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "id" => "6008292be4afcdaf7e1cb8fd", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "_id" => "6008292ce4afcdaf7e1cb8ff", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "name_en" => "Rolla Area", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "name_local" => "منطقة الرولة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "published_at" => "2021-01-20T12:59:24.014Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "createdAt" => "2021-01-20T12:59:24.018Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "updatedAt" => "2021-01-20T12:59:24.074Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "id" => "6008292ce4afcdaf7e1cb8ff", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "_id" => "6008292ce4afcdaf7e1cb902", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "name_en" => "Sharqan", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "name_local" => "شرقان", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "published_at" => "2021-01-20T12:59:24.268Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "createdAt" => "2021-01-20T12:59:24.273Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "updatedAt" => "2021-01-20T12:59:24.386Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "id" => "6008292ce4afcdaf7e1cb902", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "_id" => "6008292ce4afcdaf7e1cb904", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "name_en" => "Tilal City", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "name_local" => "تلال سيتي", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "published_at" => "2021-01-20T12:59:24.378Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "createdAt" => "2021-01-20T12:59:24.382Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "updatedAt" => "2021-01-20T12:59:24.429Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "id" => "6008292ce4afcdaf7e1cb904", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "_id" => "6008292ce4afcdaf7e1cb905", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "name_en" => "Um Altaraffa", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "name_local" => "ام الطرفة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "published_at" => "2021-01-20T12:59:24.405Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "createdAt" => "2021-01-20T12:59:24.409Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "updatedAt" => "2021-01-20T12:59:24.441Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "id" => "6008292ce4afcdaf7e1cb905", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "_id" => "6008292ce4afcdaf7e1cb903", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "name_en" => "Umm Khanoor", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "name_local" => "ام خنور", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "published_at" => "2021-01-20T12:59:24.372Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "createdAt" => "2021-01-20T12:59:24.376Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "updatedAt" => "2021-01-20T12:59:24.428Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "id" => "6008292ce4afcdaf7e1cb903", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "_id" => "6008292ce4afcdaf7e1cb90a", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "name_en" => "University City", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "name_local" => "المدينة الجامعية", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "published_at" => "2021-01-20T12:59:24.687Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "createdAt" => "2021-01-20T12:59:24.695Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "updatedAt" => "2021-01-20T12:59:24.763Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "id" => "6008292ce4afcdaf7e1cb90a", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ], 
        [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "_id" => "6008292ce4afcdaf7e1cb906", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "name_en" => "Wasit", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "name_local" => "ضاحية واسط", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "published_at" => "2021-01-20T12:59:24.512Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "createdAt" => "2021-01-20T12:59:24.515Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "updatedAt" => "2021-01-20T12:59:24.532Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "city" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "_id" => "60081756731d75ae35f558ba", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "name_en" => "Sharjah", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "name_local" => "الشارقة", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "published_at" => "2021-01-20T11:43:22.182Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "createdAt" => "2021-01-20T11:43:18.929Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "updatedAt" => "2021-01-20T11:53:34.324Z", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "__v" => 0, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "country" => "600814ac731d75ae35f558b3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "created_by" => "6004649e1c86b983d285e5fb", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "updated_by" => "600454b4eb44d770c0928cf3", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            "id" => "60081756731d75ae35f558ba" 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         ], 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "id" => "6008292ce4afcdaf7e1cb906", 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         "stores" => [
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               "count" => 0 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ] 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ] 
     ]; 


     $dubaiAreas = [
        [
            "_id" => "60082a38e4afcdaf7e1cb933",
            "name_en" => "Acacia Avenues",
            "name_local" => "القوز",
            "published_at" => "2021-01-20T13:03:52.475Z",
            "createdAt" => "2021-01-20T13:03:52.490Z",
            "updatedAt" => "2021-01-20T13:03:52.576Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a38e4afcdaf7e1cb933",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a38e4afcdaf7e1cb934",
            "name_en" => "Academic City",
            "name_local" => "المدينة الأكاديمية",
            "published_at" => "2021-01-20T13:03:52.493Z",
            "createdAt" => "2021-01-20T13:03:52.500Z",
            "updatedAt" => "2021-01-20T13:03:52.577Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a38e4afcdaf7e1cb934",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a38e4afcdaf7e1cb937",
            "name_en" => "Al Aweer",
            "name_local" => "العوير",
            "published_at" => "2021-01-20T13:03:52.560Z",
            "createdAt" => "2021-01-20T13:03:52.564Z",
            "updatedAt" => "2021-01-20T13:03:52.595Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a38e4afcdaf7e1cb937",
            "stores" => [
                "count" => 0
            ]
        ],
       
        [
            "_id" => "60082a38e4afcdaf7e1cb936",
            "name_en" => "Al Badaa",
            "name_local" => "البدع",
            "published_at" => "2021-01-20T13:03:52.549Z",
            "createdAt" => "2021-01-20T13:03:52.557Z",
            "updatedAt" => "2021-01-20T13:03:52.594Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a38e4afcdaf7e1cb936",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a38e4afcdaf7e1cb935",
            "name_en" => "Al Barari",
            "name_local" => "البراري",
            "published_at" => "2021-01-20T13:03:52.503Z",
            "createdAt" => "2021-01-20T13:03:52.506Z",
            "updatedAt" => "2021-01-20T13:03:52.578Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a38e4afcdaf7e1cb935",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a38e4afcdaf7e1cb938",
            "name_en" => "Al Barsha",
            "name_local" => "البرشاء",
            "published_at" => "2021-01-20T13:03:52.769Z",
            "createdAt" => "2021-01-20T13:03:52.776Z",
            "updatedAt" => "2021-03-13T07:16:03.384Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "stores" => [
                "count" => 2
            ],
            "id" => "60082a38e4afcdaf7e1cb938"
        ],
        [
            "_id" => "60082a38e4afcdaf7e1cb939",
            "name_en" => "Al Furjan",
            "name_local" => "الفرجان",
            "published_at" => "2021-01-20T13:03:52.828Z",
            "createdAt" => "2021-01-20T13:03:52.833Z",
            "updatedAt" => "2021-01-20T13:03:52.909Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a38e4afcdaf7e1cb939",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a38e4afcdaf7e1cb93a",
            "name_en" => "Al Garhoud",
            "name_local" => "القرهود",
            "published_at" => "2021-01-20T13:03:52.836Z",
            "createdAt" => "2021-01-20T13:03:52.840Z",
            "updatedAt" => "2021-01-20T13:03:52.910Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a38e4afcdaf7e1cb93a",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a38e4afcdaf7e1cb93b",
            "name_en" => "Al Hamriya",
            "name_local" => "الحميرية",
            "published_at" => "2021-01-20T13:03:52.869Z",
            "createdAt" => "2021-01-20T13:03:52.873Z",
            "updatedAt" => "2021-01-20T13:03:52.926Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a38e4afcdaf7e1cb93b",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a38e4afcdaf7e1cb93c",
            "name_en" => "Al Jaddaf",
            "name_local" => "الجداف",
            "published_at" => "2021-01-20T13:03:52.891Z",
            "createdAt" => "2021-01-20T13:03:52.895Z",
            "updatedAt" => "2021-01-20T13:03:52.941Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a38e4afcdaf7e1cb93c",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb93d",
            "name_en" => "Al Jafiliya",
            "name_local" => "الجافلية",
            "published_at" => "2021-01-20T13:03:53.081Z",
            "createdAt" => "2021-01-20T13:03:53.085Z",
            "updatedAt" => "2021-01-20T13:03:53.095Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb93d",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb93e",
            "name_en" => "Al Khawaneej",
            "name_local" => "الكورنيش",
            "published_at" => "2021-01-20T13:03:53.115Z",
            "createdAt" => "2021-01-20T13:03:53.118Z",
            "updatedAt" => "2021-01-20T13:03:53.183Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb93e",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a40e4afcdaf7e1cb9ae",
            "name_en" => "Al Manara",
            "name_local" => "المنارة",
            "published_at" => "2021-01-20T13:04:00.289Z",
            "createdAt" => "2021-01-20T13:04:00.292Z",
            "updatedAt" => "2021-01-20T13:04:00.301Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a40e4afcdaf7e1cb9ae",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb93f",
            "name_en" => "Al Mizhar",
            "name_local" => "المزهر",
            "published_at" => "2021-01-20T13:03:53.147Z",
            "createdAt" => "2021-01-20T13:03:53.154Z",
            "updatedAt" => "2021-01-20T13:03:53.210Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb93f",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb940",
            "name_en" => "Al Muhaisnah",
            "name_local" => "المحيسنية",
            "published_at" => "2021-01-20T13:03:53.193Z",
            "createdAt" => "2021-01-20T13:03:53.196Z",
            "updatedAt" => "2021-01-20T13:03:53.232Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb940",
            "stores" => [
                "count" => 0
            ]
        ],
    
        [
            "_id" => "60082a3fe4afcdaf7e1cb9a2",
            "name_en" => "Al Nahda",
            "name_local" => "النهدا",
            "published_at" => "2021-01-20T13:03:59.333Z",
            "createdAt" => "2021-01-20T13:03:59.335Z",
            "updatedAt" => "2021-01-20T13:03:59.354Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3fe4afcdaf7e1cb9a2",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb942",
            "name_en" => "Al Quoz",
            "name_local" => "القوز",
            "published_at" => "2021-01-20T13:03:53.286Z",
            "createdAt" => "2021-01-20T13:03:53.289Z",
            "updatedAt" => "2021-01-20T13:03:53.297Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb942",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb943",
            "name_en" => "Al Qusais",
            "name_local" => "القصيص",
            "published_at" => "2021-01-20T13:03:53.379Z",
            "createdAt" => "2021-01-20T13:03:53.383Z",
            "updatedAt" => "2021-01-20T13:03:53.409Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb943",
            "stores" => [
                "count" => 0
            ]
        ],
      
        [
            "_id" => "60082a39e4afcdaf7e1cb944",
            "name_en" => "Al Rashidiya",
            "name_local" => "الراشدية",
            "published_at" => "2021-01-20T13:03:53.425Z",
            "createdAt" => "2021-01-20T13:03:53.433Z",
            "updatedAt" => "2021-01-20T13:03:53.517Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb944",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb945",
            "name_en" => "Al Safa",
            "name_local" => "الصفا",
            "published_at" => "2021-01-20T13:03:53.455Z",
            "createdAt" => "2021-01-20T13:03:53.459Z",
            "updatedAt" => "2021-01-20T13:03:53.534Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb945",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb946",
            "name_en" => "Al Satwa",
            "name_local" => "السطوة",
            "published_at" => "2021-01-20T13:03:53.481Z",
            "createdAt" => "2021-01-20T13:03:53.485Z",
            "updatedAt" => "2021-01-20T13:03:53.546Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb946",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb947",
            "name_en" => "Al Shindagah",
            "name_local" => "الشندغة",
            "published_at" => "2021-01-20T13:03:53.527Z",
            "createdAt" => "2021-01-20T13:03:53.531Z",
            "updatedAt" => "2021-01-20T13:03:53.579Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb947",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb948",
            "name_en" => "Al Sufouh",
            "name_local" => "الصفة",
            "published_at" => "2021-01-20T13:03:53.763Z",
            "createdAt" => "2021-01-20T13:03:53.768Z",
            "updatedAt" => "2021-01-20T13:03:53.952Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb948",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb949",
            "name_en" => "Al Twar",
            "name_local" => "الطور",
            "published_at" => "2021-01-20T13:03:53.771Z",
            "createdAt" => "2021-01-20T13:03:53.777Z",
            "updatedAt" => "2021-01-20T13:03:53.954Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb949",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb94a",
            "name_en" => "Al Warqa'a",
            "name_local" => "الورقاء",
            "published_at" => "2021-01-20T13:03:53.909Z",
            "createdAt" => "2021-01-20T13:03:53.915Z",
            "updatedAt" => "2021-01-20T13:03:53.968Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb94a",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb94b",
            "name_en" => "Al Warsan",
            "name_local" => "الورسان",
            "published_at" => "2021-01-20T13:03:53.918Z",
            "createdAt" => "2021-01-20T13:03:53.923Z",
            "updatedAt" => "2021-01-20T13:03:53.969Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb94b",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a39e4afcdaf7e1cb94c",
            "name_en" => "Al Wasl",
            "name_local" => "الوصل",
            "published_at" => "2021-01-20T13:03:53.928Z",
            "createdAt" => "2021-01-20T13:03:53.931Z",
            "updatedAt" => "2021-01-20T13:03:53.970Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a39e4afcdaf7e1cb94c",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb94d",
            "name_en" => "Arabian Ranches",
            "name_local" => "المرابع العربية",
            "published_at" => "2021-01-20T13:03:54.159Z",
            "createdAt" => "2021-01-20T13:03:54.168Z",
            "updatedAt" => "2021-01-20T13:03:54.254Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb94d",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3fe4afcdaf7e1cb9a6",
            "name_en" => "Bluewaters Island",
            "name_local" => "جزيرة بلوواترز",
            "published_at" => "2021-01-20T13:03:59.601Z",
            "createdAt" => "2021-01-20T13:03:59.608Z",
            "updatedAt" => "2021-01-20T13:03:59.645Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3fe4afcdaf7e1cb9a6",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb94e",
            "name_en" => "Bur Dubai",
            "name_local" => "بر دبي",
            "published_at" => "2021-01-20T13:03:54.170Z",
            "createdAt" => "2021-01-20T13:03:54.173Z",
            "updatedAt" => "2021-01-20T13:03:54.256Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb94e",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb951",
            "name_en" => "Business Bay",
            "name_local" => "الخليج التجاري",
            "published_at" => "2021-01-20T13:03:54.247Z",
            "createdAt" => "2021-01-20T13:03:54.252Z",
            "updatedAt" => "2021-01-20T13:03:54.435Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb951",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb94f",
            "name_en" => "Culture Village",
            "name_local" => "القرية الثقافية",
            "published_at" => "2021-01-20T13:03:54.219Z",
            "createdAt" => "2021-01-20T13:03:54.224Z",
            "updatedAt" => "2021-01-20T13:03:54.332Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb94f",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb952",
            "name_en" => "DIFC",
            "name_local" => "القضائية",
            "published_at" => "2021-01-20T13:03:54.589Z",
            "createdAt" => "2021-01-20T13:03:54.603Z",
            "updatedAt" => "2021-01-20T13:03:54.620Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb952",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3fe4afcdaf7e1cb9a5",
            "name_en" => "Damac Hills",
            "name_local" => "داماك هيلز",
            "published_at" => "2021-01-20T13:03:59.583Z",
            "createdAt" => "2021-01-20T13:03:59.587Z",
            "updatedAt" => "2021-01-20T13:03:59.636Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3fe4afcdaf7e1cb9a5",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb950",
            "name_en" => "Deira",
            "name_local" => "ديرة",
            "published_at" => "2021-01-20T13:03:54.226Z",
            "createdAt" => "2021-01-20T13:03:54.230Z",
            "updatedAt" => "2021-01-20T13:03:54.333Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb950",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb953",
            "name_en" => "Discovery Gardens",
            "name_local" => "ديسكفري جاردنز",
            "published_at" => "2021-01-20T13:03:54.668Z",
            "createdAt" => "2021-01-20T13:03:54.672Z",
            "updatedAt" => "2021-01-20T13:03:54.725Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb953",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb967",
            "name_en" => "DuBiotech",
            "name_local" => "المركز الالكتروني بدبي",
            "published_at" => "2021-01-20T13:03:55.743Z",
            "createdAt" => "2021-01-20T13:03:55.746Z",
            "updatedAt" => "2021-01-20T13:03:55.752Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb967",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb955",
            "name_en" => "Dubai Design District",
            "name_local" => "حي دبي للتصميم",
            "published_at" => "2021-01-20T13:03:54.720Z",
            "createdAt" => "2021-01-20T13:03:54.722Z",
            "updatedAt" => "2021-01-20T13:03:54.750Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb955",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb954",
            "name_en" => "Dubai Downtown Dubai",
            "name_local" => "وسط المدينة",
            "published_at" => "2021-01-20T13:03:54.699Z",
            "createdAt" => "2021-01-20T13:03:54.702Z",
            "updatedAt" => "2021-01-20T13:03:54.741Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb954",
            "stores" => [
                "count" => 2
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb956",
            "name_en" => "Dubai Downtown Jebel Ali",
            "name_local" => "وسط المدينة جبل علي",
            "published_at" => "2021-01-20T13:03:54.731Z",
            "createdAt" => "2021-01-20T13:03:54.733Z",
            "updatedAt" => "2021-01-20T13:03:54.759Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb956",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb957",
            "name_en" => "Dubai Festival City",
            "name_local" => "فيستيفال سيتي",
            "published_at" => "2021-01-20T13:03:54.797Z",
            "createdAt" => "2021-01-20T13:03:54.801Z",
            "updatedAt" => "2021-01-20T13:03:54.808Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb957",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb958",
            "name_en" => "Dubai Healthcare City",
            "name_local" => "مدينة الرعاية الصحية ",
            "published_at" => "2021-01-20T13:03:54.918Z",
            "createdAt" => "2021-01-20T13:03:54.922Z",
            "updatedAt" => "2021-01-20T13:03:54.983Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb958",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb95d",
            "name_en" => "Dubai Land",
            "name_local" => "لاند",
            "published_at" => "2021-01-20T13:03:55.249Z",
            "createdAt" => "2021-01-20T13:03:55.253Z",
            "updatedAt" => "2021-01-20T13:03:55.277Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb95d",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb95e",
            "name_en" => "Dubai Marina",
            "name_local" => "مارينا",
            "published_at" => "2021-01-20T13:03:55.290Z",
            "createdAt" => "2021-01-20T13:03:55.294Z",
            "updatedAt" => "2021-01-20T13:03:55.379Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb95e",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb961",
            "name_en" => "Dubai Pearl",
            "name_local" => "لؤلؤة",
            "published_at" => "2021-01-20T13:03:55.357Z",
            "createdAt" => "2021-01-20T13:03:55.360Z",
            "updatedAt" => "2021-01-20T13:03:55.400Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb961",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb960",
            "name_en" => "Dubai Promenade",
            "name_local" => "الممشى",
            "published_at" => "2021-01-20T13:03:55.351Z",
            "createdAt" => "2021-01-20T13:03:55.355Z",
            "updatedAt" => "2021-01-20T13:03:55.398Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb960",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb962",
            "name_en" => "Dubai Silicon Oasis",
            "name_local" => "واحة السيليكون",
            "published_at" => "2021-01-20T13:03:55.517Z",
            "createdAt" => "2021-01-20T13:03:55.525Z",
            "updatedAt" => "2021-01-20T13:03:55.544Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb962",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb963",
            "name_en" => "Dubai Sports City",
            "name_local" => "مدينة دبي الرياضية",
            "published_at" => "2021-01-20T13:03:55.591Z",
            "createdAt" => "2021-01-20T13:03:55.595Z",
            "updatedAt" => "2021-01-20T13:03:55.668Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb963",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb964",
            "name_en" => "Dubai Studio City",
            "name_local" => "استوديو سيتي",
            "published_at" => "2021-01-20T13:03:55.640Z",
            "createdAt" => "2021-01-20T13:03:55.643Z",
            "updatedAt" => "2021-01-20T13:03:55.688Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb964",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb966",
            "name_en" => "Dubai Waterfront",
            "name_local" => "الواجهة البحرية",
            "published_at" => "2021-01-20T13:03:55.651Z",
            "createdAt" => "2021-01-20T13:03:55.657Z",
            "updatedAt" => "2021-01-20T13:03:55.691Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb966",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb965",
            "name_en" => "Dubai World Central",
            "name_local" => "مركز دبي العالمي",
            "published_at" => "2021-01-20T13:03:55.646Z",
            "createdAt" => "2021-01-20T13:03:55.649Z",
            "updatedAt" => "2021-01-20T13:03:55.690Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb965",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb968",
            "name_en" => "Emirates Golf Club",
            "name_local" => "نادي الإمارات للجولف",
            "published_at" => "2021-01-20T13:03:55.867Z",
            "createdAt" => "2021-01-20T13:03:55.872Z",
            "updatedAt" => "2021-01-20T13:03:55.917Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb968",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb96a",
            "name_en" => "Emirates Hills",
            "name_local" => "تلال الامارات",
            "published_at" => "2021-01-20T13:03:55.938Z",
            "createdAt" => "2021-01-20T13:03:55.942Z",
            "updatedAt" => "2021-01-20T13:03:56.048Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb96a",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb969",
            "name_en" => "Global Village",
            "name_local" => "القرية العالمية",
            "published_at" => "2021-01-20T13:03:55.924Z",
            "createdAt" => "2021-01-20T13:03:55.936Z",
            "updatedAt" => "2021-01-20T13:03:56.046Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb969",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb96b",
            "name_en" => "Green Community",
            "name_local" => "مجتمع الحدائق",
            "published_at" => "2021-01-20T13:03:55.951Z",
            "createdAt" => "2021-01-20T13:03:55.954Z",
            "updatedAt" => "2021-01-20T13:03:56.050Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb96b",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb96c",
            "name_en" => "Greens",
            "name_local" => "جرينز",
            "published_at" => "2021-01-20T13:03:56.019Z",
            "createdAt" => "2021-01-20T13:03:56.026Z",
            "updatedAt" => "2021-01-20T13:03:56.064Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb96c",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb96d",
            "name_en" => "Hatta",
            "name_local" => "حتا",
            "published_at" => "2021-01-20T13:03:56.179Z",
            "createdAt" => "2021-01-20T13:03:56.183Z",
            "updatedAt" => "2021-01-20T13:03:56.191Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb96d",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb959",
            "name_en" => "Hills Estate",
            "name_local" => "هيلز استيت",
            "published_at" => "2021-01-20T13:03:54.950Z",
            "createdAt" => "2021-01-20T13:03:54.954Z",
            "updatedAt" => "2021-01-20T13:03:55.050Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb959",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb96e",
            "name_en" => "IMPZ",
            "name_local" => "مدينة الانتاج الاعلامي",
            "published_at" => "2021-01-20T13:03:56.236Z",
            "createdAt" => "2021-01-20T13:03:56.240Z",
            "updatedAt" => "2021-01-20T13:03:56.344Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb96e",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ae4afcdaf7e1cb95a",
            "name_en" => "Industrial City",
            "name_local" => "الصناعيّة",
            "published_at" => "2021-01-20T13:03:54.975Z",
            "createdAt" => "2021-01-20T13:03:54.978Z",
            "updatedAt" => "2021-01-20T13:03:55.094Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ae4afcdaf7e1cb95a",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb95b",
            "name_en" => "International City",
            "name_local" => "القرية العالمية",
            "published_at" => "2021-01-20T13:03:55.003Z",
            "createdAt" => "2021-01-20T13:03:55.008Z",
            "updatedAt" => "2021-01-20T13:03:55.107Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb95b",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb95c",
            "name_en" => "Investment Park",
            "name_local" => "مجمع دبي للإستثمار",
            "published_at" => "2021-01-20T13:03:55.077Z",
            "createdAt" => "2021-01-20T13:03:55.089Z",
            "updatedAt" => "2021-01-20T13:03:55.120Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb95c",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb96f",
            "name_en" => "Jebel Ali",
            "name_local" => "جبل علي",
            "published_at" => "2021-01-20T13:03:56.298Z",
            "createdAt" => "2021-01-20T13:03:56.307Z",
            "updatedAt" => "2021-01-20T13:03:56.357Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb96f",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb970",
            "name_en" => "Jumeirah",
            "name_local" => "جميرا",
            "published_at" => "2021-01-20T13:03:56.318Z",
            "createdAt" => "2021-01-20T13:03:56.321Z",
            "updatedAt" => "2021-01-20T13:03:56.372Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb970",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb971",
            "name_en" => "Jumeirah Beach Residence",
            "name_local" => "مساكن شاطئ جميرا",
            "published_at" => "2021-01-20T13:03:56.323Z",
            "createdAt" => "2021-01-20T13:03:56.330Z",
            "updatedAt" => "2021-01-20T13:03:56.373Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb971",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb972",
            "name_en" => "Jumeirah Golf Estates",
            "name_local" => "منطقة الجولف الجميرا",
            "published_at" => "2021-01-20T13:03:56.403Z",
            "createdAt" => "2021-01-20T13:03:56.406Z",
            "updatedAt" => "2021-01-20T13:03:56.421Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb972",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb973",
            "name_en" => "Jumeirah Heights",
            "name_local" => "تلال الامارات",
            "published_at" => "2021-01-20T13:03:56.539Z",
            "createdAt" => "2021-01-20T13:03:56.542Z",
            "updatedAt" => "2021-01-20T13:03:56.552Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb973",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb974",
            "name_en" => "Jumeirah Islands",
            "name_local" => "جزر الجميرا",
            "published_at" => "2021-01-20T13:03:56.593Z",
            "createdAt" => "2021-01-20T13:03:56.598Z",
            "updatedAt" => "2021-01-20T13:03:56.688Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb974",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb976",
            "name_en" => "Jumeirah Lake Towers",
            "name_local" => "ابراج بحيرة الجميرا",
            "published_at" => "2021-01-20T13:03:56.633Z",
            "createdAt" => "2021-01-20T13:03:56.637Z",
            "updatedAt" => "2021-01-20T13:03:56.697Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb976",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb975",
            "name_en" => "Jumeirah Park",
            "name_local" => "جميرا بارك",
            "published_at" => "2021-01-20T13:03:56.626Z",
            "createdAt" => "2021-01-20T13:03:56.631Z",
            "updatedAt" => "2021-01-20T13:03:56.696Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb975",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb977",
            "name_en" => "Jumeirah Village Circle",
            "name_local" => "قرية الجميرا سركل",
            "published_at" => "2021-01-20T13:03:56.669Z",
            "createdAt" => "2021-01-20T13:03:56.676Z",
            "updatedAt" => "2021-01-20T13:03:56.711Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb977",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb978",
            "name_en" => "Jumeirah Village Triangle",
            "name_local" => "مثلث قرية الجميرا",
            "published_at" => "2021-01-20T13:03:56.860Z",
            "createdAt" => "2021-01-20T13:03:56.864Z",
            "updatedAt" => "2021-01-20T13:03:56.873Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb978",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb979",
            "name_en" => "Karama",
            "name_local" => "الكرامة",
            "published_at" => "2021-01-20T13:03:56.897Z",
            "createdAt" => "2021-01-20T13:03:56.900Z",
            "updatedAt" => "2021-01-20T13:03:56.976Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb979",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3fe4afcdaf7e1cb9a8",
            "name_en" => "Liwan",
            "name_local" => "ليوان",
            "published_at" => "2021-01-20T13:03:59.724Z",
            "createdAt" => "2021-01-20T13:03:59.731Z",
            "updatedAt" => "2021-01-20T13:03:59.740Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3fe4afcdaf7e1cb9a8",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb97b",
            "name_en" => "Maritime City",
            "name_local" => "المدينة الملاحية",
            "published_at" => "2021-01-20T13:03:56.957Z",
            "createdAt" => "2021-01-20T13:03:56.960Z",
            "updatedAt" => "2021-01-20T13:03:56.992Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb97b",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb97a",
            "name_en" => "Meadows",
            "name_local" => "ميدوز",
            "published_at" => "2021-01-20T13:03:56.951Z",
            "createdAt" => "2021-01-20T13:03:56.955Z",
            "updatedAt" => "2021-01-20T13:03:56.991Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb97a",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3be4afcdaf7e1cb95f",
            "name_en" => "Media City",
            "name_local" => "المدينة الاعلامية",
            "published_at" => "2021-01-20T13:03:55.322Z",
            "createdAt" => "2021-01-20T13:03:55.331Z",
            "updatedAt" => "2021-01-20T13:03:55.390Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3be4afcdaf7e1cb95f",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3ce4afcdaf7e1cb97c",
            "name_en" => "Meydan Avenue",
            "name_local" => "ميدان افينو",
            "published_at" => "2021-01-20T13:03:56.962Z",
            "createdAt" => "2021-01-20T13:03:56.965Z",
            "updatedAt" => "2021-01-20T13:03:56.994Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3ce4afcdaf7e1cb97c",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb97d",
            "name_en" => "Meydan Gated Community",
            "name_local" => "ميدان غايتد كوميونيتي",
            "published_at" => "2021-01-20T13:03:57.060Z",
            "createdAt" => "2021-01-20T13:03:57.064Z",
            "updatedAt" => "2021-01-20T13:03:57.072Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb97d",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb97e",
            "name_en" => "Mina Al Arab",
            "name_local" => "ميناء العرب",
            "published_at" => "2021-01-20T13:03:57.173Z",
            "createdAt" => "2021-01-20T13:03:57.178Z",
            "updatedAt" => "2021-01-20T13:03:57.260Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb97e",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb97f",
            "name_en" => "Mirdif",
            "name_local" => "مردف",
            "published_at" => "2021-01-20T13:03:57.220Z",
            "createdAt" => "2021-01-20T13:03:57.231Z",
            "updatedAt" => "2021-01-20T13:03:57.296Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb97f",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb980",
            "name_en" => "Mohammad Bin Rashid City",
            "name_local" => "مدينة محمد بن راشد",
            "published_at" => "2021-01-20T13:03:57.233Z",
            "createdAt" => "2021-01-20T13:03:57.237Z",
            "updatedAt" => "2021-01-20T13:03:57.297Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb980",
            "stores" => [
                "count" => 0
            ]
        ],
      
        [
            "_id" => "60082a3de4afcdaf7e1cb982",
            "name_en" => "Motor City",
            "name_local" => "مدينة السيارات",
            "published_at" => "2021-01-20T13:03:57.310Z",
            "createdAt" => "2021-01-20T13:03:57.314Z",
            "updatedAt" => "2021-01-20T13:03:57.360Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb982",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3fe4afcdaf7e1cb9a7",
            "name_en" => "Mudon",
            "name_local" => "مدن",
            "published_at" => "2021-01-20T13:03:59.610Z",
            "createdAt" => "2021-01-20T13:03:59.614Z",
            "updatedAt" => "2021-01-20T13:03:59.646Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3fe4afcdaf7e1cb9a7",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb983",
            "name_en" => "Mushrif Park",
            "name_local" => "حديقة المشرف",
            "published_at" => "2021-01-20T13:03:57.478Z",
            "createdAt" => "2021-01-20T13:03:57.482Z",
            "updatedAt" => "2021-01-20T13:03:57.520Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb983",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb984",
            "name_en" => "Nadd Al Hammar",
            "name_local" => "ند الحمر",
            "published_at" => "2021-01-20T13:03:57.526Z",
            "createdAt" => "2021-01-20T13:03:57.530Z",
            "updatedAt" => "2021-01-20T13:03:57.624Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb984",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb985",
            "name_en" => "Nadd Al Sheba",
            "name_local" => "ند الشبا",
            "published_at" => "2021-01-20T13:03:57.532Z",
            "createdAt" => "2021-01-20T13:03:57.536Z",
            "updatedAt" => "2021-01-20T13:03:57.626Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb985",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb987",
            "name_en" => "Old Town",
            "name_local" => "المدينة القديمة",
            "published_at" => "2021-01-20T13:03:57.586Z",
            "createdAt" => "2021-01-20T13:03:57.604Z",
            "updatedAt" => "2021-01-20T13:03:57.646Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb987",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb986",
            "name_en" => "Oud Al Muteena",
            "name_local" => "عود المطينة",
            "published_at" => "2021-01-20T13:03:57.580Z",
            "createdAt" => "2021-01-20T13:03:57.584Z",
            "updatedAt" => "2021-01-20T13:03:57.644Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb986",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb988",
            "name_en" => "Palm Jebel Ali",
            "name_local" => "نخلة جبل علي",
            "published_at" => "2021-01-20T13:03:57.759Z",
            "createdAt" => "2021-01-20T13:03:57.762Z",
            "updatedAt" => "2021-01-20T13:03:57.769Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb988",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb989",
            "name_en" => "Palm jumeirah",
            "name_local" => "نخلة الجميرا",
            "published_at" => "2021-01-20T13:03:57.814Z",
            "createdAt" => "2021-01-20T13:03:57.821Z",
            "updatedAt" => "2021-01-20T13:03:57.880Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb989",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a40e4afcdaf7e1cb9ab",
            "name_en" => "Port Rashid",
            "name_local" => "ميناء راشد",
            "published_at" => "2021-01-20T13:04:00.099Z",
            "createdAt" => "2021-01-20T13:04:00.102Z",
            "updatedAt" => "2021-01-20T13:04:00.147Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a40e4afcdaf7e1cb9ab",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb98a",
            "name_en" => "Ras Al Khor",
            "name_local" => "رأس الخور",
            "published_at" => "2021-01-20T13:03:57.845Z",
            "createdAt" => "2021-01-20T13:03:57.849Z",
            "updatedAt" => "2021-01-20T13:03:57.935Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb98a",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a3de4afcdaf7e1cb98b",
            "name_en" => "Reem",
            "name_local" => "ريم",
            "published_at" => "2021-01-20T13:03:57.887Z",
            "createdAt" => "2021-01-20T13:03:57.891Z",
            "updatedAt" => "2021-01-20T13:03:57.969Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a3de4afcdaf7e1cb98b",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a40e4afcdaf7e1cb9ad",
            "name_en" => "Remram",
            "name_local" => "رامرام",
            "published_at" => "2021-01-20T13:04:00.107Z",
            "createdAt" => "2021-01-20T13:04:00.109Z",
            "updatedAt" => "2021-01-20T13:04:00.149Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a40e4afcdaf7e1cb9ad",
            "stores" => [
                "count" => 0
            ]
        ],
        [
            "_id" => "60082a40e4afcdaf7e1cb9ac",
            "name_en" => "Residence Complex",
            "name_local" => "مجمع دبي السكني",
            "published_at" => "2021-01-20T13:04:00.103Z",
            "createdAt" => "2021-01-20T13:04:00.105Z",
            "updatedAt" => "2021-01-20T13:04:00.148Z",
            "__v" => 0,
            "city" => [
                "_id" => "600816ae731d75ae35f558b9",
                "name_en" => "Dubai",
                "name_local" => "دبي",
                "published_at" => "2021-01-20T11:40:30.583Z",
                "createdAt" => "2021-01-20T11:40:30.603Z",
                "updatedAt" => "2021-01-20T11:52:46.602Z",
                "__v" => 0,
                "country" => "600814ac731d75ae35f558b3",
                "updated_by" => "600454b4eb44d770c0928cf3",
                "id" => "600816ae731d75ae35f558b9"
            ],
            "id" => "60082a40e4afcdaf7e1cb9ac",
            "stores" => [
                "count" => 0
            ]
            ],
    
            [
                "_id" => "60082a40e4afcdaf7e1cb9aa",
                "name_en" => "Sceince Park",
                "name_local" => "مجمع دبي للعلوم",
                "published_at" => "2021-01-20T13:04:00.095Z",
                "createdAt" => "2021-01-20T13:04:00.098Z",
                "updatedAt" => "2021-01-20T13:04:00.146Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a40e4afcdaf7e1cb9aa",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3fe4afcdaf7e1cb9a9",
                "name_en" => "Serena",
                "name_local" => "سيرينا",
                "published_at" => "2021-01-20T13:03:59.959Z",
                "createdAt" => "2021-01-20T13:03:59.963Z",
                "updatedAt" => "2021-01-20T13:04:00.086Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3fe4afcdaf7e1cb9a9",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3de4afcdaf7e1cb98c",
                "name_en" => "Sheikh Zayed Road",
                "name_local" => "شارع الشيخ زايد",
                "published_at" => "2021-01-20T13:03:57.893Z",
                "createdAt" => "2021-01-20T13:03:57.908Z",
                "updatedAt" => "2021-01-20T13:03:57.970Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3de4afcdaf7e1cb98c",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3fe4afcdaf7e1cb9a4",
                "name_en" => "South Dubai",
                "name_local" => "دبي جنوب",
                "published_at" => "2021-01-20T13:03:59.544Z",
                "createdAt" => "2021-01-20T13:03:59.548Z",
                "updatedAt" => "2021-01-20T13:03:59.626Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3fe4afcdaf7e1cb9a4",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb98e",
                "name_en" => "TECOM",
                "name_local" => "تيكوم",
                "published_at" => "2021-01-20T13:03:58.122Z",
                "createdAt" => "2021-01-20T13:03:58.126Z",
                "updatedAt" => "2021-01-20T13:03:58.136Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb98e",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3de4afcdaf7e1cb98d",
                "name_en" => "Technology Park",
                "name_local" => "واحة التكنولوجيا",
                "published_at" => "2021-01-20T13:03:57.993Z",
                "createdAt" => "2021-01-20T13:03:57.996Z",
                "updatedAt" => "2021-01-20T13:03:58.026Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3de4afcdaf7e1cb98d",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb98f",
                "name_en" => "The Gardens",
                "name_local" => "الحدائق",
                "published_at" => "2021-01-20T13:03:58.155Z",
                "createdAt" => "2021-01-20T13:03:58.159Z",
                "updatedAt" => "2021-01-20T13:03:58.199Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb98f",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb991",
                "name_en" => "The Hills",
                "name_local" => "مشروع التلال",
                "published_at" => "2021-01-20T13:03:58.219Z",
                "createdAt" => "2021-01-20T13:03:58.222Z",
                "updatedAt" => "2021-01-20T13:03:58.262Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb991",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb990",
                "name_en" => "The Lagoons",
                "name_local" => "ذا لاجونز",
                "published_at" => "2021-01-20T13:03:58.214Z",
                "createdAt" => "2021-01-20T13:03:58.217Z",
                "updatedAt" => "2021-01-20T13:03:58.260Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb990",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb992",
                "name_en" => "The Lakes",
                "name_local" => "البحيرات",
                "published_at" => "2021-01-20T13:03:58.234Z",
                "createdAt" => "2021-01-20T13:03:58.237Z",
                "updatedAt" => "2021-01-20T13:03:58.271Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb992",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb993",
                "name_en" => "The Meadows",
                "name_local" => "المروج",
                "published_at" => "2021-01-20T13:03:58.327Z",
                "createdAt" => "2021-01-20T13:03:58.337Z",
                "updatedAt" => "2021-01-20T13:03:58.359Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb993",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb994",
                "name_en" => "The Palm Deira",
                "name_local" => "جزيرة النخلة ديرة",
                "published_at" => "2021-01-20T13:03:58.562Z",
                "createdAt" => "2021-01-20T13:03:58.578Z",
                "updatedAt" => "2021-01-20T13:03:58.683Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb994",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb996",
                "name_en" => "The Springs",
                "name_local" => "الينابيع",
                "published_at" => "2021-01-20T13:03:58.662Z",
                "createdAt" => "2021-01-20T13:03:58.664Z",
                "updatedAt" => "2021-01-20T13:03:58.696Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb996",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb995",
                "name_en" => "The Views",
                "name_local" => "ذا فيوز",
                "published_at" => "2021-01-20T13:03:58.658Z",
                "createdAt" => "2021-01-20T13:03:58.661Z",
                "updatedAt" => "2021-01-20T13:03:58.695Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb995",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb997",
                "name_en" => "The World Islands",
                "name_local" => "جزر العالم",
                "published_at" => "2021-01-20T13:03:58.666Z",
                "createdAt" => "2021-01-20T13:03:58.668Z",
                "updatedAt" => "2021-01-20T13:03:58.697Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb997",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb998",
                "name_en" => "Umm Al Sheif",
                "name_local" => "ام الشيف",
                "published_at" => "2021-01-20T13:03:58.679Z",
                "createdAt" => "2021-01-20T13:03:58.681Z",
                "updatedAt" => "2021-01-20T13:03:58.706Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb998",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb999",
                "name_en" => "Umm Hurair",
                "name_local" => "ام الحرير",
                "published_at" => "2021-01-20T13:03:58.865Z",
                "createdAt" => "2021-01-20T13:03:58.869Z",
                "updatedAt" => "2021-01-20T13:03:58.908Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb999",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3fe4afcdaf7e1cb99d",
                "name_en" => "Umm Ramool",
                "name_local" => "ام الرمول",
                "published_at" => "2021-01-20T13:03:58.994Z",
                "createdAt" => "2021-01-20T13:03:59.016Z",
                "updatedAt" => "2021-01-20T13:03:59.066Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3fe4afcdaf7e1cb99d",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb99a",
                "name_en" => "Umm Suqeim",
                "name_local" => "ام سقيم",
                "published_at" => "2021-01-20T13:03:58.917Z",
                "createdAt" => "2021-01-20T13:03:58.920Z",
                "updatedAt" => "2021-01-20T13:03:59.042Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb99a",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb99c",
                "name_en" => "Victory Heights",
                "name_local" => "فيكتوري هايتس",
                "published_at" => "2021-01-20T13:03:58.979Z",
                "createdAt" => "2021-01-20T13:03:58.983Z",
                "updatedAt" => "2021-01-20T13:03:59.064Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb99c",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3ee4afcdaf7e1cb99b",
                "name_en" => "Wadi Al Amardi",
                "name_local" => "وادي الاماردي",
                "published_at" => "2021-01-20T13:03:58.922Z",
                "createdAt" => "2021-01-20T13:03:58.925Z",
                "updatedAt" => "2021-01-20T13:03:59.044Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3ee4afcdaf7e1cb99b",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3fe4afcdaf7e1cb99e",
                "name_en" => "World Trade Center",
                "name_local" => "المركز المالي العالمي",
                "published_at" => "2021-01-20T13:03:59.188Z",
                "createdAt" => "2021-01-20T13:03:59.193Z",
                "updatedAt" => "2021-01-20T13:03:59.226Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3fe4afcdaf7e1cb99e",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3fe4afcdaf7e1cb9a0",
                "name_en" => "Zabeel",
                "name_local" => "زعبيل",
                "published_at" => "2021-01-20T13:03:59.295Z",
                "createdAt" => "2021-01-20T13:03:59.298Z",
                "updatedAt" => "2021-01-20T13:03:59.342Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3fe4afcdaf7e1cb9a0",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a3fe4afcdaf7e1cb99f",
                "name_en" => "Zulal",
                "name_local" => "زلال",
                "published_at" => "2021-01-20T13:03:59.290Z",
                "createdAt" => "2021-01-20T13:03:59.293Z",
                "updatedAt" => "2021-01-20T13:03:59.341Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "60082a3fe4afcdaf7e1cb99f",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600c0156e4afcdaf7e1cba3e",
                "name_en" => "jmc",
                "name_local" => "جميرة",
                "published_at" => "2021-01-23T10:58:30.328Z",
                "createdAt" => "2021-01-23T10:58:30.349Z",
                "updatedAt" => "2021-01-23T10:58:30.375Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600816ae731d75ae35f558b9",
                    "name_en" => "Dubai",
                    "name_local" => "دبي",
                    "published_at" => "2021-01-20T11:40:30.583Z",
                    "createdAt" => "2021-01-20T11:40:30.603Z",
                    "updatedAt" => "2021-01-20T11:52:46.602Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600816ae731d75ae35f558b9"
                ],
                "id" => "600c0156e4afcdaf7e1cba3e",
                "stores" => [
                    "count" => 0
                ]
            ]
        ];

        $ainAreas = [
            [
                "_id" => "60082a8ee4afcdaf7e1cb9b0",
                "name_en" => "Al Ain Industrial Area",
                "name_local" => "العين الصناعية",
                "published_at" => "2021-01-20T13:05:18.487Z",
                "createdAt" => "2021-01-20T13:05:18.498Z",
                "updatedAt" => "2021-01-20T13:05:18.564Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8ee4afcdaf7e1cb9b0",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8ee4afcdaf7e1cb9b2",
                "name_en" => "Al Faqa'a",
                "name_local" => "الفقع",
                "published_at" => "2021-01-20T13:05:18.529Z",
                "createdAt" => "2021-01-20T13:05:18.532Z",
                "updatedAt" => "2021-01-20T13:05:18.575Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8ee4afcdaf7e1cb9b2",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8ee4afcdaf7e1cb9af",
                "name_en" => "Al Grayyeh",
                "name_local" => "القرية",
                "published_at" => "2021-01-20T13:05:18.447Z",
                "createdAt" => "2021-01-20T13:05:18.451Z",
                "updatedAt" => "2021-01-20T13:05:18.540Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8ee4afcdaf7e1cb9af",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8ee4afcdaf7e1cb9b3",
                "name_en" => "Al Hili",
                "name_local" => "الهيلي",
                "published_at" => "2021-01-20T13:05:18.550Z",
                "createdAt" => "2021-01-20T13:05:18.553Z",
                "updatedAt" => "2021-01-20T13:05:18.587Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8ee4afcdaf7e1cb9b3",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8ee4afcdaf7e1cb9b1",
                "name_en" => "Al Jaheli",
                "name_local" => "الجهلي",
                "published_at" => "2021-01-20T13:05:18.523Z",
                "createdAt" => "2021-01-20T13:05:18.527Z",
                "updatedAt" => "2021-01-20T13:05:18.574Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8ee4afcdaf7e1cb9b1",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8ee4afcdaf7e1cb9b5",
                "name_en" => "Al Jimi",
                "name_local" => "الجيمي",
                "published_at" => "2021-01-20T13:05:18.768Z",
                "createdAt" => "2021-01-20T13:05:18.772Z",
                "updatedAt" => "2021-01-20T13:05:18.855Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8ee4afcdaf7e1cb9b5",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8ee4afcdaf7e1cb9b4",
                "name_en" => "Al Khabisi",
                "name_local" => "الخبيصي",
                "published_at" => "2021-01-20T13:05:18.756Z",
                "createdAt" => "2021-01-20T13:05:18.760Z",
                "updatedAt" => "2021-01-20T13:05:18.848Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8ee4afcdaf7e1cb9b4",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8ee4afcdaf7e1cb9b6",
                "name_en" => "Al Manaseer",
                "name_local" => "المناصير",
                "published_at" => "2021-01-20T13:05:18.879Z",
                "createdAt" => "2021-01-20T13:05:18.888Z",
                "updatedAt" => "2021-01-20T13:05:18.955Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8ee4afcdaf7e1cb9b6",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8ee4afcdaf7e1cb9b7",
                "name_en" => "Al Maqam",
                "name_local" => "المقام",
                "published_at" => "2021-01-20T13:05:18.895Z",
                "createdAt" => "2021-01-20T13:05:18.899Z",
                "updatedAt" => "2021-01-20T13:05:18.956Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8ee4afcdaf7e1cb9b7",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8ee4afcdaf7e1cb9b8",
                "name_en" => "Al Markhaniya",
                "name_local" => "المرخانية",
                "published_at" => "2021-01-20T13:05:18.921Z",
                "createdAt" => "2021-01-20T13:05:18.926Z",
                "updatedAt" => "2021-01-20T13:05:18.961Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8ee4afcdaf7e1cb9b8",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9b9",
                "name_en" => "Al Murabaa",
                "name_local" => "المرابعة",
                "published_at" => "2021-01-20T13:05:19.112Z",
                "createdAt" => "2021-01-20T13:05:19.116Z",
                "updatedAt" => "2021-01-20T13:05:19.192Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9b9",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9ba",
                "name_en" => "Al Mutarad",
                "name_local" => "المطارد",
                "published_at" => "2021-01-20T13:05:19.119Z",
                "createdAt" => "2021-01-20T13:05:19.125Z",
                "updatedAt" => "2021-01-20T13:05:19.194Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9ba",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9bb",
                "name_en" => "Al Mutawaa",
                "name_local" => "المطوعة",
                "published_at" => "2021-01-20T13:05:19.178Z",
                "createdAt" => "2021-01-20T13:05:19.185Z",
                "updatedAt" => "2021-01-20T13:05:19.242Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9bb",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9bc",
                "name_en" => "Al Muwahie",
                "name_local" => "المواهي",
                "published_at" => "2021-01-20T13:05:19.204Z",
                "createdAt" => "2021-01-20T13:05:19.211Z",
                "updatedAt" => "2021-01-20T13:05:19.264Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9bc",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9bd",
                "name_en" => "Al Muwaiji",
                "name_local" => "المويجي",
                "published_at" => "2021-01-20T13:05:19.213Z",
                "createdAt" => "2021-01-20T13:05:19.216Z",
                "updatedAt" => "2021-01-20T13:05:19.265Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9bd",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9be",
                "name_en" => "Al Neyadat",
                "name_local" => "النيادات",
                "published_at" => "2021-01-20T13:05:19.390Z",
                "createdAt" => "2021-01-20T13:05:19.395Z",
                "updatedAt" => "2021-01-20T13:05:19.414Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9be",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9bf",
                "name_en" => "Al Oyoun Village",
                "name_local" => "قرية العيون",
                "published_at" => "2021-01-20T13:05:19.419Z",
                "createdAt" => "2021-01-20T13:05:19.425Z",
                "updatedAt" => "2021-01-20T13:05:19.459Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9bf",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9c0",
                "name_en" => "Al Sinaiya",
                "name_local" => "السنية",
                "published_at" => "2021-01-20T13:05:19.468Z",
                "createdAt" => "2021-01-20T13:05:19.472Z",
                "updatedAt" => "2021-01-20T13:05:19.560Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9c0",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9c1",
                "name_en" => "Tawam",
                "name_local" => "توام",
                "published_at" => "2021-01-20T13:05:19.524Z",
                "createdAt" => "2021-01-20T13:05:19.532Z",
                "updatedAt" => "2021-01-20T13:05:19.572Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9c1",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9c2",
                "name_en" => "Wahat Al Zaweya",
                "name_local" => "واحة الزاوية",
                "published_at" => "2021-01-20T13:05:19.552Z",
                "createdAt" => "2021-01-20T13:05:19.558Z",
                "updatedAt" => "2021-01-20T13:05:19.579Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9c2",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a8fe4afcdaf7e1cb9c3",
                "name_en" => "Zakher",
                "name_local" => "زاخر",
                "published_at" => "2021-01-20T13:05:19.614Z",
                "createdAt" => "2021-01-20T13:05:19.618Z",
                "updatedAt" => "2021-01-20T13:05:19.624Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008179c731d75ae35f558bb",
                    "name_en" => "Al Ain",
                    "name_local" => "العين",
                    "published_at" => "2021-01-20T11:44:30.620Z",
                    "createdAt" => "2021-01-20T11:44:28.264Z",
                    "updatedAt" => "2021-01-20T11:53:18.993Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008179c731d75ae35f558bb"
                ],
                "id" => "60082a8fe4afcdaf7e1cb9c3",
                "stores" => [
                    "count" => 0
                ]
            ]
        ];

    
        $rakAreas =   [
            [
                "_id" => "600829abe4afcdaf7e1cb910",
                "name_en" => "Al Dhait",
                "name_local" => "الظيت",
                "published_at" => "2021-01-20T13:01:31.921Z",
                "createdAt" => "2021-01-20T13:01:31.927Z",
                "updatedAt" => "2021-01-20T13:01:32.007Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829abe4afcdaf7e1cb910",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829abe4afcdaf7e1cb913",
                "name_en" => "Al Ghubb",
                "name_local" => "الغب",
                "published_at" => "2021-01-20T13:01:31.946Z",
                "createdAt" => "2021-01-20T13:01:31.949Z",
                "updatedAt" => "2021-01-20T13:01:32.012Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829abe4afcdaf7e1cb913",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829abe4afcdaf7e1cb914",
                "name_en" => "Al Huamra",
                "name_local" => "الحمرا",
                "published_at" => "2021-01-20T13:01:31.983Z",
                "createdAt" => "2021-01-20T13:01:31.987Z",
                "updatedAt" => "2021-01-20T13:01:32.031Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829abe4afcdaf7e1cb914",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829abe4afcdaf7e1cb911",
                "name_en" => "Al Huamra Village",
                "name_local" => "قرية الحمرا",
                "published_at" => "2021-01-20T13:01:31.930Z",
                "createdAt" => "2021-01-20T13:01:31.937Z",
                "updatedAt" => "2021-01-20T13:01:32.009Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829abe4afcdaf7e1cb911",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829abe4afcdaf7e1cb912",
                "name_en" => "Al Juwais",
                "name_local" => "الجويس",
                "published_at" => "2021-01-20T13:01:31.940Z",
                "createdAt" => "2021-01-20T13:01:31.944Z",
                "updatedAt" => "2021-01-20T13:01:32.011Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829abe4afcdaf7e1cb912",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb915",
                "name_en" => "Al Mamourah",
                "name_local" => "المعمورة",
                "published_at" => "2021-01-20T13:01:32.222Z",
                "createdAt" => "2021-01-20T13:01:32.236Z",
                "updatedAt" => "2021-01-20T13:01:32.378Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb915",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb916",
                "name_en" => "Al Marjan Island",
                "name_local" => "جزيرة المرجان",
                "published_at" => "2021-01-20T13:01:32.298Z",
                "createdAt" => "2021-01-20T13:01:32.303Z",
                "updatedAt" => "2021-01-20T13:01:32.433Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb916",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb917",
                "name_en" => "Al Nakheel",
                "name_local" => "النخيل",
                "published_at" => "2021-01-20T13:01:32.363Z",
                "createdAt" => "2021-01-20T13:01:32.368Z",
                "updatedAt" => "2021-01-20T13:01:32.450Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb917",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb918",
                "name_en" => "Al Qusaidat",
                "name_local" => "القصيدات",
                "published_at" => "2021-01-20T13:01:32.393Z",
                "createdAt" => "2021-01-20T13:01:32.400Z",
                "updatedAt" => "2021-01-20T13:01:32.465Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb918",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb919",
                "name_en" => "Al Uraibi",
                "name_local" => "العريبي",
                "published_at" => "2021-01-20T13:01:32.403Z",
                "createdAt" => "2021-01-20T13:01:32.409Z",
                "updatedAt" => "2021-01-20T13:01:32.466Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb919",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb91a",
                "name_en" => "Al kornish",
                "name_local" => "كورنيش راس الخيمة",
                "published_at" => "2021-01-20T13:01:32.632Z",
                "createdAt" => "2021-01-20T13:01:32.637Z",
                "updatedAt" => "2021-01-20T13:01:32.665Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb91a",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ade4afcdaf7e1cb921",
                "name_en" => "Creek",
                "name_local" => "خليج راس الخيمة",
                "published_at" => "2021-01-20T13:01:33.056Z",
                "createdAt" => "2021-01-20T13:01:33.059Z",
                "updatedAt" => "2021-01-20T13:01:33.108Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ade4afcdaf7e1cb921",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb91b",
                "name_en" => "Dana Island",
                "name_local" => "جزيرة الدانة",
                "published_at" => "2021-01-20T13:01:32.672Z",
                "createdAt" => "2021-01-20T13:01:32.676Z",
                "updatedAt" => "2021-01-20T13:01:32.836Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb91b",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ade4afcdaf7e1cb922",
                "name_en" => "Gateway",
                "name_local" => "راس الخيمة جيتواي",
                "published_at" => "2021-01-20T13:01:33.096Z",
                "createdAt" => "2021-01-20T13:01:33.102Z",
                "updatedAt" => "2021-01-20T13:01:33.145Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ade4afcdaf7e1cb922",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb91c",
                "name_en" => "Julfa",
                "name_local" => "جلفار",
                "published_at" => "2021-01-20T13:01:32.768Z",
                "createdAt" => "2021-01-20T13:01:32.780Z",
                "updatedAt" => "2021-01-20T13:01:32.850Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb91c",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb91d",
                "name_en" => "Khuzam",
                "name_local" => "خزام",
                "published_at" => "2021-01-20T13:01:32.783Z",
                "createdAt" => "2021-01-20T13:01:32.789Z",
                "updatedAt" => "2021-01-20T13:01:32.852Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb91d",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb91e",
                "name_en" => "Mina Al Arab",
                "name_local" => "ميناء العرب راس الخيمة",
                "published_at" => "2021-01-20T13:01:32.828Z",
                "createdAt" => "2021-01-20T13:01:32.831Z",
                "updatedAt" => "2021-01-20T13:01:32.865Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb91e",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ace4afcdaf7e1cb91f",
                "name_en" => "PAK FTZ",
                "name_local" => "المنطقة التجارية الحرة",
                "published_at" => "2021-01-20T13:01:32.954Z",
                "createdAt" => "2021-01-20T13:01:32.957Z",
                "updatedAt" => "2021-01-20T13:01:32.972Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ace4afcdaf7e1cb91f",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ade4afcdaf7e1cb920",
                "name_en" => "PAK Industrial And Technology Park",
                "name_local" => "واحة التكنولوجيا",
                "published_at" => "2021-01-20T13:01:33.026Z",
                "createdAt" => "2021-01-20T13:01:33.031Z",
                "updatedAt" => "2021-01-20T13:01:33.039Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ade4afcdaf7e1cb920",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ade4afcdaf7e1cb924",
                "name_en" => "Saraya Islands",
                "name_local" => "جزر سرايا",
                "published_at" => "2021-01-20T13:01:33.181Z",
                "createdAt" => "2021-01-20T13:01:33.184Z",
                "updatedAt" => "2021-01-20T13:01:33.201Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ade4afcdaf7e1cb924",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ade4afcdaf7e1cb925",
                "name_en" => "Sheikh Mohammad Bin Zayed Road",
                "name_local" => "شارع الشيخ محمد بن زايد",
                "published_at" => "2021-01-20T13:01:33.346Z",
                "createdAt" => "2021-01-20T13:01:33.351Z",
                "updatedAt" => "2021-01-20T13:01:33.413Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ade4afcdaf7e1cb925",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ade4afcdaf7e1cb926",
                "name_en" => "Sidroh",
                "name_local" => "سدورة",
                "published_at" => "2021-01-20T13:01:33.393Z",
                "createdAt" => "2021-01-20T13:01:33.398Z",
                "updatedAt" => "2021-01-20T13:01:33.426Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ade4afcdaf7e1cb926",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ade4afcdaf7e1cb923",
                "name_en" => "Waterfront",
                "name_local" => "الواجهة المائية",
                "published_at" => "2021-01-20T13:01:33.104Z",
                "createdAt" => "2021-01-20T13:01:33.106Z",
                "updatedAt" => "2021-01-20T13:01:33.146Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ade4afcdaf7e1cb923",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ade4afcdaf7e1cb927",
                "name_en" => "Yasmin Village",
                "name_local" => "قرية الياسمين",
                "published_at" => "2021-01-20T13:01:33.400Z",
                "createdAt" => "2021-01-20T13:01:33.404Z",
                "updatedAt" => "2021-01-20T13:01:33.427Z",
                "__v" => 0,
                "city" => [
                    "_id" => "6008180d731d75ae35f558bd",
                    "name_en" => "Ras Al Khaimah",
                    "name_local" => "راس الخيمة",
                    "published_at" => "2021-01-20T11:46:23.579Z",
                    "createdAt" => "2021-01-20T11:46:21.461Z",
                    "updatedAt" => "2021-01-20T11:53:25.294Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "6008180d731d75ae35f558bd"
                ],
                "id" => "600829ade4afcdaf7e1cb927",
                "stores" => [
                    "count" => 0
                ]
            ]
        ];
 
        $uaqAreas =  [
            [
                "_id" => "60082119e4afcdaf7e1cb8ae",
                "name_en" => "Al Aahad",
                "name_local" => "الآحاد",
                "published_at" => "2021-01-20T12:24:57.241Z",
                "createdAt" => "2021-01-20T12:24:57.245Z",
                "updatedAt" => "2021-03-13T06:58:01.104Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "stores" => [
                    "count" => 0
                ],
                "id" => "60082119e4afcdaf7e1cb8ae"
            ],
            [
                "_id" => "60082119e4afcdaf7e1cb8ac",
                "name_en" => "Al Dar Al Baidaa",
                "name_local" => "الدار البيضاء",
                "published_at" => "2021-01-20T12:24:57.149Z",
                "createdAt" => "2021-01-20T12:24:57.155Z",
                "updatedAt" => "2021-01-20T12:24:57.329Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "60082119e4afcdaf7e1cb8ac",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082119e4afcdaf7e1cb8af",
                "name_en" => "Al Haditha",
                "name_local" => "الحديثة",
                "published_at" => "2021-01-20T12:24:57.247Z",
                "createdAt" => "2021-01-20T12:24:57.251Z",
                "updatedAt" => "2021-01-20T12:24:57.448Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "60082119e4afcdaf7e1cb8af",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082119e4afcdaf7e1cb8b0",
                "name_en" => "Al Humra",
                "name_local" => "الحمرة",
                "published_at" => "2021-01-20T12:24:57.257Z",
                "createdAt" => "2021-01-20T12:24:57.261Z",
                "updatedAt" => "2021-01-20T12:24:57.449Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "60082119e4afcdaf7e1cb8b0",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082119e4afcdaf7e1cb8ad",
                "name_en" => "Al Kaber",
                "name_local" => "منطقة الكابر",
                "published_at" => "2021-01-20T12:24:57.158Z",
                "createdAt" => "2021-01-20T12:24:57.166Z",
                "updatedAt" => "2021-03-13T07:16:03.384Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "stores" => [
                    "count" => 1
                ],
                "id" => "60082119e4afcdaf7e1cb8ad"
            ],
            [
                "_id" => "60082119e4afcdaf7e1cb8b1",
                "name_en" => "Al Khor",
                "name_local" => "الخور",
                "published_at" => "2021-01-20T12:24:57.769Z",
                "createdAt" => "2021-01-20T12:24:57.776Z",
                "updatedAt" => "2021-01-20T12:24:57.894Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "60082119e4afcdaf7e1cb8b1",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082119e4afcdaf7e1cb8b5",
                "name_en" => "Al Maidan",
                "name_local" => "الميدان",
                "published_at" => "2021-01-20T12:24:57.883Z",
                "createdAt" => "2021-01-20T12:24:57.887Z",
                "updatedAt" => "2021-01-20T12:24:57.928Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "60082119e4afcdaf7e1cb8b5",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082119e4afcdaf7e1cb8b2",
                "name_en" => "Al Raas",
                "name_local" => "الراس",
                "published_at" => "2021-01-20T12:24:57.855Z",
                "createdAt" => "2021-01-20T12:24:57.864Z",
                "updatedAt" => "2021-01-20T12:24:57.923Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "60082119e4afcdaf7e1cb8b2",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082119e4afcdaf7e1cb8b3",
                "name_en" => "Al Ramla",
                "name_local" => "الرملة",
                "published_at" => "2021-01-20T12:24:57.867Z",
                "createdAt" => "2021-01-20T12:24:57.871Z",
                "updatedAt" => "2021-01-20T12:24:57.925Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "60082119e4afcdaf7e1cb8b3",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082119e4afcdaf7e1cb8b4",
                "name_en" => "Al Raudah",
                "name_local" => "الروضة",
                "published_at" => "2021-01-20T12:24:57.874Z",
                "createdAt" => "2021-01-20T12:24:57.878Z",
                "updatedAt" => "2021-01-20T12:24:57.926Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "60082119e4afcdaf7e1cb8b4",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "6008211ae4afcdaf7e1cb8b6",
                "name_en" => "Al Riqqa",
                "name_local" => "الرقة",
                "published_at" => "2021-01-20T12:24:58.091Z",
                "createdAt" => "2021-01-20T12:24:58.095Z",
                "updatedAt" => "2021-01-20T12:24:58.116Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "6008211ae4afcdaf7e1cb8b6",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "6008211ae4afcdaf7e1cb8b7",
                "name_en" => "Al Salam City",
                "name_local" => "مدينة السلام",
                "published_at" => "2021-01-20T12:24:58.134Z",
                "createdAt" => "2021-01-20T12:24:58.138Z",
                "updatedAt" => "2021-01-20T12:24:58.227Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "6008211ae4afcdaf7e1cb8b7",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "6008211ae4afcdaf7e1cb8b8",
                "name_en" => "Al Salamah",
                "name_local" => "ضاحية السلام",
                "published_at" => "2021-01-20T12:24:58.170Z",
                "createdAt" => "2021-01-20T12:24:58.173Z",
                "updatedAt" => "2021-01-20T12:24:58.240Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "6008211ae4afcdaf7e1cb8b8",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "6008211ae4afcdaf7e1cb8b9",
                "name_en" => "Al Surra",
                "name_local" => "السرة",
                "published_at" => "2021-01-20T12:24:58.175Z",
                "createdAt" => "2021-01-20T12:24:58.179Z",
                "updatedAt" => "2021-01-20T12:24:58.242Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "6008211ae4afcdaf7e1cb8b9",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "6008211ae4afcdaf7e1cb8bc",
                "name_en" => "Beidah",
                "name_local" => "خور البيضاء",
                "published_at" => "2021-01-20T12:24:58.474Z",
                "createdAt" => "2021-01-20T12:24:58.478Z",
                "updatedAt" => "2021-01-20T12:24:58.547Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "6008211ae4afcdaf7e1cb8bc",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "6008211ae4afcdaf7e1cb8ba",
                "name_en" => "Emirates Modern Industrial",
                "name_local" => "منطقة الامارات الصناعية الحديثة",
                "published_at" => "2021-01-20T12:24:58.201Z",
                "createdAt" => "2021-01-20T12:24:58.206Z",
                "updatedAt" => "2021-01-20T12:24:58.253Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "6008211ae4afcdaf7e1cb8ba",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "6008211ae4afcdaf7e1cb8be",
                "name_en" => "Marina",
                "name_local" => "مارينا ام القوين",
                "published_at" => "2021-01-20T12:24:58.527Z",
                "createdAt" => "2021-01-20T12:24:58.529Z",
                "updatedAt" => "2021-01-20T12:24:58.567Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "6008211ae4afcdaf7e1cb8be",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "6008211ae4afcdaf7e1cb8bb",
                "name_en" => "Moalla",
                "name_local" => "فلج المعلا",
                "published_at" => "2021-01-20T12:24:58.367Z",
                "createdAt" => "2021-01-20T12:24:58.371Z",
                "updatedAt" => "2021-01-20T12:24:58.385Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "6008211ae4afcdaf7e1cb8bb",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "6008211ae4afcdaf7e1cb8bd",
                "name_en" => "Old Induustrial Area",
                "name_local" => "المنطقة الصناعية القديمة",
                "published_at" => "2021-01-20T12:24:58.502Z",
                "createdAt" => "2021-01-20T12:24:58.506Z",
                "updatedAt" => "2021-01-20T12:24:58.560Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "6008211ae4afcdaf7e1cb8bd",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "6008211ae4afcdaf7e1cb8bf",
                "name_en" => "White Bay",
                "name_local" => "الخليج الابيض",
                "published_at" => "2021-01-20T12:24:58.543Z",
                "createdAt" => "2021-01-20T12:24:58.546Z",
                "updatedAt" => "2021-01-20T12:24:58.576Z",
                "__v" => 0,
                "city" => [
                    "_id" => "60081837731d75ae35f558be",
                    "name_en" => "Um Al Quwain",
                    "name_local" => "ام القوين",
                    "published_at" => "2021-01-20T11:47:06.150Z",
                    "createdAt" => "2021-01-20T11:47:03.864Z",
                    "updatedAt" => "2021-01-20T11:53:26.798Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "60081837731d75ae35f558be"
                ],
                "id" => "6008211ae4afcdaf7e1cb8bf",
                "stores" => [
                    "count" => 0
                ]
            ]
        ];
  
          
          $fujairaAreas = [
            [
                "_id" => "60082a00e4afcdaf7e1cb92f",
                "name_en" => "Corniche Fujairah",
                "name_local" => "كورنيش الفجيرة",
                "published_at" => "2021-01-20T13:02:56.344Z",
                "createdAt" => "2021-01-20T13:02:56.348Z",
                "updatedAt" => "2021-01-20T13:02:56.420Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "60082a00e4afcdaf7e1cb92f",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a00e4afcdaf7e1cb930",
                "name_en" => "Deba Fujairah",
                "name_local" => "دبا",
                "published_at" => "2021-01-20T13:02:56.350Z",
                "createdAt" => "2021-01-20T13:02:56.354Z",
                "updatedAt" => "2021-01-20T13:02:56.421Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "60082a00e4afcdaf7e1cb930",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a00e4afcdaf7e1cb931",
                "name_en" => "Downtown Fujairah",
                "name_local" => "وسط المدينة",
                "published_at" => "2021-01-20T13:02:56.393Z",
                "createdAt" => "2021-01-20T13:02:56.398Z",
                "updatedAt" => "2021-01-20T13:02:56.448Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "60082a00e4afcdaf7e1cb931",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ffe4afcdaf7e1cb929",
                "name_en" => "Faseel",
                "name_local" => "الفصيل",
                "published_at" => "2021-01-20T13:02:55.982Z",
                "createdAt" => "2021-01-20T13:02:55.985Z",
                "updatedAt" => "2021-01-20T13:02:56.087Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "600829ffe4afcdaf7e1cb929",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ffe4afcdaf7e1cb92a",
                "name_en" => "Fujairah Freezone",
                "name_local" => "المنطقة الحرة",
                "published_at" => "2021-01-20T13:02:55.987Z",
                "createdAt" => "2021-01-20T13:02:55.991Z",
                "updatedAt" => "2021-01-20T13:02:56.088Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "600829ffe4afcdaf7e1cb92a",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ffe4afcdaf7e1cb92b",
                "name_en" => "Gurfah",
                "name_local" => "الغرفة",
                "published_at" => "2021-01-20T13:02:55.993Z",
                "createdAt" => "2021-01-20T13:02:55.997Z",
                "updatedAt" => "2021-01-20T13:02:56.088Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "600829ffe4afcdaf7e1cb92b",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a00e4afcdaf7e1cb92e",
                "name_en" => "Merashid",
                "name_local" => "مراشد",
                "published_at" => "2021-01-20T13:02:56.334Z",
                "createdAt" => "2021-01-20T13:02:56.342Z",
                "updatedAt" => "2021-01-20T13:02:56.418Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "60082a00e4afcdaf7e1cb92e",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a00e4afcdaf7e1cb92c",
                "name_en" => "Sakamkam",
                "name_local" => "سكمكم",
                "published_at" => "2021-01-20T13:02:56.054Z",
                "createdAt" => "2021-01-20T13:02:56.063Z",
                "updatedAt" => "2021-01-20T13:02:56.104Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "60082a00e4afcdaf7e1cb92c",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a00e4afcdaf7e1cb92d",
                "name_en" => "Saniaya",
                "name_local" => "سنايا",
                "published_at" => "2021-01-20T13:02:56.276Z",
                "createdAt" => "2021-01-20T13:02:56.280Z",
                "updatedAt" => "2021-01-20T13:02:56.383Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "60082a00e4afcdaf7e1cb92d",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "600829ffe4afcdaf7e1cb928",
                "name_en" => "Sharm",
                "name_local" => "شرم",
                "published_at" => "2021-01-20T13:02:55.975Z",
                "createdAt" => "2021-01-20T13:02:55.980Z",
                "updatedAt" => "2021-01-20T13:02:56.085Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "600829ffe4afcdaf7e1cb928",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082a00e4afcdaf7e1cb932",
                "name_en" => "Sheikh Hamad Bin Abdullah St",
                "name_local" => "شارع الشيخ حمد بن عبدالله",
                "published_at" => "2021-01-20T13:02:56.598Z",
                "createdAt" => "2021-01-20T13:02:56.604Z",
                "updatedAt" => "2021-01-20T13:02:56.617Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600828aee4afcdaf7e1cb8cb",
                    "name_local" => "الفجيرة",
                    "name_en" => "Fujairah",
                    "published_at" => "2021-01-20T12:57:20.468Z",
                    "createdAt" => "2021-01-20T12:57:18.239Z",
                    "updatedAt" => "2021-01-20T12:57:20.497Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "6004649e1c86b983d285e5fb",
                    "id" => "600828aee4afcdaf7e1cb8cb"
                ],
                "id" => "60082a00e4afcdaf7e1cb932",
                "stores" => [
                    "count" => 0
                ]
            ]
        ];

        $ajmanAreas=[
            [
                "_id" => "60082af3e4afcdaf7e1cb9c7",
                "name_en" => "Ain Ajman",
                "name_local" => "عين عجمان",
                "published_at" => "2021-01-20T13:06:59.787Z",
                "createdAt" => "2021-01-20T13:06:59.793Z",
                "updatedAt" => "2021-01-20T13:06:59.883Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af3e4afcdaf7e1cb9c7",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af3e4afcdaf7e1cb9c5",
                "name_en" => "Ajman Corniche Road",
                "name_local" => "كورنيش عجمان",
                "published_at" => "2021-01-20T13:06:59.713Z",
                "createdAt" => "2021-01-20T13:06:59.722Z",
                "updatedAt" => "2021-01-20T13:06:59.845Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af3e4afcdaf7e1cb9c5",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af3e4afcdaf7e1cb9c6",
                "name_en" => "Ajman Downtown",
                "name_local" => "عجمان وسط المدينة",
                "published_at" => "2021-01-20T13:06:59.724Z",
                "createdAt" => "2021-01-20T13:06:59.728Z",
                "updatedAt" => "2021-01-20T13:06:59.846Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af3e4afcdaf7e1cb9c6",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af3e4afcdaf7e1cb9c8",
                "name_en" => "Ajman Industrial Area",
                "name_local" => "المنطقة الصناعية",
                "published_at" => "2021-01-20T13:06:59.796Z",
                "createdAt" => "2021-01-20T13:06:59.814Z",
                "updatedAt" => "2021-01-20T13:06:59.885Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af3e4afcdaf7e1cb9c8",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af3e4afcdaf7e1cb9c4",
                "name_en" => "Ajman Meadows",
                "name_local" => "مروج عجمان",
                "published_at" => "2021-01-20T13:06:59.707Z",
                "createdAt" => "2021-01-20T13:06:59.711Z",
                "updatedAt" => "2021-01-20T13:06:59.844Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af3e4afcdaf7e1cb9c4",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9ca",
                "name_en" => "Ajman Uptown",
                "name_local" => "ضواحي عجمان",
                "published_at" => "2021-01-20T13:07:00.080Z",
                "createdAt" => "2021-01-20T13:07:00.094Z",
                "updatedAt" => "2021-01-20T13:07:00.170Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9ca",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af6e4afcdaf7e1cb9e4",
                "name_en" => "Al Amerah",
                "name_local" => "العامرة",
                "published_at" => "2021-01-20T13:07:02.050Z",
                "createdAt" => "2021-01-20T13:07:02.055Z",
                "updatedAt" => "2021-01-20T13:07:02.103Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af6e4afcdaf7e1cb9e4",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9c9",
                "name_en" => "Al Amerah Village",
                "name_local" => "قرية العامرة",
                "published_at" => "2021-01-20T13:07:00.072Z",
                "createdAt" => "2021-01-20T13:07:00.078Z",
                "updatedAt" => "2021-01-20T13:07:00.167Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9c9",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9cb",
                "name_en" => "Al Bustan",
                "name_local" => "البستان",
                "published_at" => "2021-01-20T13:07:00.128Z",
                "createdAt" => "2021-01-20T13:07:00.134Z",
                "updatedAt" => "2021-01-20T13:07:00.223Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9cb",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9cc",
                "name_en" => "Al Hamidiya",
                "name_local" => "الحميدية",
                "published_at" => "2021-01-20T13:07:00.181Z",
                "createdAt" => "2021-01-20T13:07:00.188Z",
                "updatedAt" => "2021-01-20T13:07:00.274Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9cc",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9e1",
                "name_en" => "Al Helio",
                "name_local" => "الحيلو",
                "published_at" => "2021-01-20T13:07:01.811Z",
                "createdAt" => "2021-01-20T13:07:01.814Z",
                "updatedAt" => "2021-01-20T13:07:01.860Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9e1",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9cd",
                "name_en" => "Al Humaid City",
                "name_local" => "مدينة الحميدية",
                "published_at" => "2021-01-20T13:07:00.248Z",
                "createdAt" => "2021-01-20T13:07:00.256Z",
                "updatedAt" => "2021-01-20T13:07:00.293Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9cd",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9ce",
                "name_en" => "Al Ittihad Village",
                "name_local" => "قرية الاتحاد",
                "published_at" => "2021-01-20T13:07:00.389Z",
                "createdAt" => "2021-01-20T13:07:00.424Z",
                "updatedAt" => "2021-01-20T13:07:00.493Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9ce",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9e2",
                "name_en" => "Al Jurf",
                "name_local" => "الجرف",
                "published_at" => "2021-01-20T13:07:01.817Z",
                "createdAt" => "2021-01-20T13:07:01.820Z",
                "updatedAt" => "2021-01-20T13:07:01.861Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9e2",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9cf",
                "name_en" => "Al Mwaihat",
                "name_local" => "المويحات",
                "published_at" => "2021-01-20T13:07:00.523Z",
                "createdAt" => "2021-01-20T13:07:00.532Z",
                "updatedAt" => "2021-01-20T13:07:00.603Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9cf",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9d0",
                "name_en" => "Al Naemiyah",
                "name_local" => "النعيمية",
                "published_at" => "2021-01-20T13:07:00.534Z",
                "createdAt" => "2021-01-20T13:07:00.537Z",
                "updatedAt" => "2021-01-20T13:07:00.604Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9d0",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9d1",
                "name_en" => "Al Raqaib",
                "name_local" => "الرقيب",
                "published_at" => "2021-01-20T13:07:00.573Z",
                "createdAt" => "2021-01-20T13:07:00.575Z",
                "updatedAt" => "2021-01-20T13:07:00.616Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9d1",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9d2",
                "name_en" => "Al Rashidiya",
                "name_local" => "الراشدية",
                "published_at" => "2021-01-20T13:07:00.586Z",
                "createdAt" => "2021-01-20T13:07:00.589Z",
                "updatedAt" => "2021-01-20T13:07:00.628Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9d2",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9d3",
                "name_en" => "Al Rawda",
                "name_local" => "الروضة",
                "published_at" => "2021-01-20T13:07:00.749Z",
                "createdAt" => "2021-01-20T13:07:00.754Z",
                "updatedAt" => "2021-01-20T13:07:00.767Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9d3",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9d8",
                "name_en" => "Al Rumaila",
                "name_local" => "الراشدية",
                "published_at" => "2021-01-20T13:07:01.038Z",
                "createdAt" => "2021-01-20T13:07:01.041Z",
                "updatedAt" => "2021-01-20T13:07:01.084Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9d8",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9d6",
                "name_en" => "Al Sawan",
                "name_local" => "الصوان",
                "published_at" => "2021-01-20T13:07:00.968Z",
                "createdAt" => "2021-01-20T13:07:00.976Z",
                "updatedAt" => "2021-01-20T13:07:01.065Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9d6",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9d5",
                "name_en" => "Al Zahraa",
                "name_local" => "الزهراء",
                "published_at" => "2021-01-20T13:07:00.962Z",
                "createdAt" => "2021-01-20T13:07:00.966Z",
                "updatedAt" => "2021-01-20T13:07:01.064Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9d5",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af4e4afcdaf7e1cb9d4",
                "name_en" => "Al Zorah",
                "name_local" => "الزهراء",
                "published_at" => "2021-01-20T13:07:00.956Z",
                "createdAt" => "2021-01-20T13:07:00.960Z",
                "updatedAt" => "2021-01-20T13:07:01.062Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af4e4afcdaf7e1cb9d4",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9d7",
                "name_en" => "Awali City",
                "name_local" => "مدينة عوالي",
                "published_at" => "2021-01-20T13:07:01.031Z",
                "createdAt" => "2021-01-20T13:07:01.036Z",
                "updatedAt" => "2021-01-20T13:07:01.083Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9d7",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9d9",
                "name_en" => "Green City",
                "name_local" => "مدينة الحدائق",
                "published_at" => "2021-01-20T13:07:01.260Z",
                "createdAt" => "2021-01-20T13:07:01.264Z",
                "updatedAt" => "2021-01-20T13:07:01.314Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9d9",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9da",
                "name_en" => "Manama",
                "name_local" => "المنامة",
                "published_at" => "2021-01-20T13:07:01.299Z",
                "createdAt" => "2021-01-20T13:07:01.303Z",
                "updatedAt" => "2021-01-20T13:07:01.411Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9da",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9db",
                "name_en" => "Marmooka City",
                "name_local" => "مدينة مرموكة",
                "published_at" => "2021-01-20T13:07:01.305Z",
                "createdAt" => "2021-01-20T13:07:01.312Z",
                "updatedAt" => "2021-01-20T13:07:01.413Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9db",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9dd",
                "name_en" => "Masfoot",
                "name_local" => "مصفوط",
                "published_at" => "2021-01-20T13:07:01.387Z",
                "createdAt" => "2021-01-20T13:07:01.390Z",
                "updatedAt" => "2021-01-20T13:07:01.444Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9dd",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9dc",
                "name_en" => "Musheiref",
                "name_local" => "مشيرف",
                "published_at" => "2021-01-20T13:07:01.373Z",
                "createdAt" => "2021-01-20T13:07:01.384Z",
                "updatedAt" => "2021-01-20T13:07:01.443Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9dc",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9de",
                "name_en" => "New Industrial Area",
                "name_local" => "المنطقة الصناعية الجديدة",
                "published_at" => "2021-01-20T13:07:01.650Z",
                "createdAt" => "2021-01-20T13:07:01.675Z",
                "updatedAt" => "2021-01-20T13:07:01.800Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9de",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9df",
                "name_en" => "Park View City",
                "name_local" => "بارك فيو سيتي",
                "published_at" => "2021-01-20T13:07:01.786Z",
                "createdAt" => "2021-01-20T13:07:01.790Z",
                "updatedAt" => "2021-01-20T13:07:01.842Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9df",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af5e4afcdaf7e1cb9e0",
                "name_en" => "Sheikh Khalifa Bin Zayed Street",
                "name_local" => "شارع الشيخ خليفة بن زايد",
                "published_at" => "2021-01-20T13:07:01.792Z",
                "createdAt" => "2021-01-20T13:07:01.795Z",
                "updatedAt" => "2021-01-20T13:07:01.843Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af5e4afcdaf7e1cb9e0",
                "stores" => [
                    "count" => 0
                ]
            ],
            [
                "_id" => "60082af6e4afcdaf7e1cb9e3",
                "name_en" => "Sheikh Maktoum Bin Rashid Rd",
                "name_local" => "شارع الشيخ مكتوم بن راشد",
                "published_at" => "2021-01-20T13:07:02.016Z",
                "createdAt" => "2021-01-20T13:07:02.021Z",
                "updatedAt" => "2021-01-20T13:07:02.045Z",
                "__v" => 0,
                "city" => [
                    "_id" => "600817c0731d75ae35f558bc",
                    "name_en" => "Ajman",
                    "name_local" => "عجمان",
                    "published_at" => "2021-01-20T11:45:06.728Z",
                    "createdAt" => "2021-01-20T11:45:04.685Z",
                    "updatedAt" => "2021-01-20T11:53:07.228Z",
                    "__v" => 0,
                    "country" => "600814ac731d75ae35f558b3",
                    "created_by" => "6004649e1c86b983d285e5fb",
                    "updated_by" => "600454b4eb44d770c0928cf3",
                    "id" => "600817c0731d75ae35f558bc"
                ],
                "id" => "60082af6e4afcdaf7e1cb9e3",
                "stores" => [
                    "count" => 0
                ]
            ]
        ];

        array_push($allCities , $areasAbuDhabi);        
        array_push($allCities , $dubaiAreas);
        array_push($allCities , $sharjaAreas);
        array_push($allCities , $ainAreas);
        array_push($allCities , $ajmanAreas);
        array_push($allCities , $rakAreas);
        array_push($allCities , $uaqAreas);
        array_push($allCities , $fujairaAreas);



        foreach ($allCities as $key => $cites) {
            foreach ($cites as $city){
              

                Area::create(
                    [
                    'name'=>$city['name_en'], 
                    'name_local'=>$city['name_local'],
                    'city_id'=>$key+1
                    ])->save();
                
            };
        };
        print_r('done');
        
    }
}
