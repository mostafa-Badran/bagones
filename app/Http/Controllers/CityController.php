<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\country;
use Cities;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class CityController extends Controller
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
            $data = DB::table('cities as c')
            ->join('countries as co', 'co.id', '=', 'c.country_id')
            ->select('c.id','c.name','c.name_local','co.name as country_name')
            ->get();
            //$data = City::select('id','name','name_local')->get();
            return DataTables::of($data)->make(true);
        }

        $page_title = 'Cities';
        $page_description = 'This page is to show all the records in city table';

        return view('cities.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = country::all();
        $page_title = 'Add New City';
        $page_description = 'This page is to add new record in city table';

        //
        return view('cities.create', compact('page_title', 'page_description','countries'));
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
            'name' => ['required', 'unique:cities', 'max:50'],
            'name_local' => ['unique:cities', 'max:50'],
            'country_id' => ['required'],
        ]);

        City::create($request->all());

        return redirect()->route('city.index')
                        ->with('success','City created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $page_title = 'Show City';
        $page_description = 'This page is to show city details';
        //
        return view('cities.show',compact('city', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::all();
        $page_title = 'Edit City';
        $page_description = 'This page is to edit record in city table';
        //
        return view('cities.edit',compact('city', 'page_title', 'page_description','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
        $request->validate([
            'name' => ['required', Rule::unique('cities', 'name')->ignore($city), 'max:50'],
            'name_local' => [Rule::unique('cities', 'name_local')->ignore($city), 'max:50'],
            'country_id' => ['required'],
        ]);

        $city->update($request->all());

        return redirect()->route('city.index')
                        ->with('success','City updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $com = City::where('id',$request->id)->delete();
        return Response()->json($com);
    }

    public function dataAjax(Request $request)
    {
        $search = $request->search;

        if($search == ''){
           $cities = City::orderby('name','asc')->select('id','name')->limit(5)->get();
        }else{
           $cities = City::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($cities as $city){
           $response[] = array(
                "id"=>$city->id,
                "text"=>$city->name
           );
        }
        return response()->json($response);
    }

    /**
     * get City Arabic names list
     */
    public function getCityArabicNames(){
        $data = City::select('id','name_local','country_id')->get();        
        return $data;
    }
    /**
     * get City Arabic names list
     */
    public function getCityEnglishNames(){
        
        $data = City::select('id','name','country_id')->get();        
        return $data;
    }

    public function getCiteies(){
        $cites = 
        [
            0 => 
            array (
              'name_en' => 'Abu Dhabi',
              'name_local' => 'ابو ظبي',
              'country' => 
              array (
                'name_en' => 'United Arab Emirates',
                'name_local' => 'الإمارات العربية المتحدة',
                'flag' => 
                array (
                  'name' => '1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                  'alternativeText' => '',
                  'caption' => '',
                  'hash' => '1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                  'ext' => '.png',
                  'mime' => 'image/png',
                  'size' => 4.92,
                  'width' => 1280,
                  'height' => 640,
                  'url' => '/uploads/1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                  'formats' => 
                  array (
                    'thumbnail' => 
                    array (
                      'name' => 'thumbnail_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 245,
                      'height' => 123,
                      'size' => 0.63,
                      'path' => NULL,
                      'url' => '/uploads/thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'large' => 
                    array (
                      'name' => 'large_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 1000,
                      'height' => 500,
                      'size' => 3.48,
                      'path' => NULL,
                      'url' => '/uploads/large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'medium' => 
                    array (
                      'name' => 'medium_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 750,
                      'height' => 375,
                      'size' => 2.42,
                      'path' => NULL,
                      'url' => '/uploads/medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'small' => 
                    array (
                      'name' => 'small_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 500,
                      'height' => 250,
                      'size' => 1.39,
                      'path' => NULL,
                      'url' => '/uploads/small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                  ),
                  'provider' => 'local',
                  'related' => 
                  array (
                    0 => '600814ac731d75ae35f558b3',
                    1 => '6036157085841c05d6b227ec',
                  ),
                  'id' => '600814a4731d75ae35f558b2',
                ),
                'city' => '6008185a731d75ae35f558bf',
                'id' => '600814ac731d75ae35f558b3',
              ),
              'areas' => 
              array (
                0 => 
                array (
                  'name_en' => 'Abu Dhabi Gate City',
                  'name_local' => 'بوابة ابوظبي',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2de4afcdaf7e1cb9e5',
                ),
                1 => 
                array (
                  'name_en' => 'Airport Road',
                  'name_local' => 'شارع المطار',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2de4afcdaf7e1cb9e6',
                ),
                2 => 
                array (
                  'name_en' => 'Al Baraha',
                  'name_local' => 'البراحة',
                  'city' => '600815f9731d75ae35f558b6',
                  'stores' => 
                  array (
                    0 => '601f0ab685d95e5383acfb8e',
                    1 => '6036157085841c05d6b227ec',
                  ),
                  'id' => '60082b2de4afcdaf7e1cb9e7',
                ),
                3 => 
                array (
                  'name_en' => 'Badaa',
                  'name_local' => 'البدع',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2de4afcdaf7e1cb9e8',
                ),
                4 => 
                array (
                  'name_en' => 'Al Bahia',
                  'name_local' => 'الباهية',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2de4afcdaf7e1cb9e9',
                ),
                5 => 
                array (
                  'name_en' => 'Al Bateen',
                  'name_local' => 'البطين',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2de4afcdaf7e1cb9ea',
                ),
                6 => 
                array (
                  'name_en' => 'Al Dhafrah',
                  'name_local' => 'الظفرة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2de4afcdaf7e1cb9eb',
                ),
                7 => 
                array (
                  'name_en' => 'Al Falah City',
                  'name_local' => 'مدينة الفلاح',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2de4afcdaf7e1cb9ec',
                ),
                8 => 
                array (
                  'name_en' => 'Al-Forsan',
                  'name_local' => 'قرية الفرسان',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2de4afcdaf7e1cb9ed',
                ),
                9 => 
                array (
                  'name_en' => 'Al Ghadeer',
                  'name_local' => 'الغدير',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2de4afcdaf7e1cb9ee',
                ),
                10 => 
                array (
                  'name_en' => 'Al Gurm',
                  'name_local' => 'القرم',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9ef',
                ),
                11 => 
                array (
                  'name_en' => 'Al Gurm West',
                  'name_local' => 'القرم الغربية',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9f0',
                ),
                12 => 
                array (
                  'name_en' => 'Al Hudayriat Island',
                  'name_local' => 'جزيرة الحضيريات',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9f1',
                ),
                13 => 
                array (
                  'name_en' => 'Al Ittihad Road',
                  'name_local' => 'شارع الاتحاد',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9f2',
                ),
                14 => 
                array (
                  'name_en' => 'Al Karama',
                  'name_local' => 'الكرامة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9f3',
                ),
                15 => 
                array (
                  'name_en' => 'Al Khalidiya',
                  'name_local' => 'الخالدية',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9f4',
                ),
                16 => 
                array (
                  'name_en' => 'Al Khatim',
                  'name_local' => 'الخاتم',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9f5',
                ),
                17 => 
                array (
                  'name_en' => 'Al Maffraq',
                  'name_local' => 'المفرق',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9f6',
                ),
                18 => 
                array (
                  'name_en' => 'Al Manaseer',
                  'name_local' => 'المناصير',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9f7',
                ),
                19 => 
                array (
                  'name_en' => 'Al Manhal',
                  'name_local' => 'المنهل',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9f8',
                ),
                20 => 
                array (
                  'name_en' => 'Al Maqtaa',
                  'name_local' => 'منطقة المقطع',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9f9',
                ),
                21 => 
                array (
                  'name_en' => 'Al Markaziyah',
                  'name_local' => 'المركزية',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9fa',
                ),
                22 => 
                array (
                  'name_en' => 'Al Maryah',
                  'name_local' => 'جزيرة الماريه الصواح',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9fb',
                ),
                23 => 
                array (
                  'name_en' => 'Al Mina',
                  'name_local' => 'ميتاء زايد',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9fc',
                ),
                24 => 
                array (
                  'name_en' => 'Al Mushrif',
                  'name_local' => 'المشرف',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9fd',
                ),
                25 => 
                array (
                  'name_en' => 'Al Nahda',
                  'name_local' => 'النهضة ابوظبي',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9fe',
                ),
                26 => 
                array (
                  'name_en' => 'Al Nahyan Camp',
                  'name_local' => 'معسكر ال نهيان',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cb9ff',
                ),
                27 => 
                array (
                  'name_en' => 'Al Najda Street',
                  'name_local' => 'شارع النجدة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cba00',
                ),
                28 => 
                array (
                  'name_en' => 'Al Raha Beach',
                  'name_local' => 'شاطئ الراحه',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2ee4afcdaf7e1cba01',
                ),
                29 => 
                array (
                  'name_en' => 'Al Raha Golf Gardens',
                  'name_local' => 'حدائق الجولف في الراحة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba02',
                ),
                30 => 
                array (
                  'name_en' => 'Al Raha Gardens',
                  'name_local' => 'حدائق الراحة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba03',
                ),
                31 => 
                array (
                  'name_en' => 'Al Rahba',
                  'name_local' => 'الرجبة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba04',
                ),
                32 => 
                array (
                  'name_en' => 'Al Rawdah',
                  'name_local' => 'الروضة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba05',
                ),
                33 => 
                array (
                  'name_en' => 'Al Rayhan',
                  'name_local' => 'الريحان',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba06',
                ),
                34 => 
                array (
                  'name_en' => 'Al Reef',
                  'name_local' => 'مشروع الريف',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba07',
                ),
                35 => 
                array (
                  'name_en' => 'Al Reem Island',
                  'name_local' => 'جزيرة الريم',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba08',
                ),
                36 => 
                array (
                  'name_en' => 'Al Ruwais',
                  'name_local' => 'الرويس',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba09',
                ),
                37 => 
                array (
                  'name_en' => 'Al Samha',
                  'name_local' => 'السمحة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba0a',
                ),
                38 => 
                array (
                  'name_en' => 'Al Salam Street',
                  'name_local' => 'شارع السلام',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba0b',
                ),
                39 => 
                array (
                  'name_en' => 'Al Shahama',
                  'name_local' => 'الشهامة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba0c',
                ),
                40 => 
                array (
                  'name_en' => 'Al Shamkha',
                  'name_local' => 'الشمخة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba0d',
                ),
                41 => 
                array (
                  'name_en' => 'sila\'a',
                  'name_local' => 'السلع',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba0e',
                ),
                42 => 
                array (
                  'name_en' => 'Al Shawamekh',
                  'name_local' => 'الشوامخ',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b2fe4afcdaf7e1cba0f',
                ),
                43 => 
                array (
                  'name_en' => 'Al Wahda',
                  'name_local' => 'الوحدة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba10',
                ),
                44 => 
                array (
                  'name_en' => 'Al Wathba',
                  'name_local' => 'الوثبة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba11',
                ),
                45 => 
                array (
                  'name_en' => 'Al Zaab',
                  'name_local' => 'الزعاب',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba12',
                ),
                46 => 
                array (
                  'name_en' => 'Al Zahraa',
                  'name_local' => 'الزهراء',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba13',
                ),
                47 => 
                array (
                  'name_en' => 'Al Baniyas',
                  'name_local' => 'بني ياس',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba14',
                ),
                48 => 
                array (
                  'name_en' => 'Between Tow Bridges',
                  'name_local' => 'منطقة بين الجسرين',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba15',
                ),
                49 => 
                array (
                  'name_en' => 'Building Materials City',
                  'name_local' => 'مدينة خامات البناء',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba16',
                ),
                50 => 
                array (
                  'name_en' => 'Capital Centre',
                  'name_local' => 'كابيتال سنتر',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba17',
                ),
                51 => 
                array (
                  'name_en' => 'City Downtown',
                  'name_local' => 'وسط المدينة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba18',
                ),
                52 => 
                array (
                  'name_en' => 'Corniche Road',
                  'name_local' => 'شارع الكورنيش',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba19',
                ),
                53 => 
                array (
                  'name_en' => 'Danet Abu Dhabi',
                  'name_local' => 'دانة ابوظبي',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba1a',
                ),
                54 => 
                array (
                  'name_en' => 'Corniche Area',
                  'name_local' => 'منطقة خلف شارع الكورنيش',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba1b',
                ),
                55 => 
                array (
                  'name_en' => 'Danet Abu Dhabi',
                  'name_local' => 'دانة ابوظبي',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba1c',
                ),
                56 => 
                array (
                  'name_en' => 'Defence Street',
                  'name_local' => 'شارع الدفاع',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba1d',
                ),
                57 => 
                array (
                  'name_en' => 'Desert Village',
                  'name_local' => 'القرية الصحراوية',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b30e4afcdaf7e1cba1e',
                ),
                58 => 
                array (
                  'name_en' => 'Eastern Road',
                  'name_local' => 'الطريق الشرقي',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba1f',
                ),
                59 => 
                array (
                  'name_en' => 'Electra Street',
                  'name_local' => 'شارع الكترا',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba20',
                ),
                60 => 
                array (
                  'name_en' => 'Ghantoot',
                  'name_local' => 'غنتوت',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba21',
                ),
                61 => 
                array (
                  'name_en' => 'Grand Mosque District',
                  'name_local' => 'منطقة المسجد الكبير',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba22',
                ),
                62 => 
                array (
                  'name_en' => 'Hamdan Street',
                  'name_local' => 'شارع حمدان',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba23',
                ),
                63 => 
                array (
                  'name_en' => 'Hameem',
                  'name_local' => 'حميم',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba24',
                ),
                64 => 
                array (
                  'name_en' => 'Hydra Village',
                  'name_local' => 'قرية هيدار',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba25',
                ),
                65 => 
                array (
                  'name_en' => 'Jawazat Street',
                  'name_local' => 'شارع الجوازات',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba26',
                ),
                66 => 
                array (
                  'name_en' => 'Khalifa City',
                  'name_local' => 'مدينة خليفة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba27',
                ),
                67 => 
                array (
                  'name_en' => 'Khalifa Street',
                  'name_local' => 'شارع خليفة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba28',
                ),
                68 => 
                array (
                  'name_en' => 'Liwa',
                  'name_local' => 'ليوا',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba29',
                ),
                69 => 
                array (
                  'name_en' => 'Lulu Island',
                  'name_local' => 'جزيرة اللولو',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba2a',
                ),
                70 => 
                array (
                  'name_en' => 'Madinat Zayed',
                  'name_local' => 'مدينة زايد',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba2b',
                ),
                71 => 
                array (
                  'name_en' => 'Marina Village',
                  'name_local' => 'قرية مارينا',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba2c',
                ),
                72 => 
                array (
                  'name_en' => 'Masdar City',
                  'name_local' => 'مدينة مصدر',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba2d',
                ),
                73 => 
                array (
                  'name_en' => 'Mina Zayed',
                  'name_local' => 'مناء زايد',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba2e',
                ),
                74 => 
                array (
                  'name_en' => 'Mohammad Bin Zayed City',
                  'name_local' => 'مدينة محمد بن زايد',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba2f',
                ),
                75 => 
                array (
                  'name_en' => 'Muroor Area',
                  'name_local' => 'منطقة المرور',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b31e4afcdaf7e1cba30',
                ),
                76 => 
                array (
                  'name_en' => 'Mussafah',
                  'name_local' => 'مصفح',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba31',
                ),
                77 => 
                array (
                  'name_en' => 'Nurai Island',
                  'name_local' => 'جزيرة نوراي',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba32',
                ),
                78 => 
                array (
                  'name_en' => 'Saadiyat Island',
                  'name_local' => 'جزيرة السعديات',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba33',
                ),
                79 => 
                array (
                  'name_en' => 'Sas Al Nakheel',
                  'name_local' => 'ساس النخيل',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba34',
                ),
                80 => 
                array (
                  'name_en' => 'Tourist Club Area',
                  'name_local' => 'منطقة النادي السياحي',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba35',
                ),
                81 => 
                array (
                  'name_en' => 'Umm Al Nar',
                  'name_local' => 'ام النار',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba36',
                ),
                82 => 
                array (
                  'name_en' => 'Yas Island',
                  'name_local' => 'جزيرة الياس',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba37',
                ),
                83 => 
                array (
                  'name_en' => 'Zayed Military City',
                  'name_local' => 'مدينة زايد العسكرية',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba38',
                ),
                84 => 
                array (
                  'name_en' => 'Zayed Sports City',
                  'name_local' => 'مدينة زايد الرياضية',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba39',
                ),
                85 => 
                array (
                  'name_en' => 'Badaa',
                  'name_local' => 'البدع',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba3a',
                ),
                86 => 
                array (
                  'name_en' => 'Al Ittihad Road',
                  'name_local' => 'شارع الاتحاد',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba3b',
                ),
                87 => 
                array (
                  'name_en' => 'City Downtown',
                  'name_local' => 'وسط المدينة',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba3c',
                ),
                88 => 
                array (
                  'name_en' => 'Al-Forsan',
                  'name_local' => 'قرية الفرسان',
                  'city' => '600815f9731d75ae35f558b6',
                  'id' => '60082b32e4afcdaf7e1cba3d',
                ),
              ),
              'id' => '600815f9731d75ae35f558b6',
            ),
            1 => 
            array (
              'name_en' => 'Dubai',
              'name_local' => 'دبي',
              'country' => 
              array (
                'name_en' => 'United Arab Emirates',
                'name_local' => 'الإمارات العربية المتحدة',
                'flag' => 
                array (
                  'name' => '1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                  'alternativeText' => '',
                  'caption' => '',
                  'hash' => '1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                  'ext' => '.png',
                  'mime' => 'image/png',
                  'size' => 4.92,
                  'width' => 1280,
                  'height' => 640,
                  'url' => '/uploads/1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                  'formats' => 
                  array (
                    'thumbnail' => 
                    array (
                      'name' => 'thumbnail_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 245,
                      'height' => 123,
                      'size' => 0.63,
                      'path' => NULL,
                      'url' => '/uploads/thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'large' => 
                    array (
                      'name' => 'large_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 1000,
                      'height' => 500,
                      'size' => 3.48,
                      'path' => NULL,
                      'url' => '/uploads/large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'medium' => 
                    array (
                      'name' => 'medium_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 750,
                      'height' => 375,
                      'size' => 2.42,
                      'path' => NULL,
                      'url' => '/uploads/medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'small' => 
                    array (
                      'name' => 'small_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 500,
                      'height' => 250,
                      'size' => 1.39,
                      'path' => NULL,
                      'url' => '/uploads/small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                  ),
                  'provider' => 'local',
                  'related' => 
                  array (
                    0 => '600814ac731d75ae35f558b3',
                    1 => '6036157085841c05d6b227ec',
                  ),
                  'id' => '600814a4731d75ae35f558b2',
                ),
                'city' => '6008185a731d75ae35f558bf',
                'id' => '600814ac731d75ae35f558b3',
              ),
              'areas' => 
              array (
                0 => 
                array (
                  'name_en' => 'Acacia Avenues',
                  'name_local' => 'القوز',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a38e4afcdaf7e1cb933',
                ),
                1 => 
                array (
                  'name_en' => 'Academic City',
                  'name_local' => 'المدينة الأكاديمية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a38e4afcdaf7e1cb934',
                ),
                2 => 
                array (
                  'name_en' => 'Al Barari',
                  'name_local' => 'البراري',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a38e4afcdaf7e1cb935',
                ),
                3 => 
                array (
                  'name_en' => 'Al Badaa',
                  'name_local' => 'البدع',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a38e4afcdaf7e1cb936',
                ),
                4 => 
                array (
                  'name_en' => 'Al Aweer',
                  'name_local' => 'العوير',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a38e4afcdaf7e1cb937',
                ),
                5 => 
                array (
                  'name_en' => 'Al Barsha',
                  'name_local' => 'البرشاء',
                  'city' => '600816ae731d75ae35f558b9',
                  'store' => '601f0ab685d95e5383acfb8e',
                  'stores' => 
                  array (
                    0 => '6036157085841c05d6b227ec',
                    1 => '601f0ab685d95e5383acfb8e',
                  ),
                  'id' => '60082a38e4afcdaf7e1cb938',
                ),
                6 => 
                array (
                  'name_en' => 'Al Furjan',
                  'name_local' => 'الفرجان',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a38e4afcdaf7e1cb939',
                ),
                7 => 
                array (
                  'name_en' => 'Al Garhoud',
                  'name_local' => 'القرهود',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a38e4afcdaf7e1cb93a',
                ),
                8 => 
                array (
                  'name_en' => 'Al Hamriya',
                  'name_local' => 'الحميرية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a38e4afcdaf7e1cb93b',
                ),
                9 => 
                array (
                  'name_en' => 'Al Jaddaf',
                  'name_local' => 'الجداف',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a38e4afcdaf7e1cb93c',
                ),
                10 => 
                array (
                  'name_en' => 'Al Jafiliya',
                  'name_local' => 'الجافلية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb93d',
                ),
                11 => 
                array (
                  'name_en' => 'Al Khawaneej',
                  'name_local' => 'الكورنيش',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb93e',
                ),
                12 => 
                array (
                  'name_en' => 'Al Mizhar',
                  'name_local' => 'المزهر',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb93f',
                ),
                13 => 
                array (
                  'name_en' => 'Al Muhaisnah',
                  'name_local' => 'المحيسنية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb940',
                ),
                14 => 
                array (
                  'name_en' => 'Al Nahda',
                  'name_local' => 'النهدا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb941',
                ),
                15 => 
                array (
                  'name_en' => 'Al Quoz',
                  'name_local' => 'القوز',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb942',
                ),
                16 => 
                array (
                  'name_en' => 'Al Qusais',
                  'name_local' => 'القصيص',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb943',
                ),
                17 => 
                array (
                  'name_en' => 'Al Rashidiya',
                  'name_local' => 'الراشدية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb944',
                ),
                18 => 
                array (
                  'name_en' => 'Al Safa',
                  'name_local' => 'الصفا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb945',
                ),
                19 => 
                array (
                  'name_en' => 'Al Satwa',
                  'name_local' => 'السطوة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb946',
                ),
                20 => 
                array (
                  'name_en' => 'Al Shindagah',
                  'name_local' => 'الشندغة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb947',
                ),
                21 => 
                array (
                  'name_en' => 'Al Sufouh',
                  'name_local' => 'الصفة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb948',
                ),
                22 => 
                array (
                  'name_en' => 'Al Twar',
                  'name_local' => 'الطور',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb949',
                ),
                23 => 
                array (
                  'name_en' => 'Al Warqa\'a',
                  'name_local' => 'الورقاء',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb94a',
                ),
                24 => 
                array (
                  'name_en' => 'Al Warsan',
                  'name_local' => 'الورسان',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb94b',
                ),
                25 => 
                array (
                  'name_en' => 'Al Wasl',
                  'name_local' => 'الوصل',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a39e4afcdaf7e1cb94c',
                ),
                26 => 
                array (
                  'name_en' => 'Arabian Ranches',
                  'name_local' => 'المرابع العربية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb94d',
                ),
                27 => 
                array (
                  'name_en' => 'Bur Dubai',
                  'name_local' => 'بر دبي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb94e',
                ),
                28 => 
                array (
                  'name_en' => 'Culture Village',
                  'name_local' => 'القرية الثقافية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb94f',
                ),
                29 => 
                array (
                  'name_en' => 'Deira',
                  'name_local' => 'ديرة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb950',
                ),
                30 => 
                array (
                  'name_en' => 'Business Bay',
                  'name_local' => 'الخليج التجاري',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb951',
                ),
                31 => 
                array (
                  'name_en' => 'DIFC',
                  'name_local' => 'القضائية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb952',
                ),
                32 => 
                array (
                  'name_en' => 'Discovery Gardens',
                  'name_local' => 'ديسكفري جاردنز',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb953',
                ),
                33 => 
                array (
                  'name_en' => 'Dubai Downtown Dubai',
                  'name_local' => 'وسط المدينة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb954',
                ),
                34 => 
                array (
                  'name_en' => 'Dubai Design District',
                  'name_local' => 'حي دبي للتصميم',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb955',
                ),
                35 => 
                array (
                  'name_en' => 'Dubai Downtown Jebel Ali',
                  'name_local' => 'وسط المدينة جبل علي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb956',
                ),
                36 => 
                array (
                  'name_en' => 'Dubai Festival City',
                  'name_local' => 'فيستيفال سيتي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb957',
                ),
                37 => 
                array (
                  'name_en' => 'Dubai Healthcare City',
                  'name_local' => 'مدينة الرعاية الصحية ',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb958',
                ),
                38 => 
                array (
                  'name_en' => 'Hills Estate',
                  'name_local' => 'هيلز استيت',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb959',
                ),
                39 => 
                array (
                  'name_en' => 'Industrial City',
                  'name_local' => 'الصناعيّة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ae4afcdaf7e1cb95a',
                ),
                40 => 
                array (
                  'name_en' => 'International City',
                  'name_local' => 'القرية العالمية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb95b',
                ),
                41 => 
                array (
                  'name_en' => 'Investment Park',
                  'name_local' => 'مجمع دبي للإستثمار',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb95c',
                ),
                42 => 
                array (
                  'name_en' => 'Dubai Land',
                  'name_local' => 'لاند',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb95d',
                ),
                43 => 
                array (
                  'name_en' => 'Dubai Marina',
                  'name_local' => 'مارينا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb95e',
                ),
                44 => 
                array (
                  'name_en' => 'Media City',
                  'name_local' => 'المدينة الاعلامية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb95f',
                ),
                45 => 
                array (
                  'name_en' => 'Dubai Promenade',
                  'name_local' => 'الممشى',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb960',
                ),
                46 => 
                array (
                  'name_en' => 'Dubai Pearl',
                  'name_local' => 'لؤلؤة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb961',
                ),
                47 => 
                array (
                  'name_en' => 'Dubai Silicon Oasis',
                  'name_local' => 'واحة السيليكون',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb962',
                ),
                48 => 
                array (
                  'name_en' => 'Dubai Sports City',
                  'name_local' => 'مدينة دبي الرياضية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb963',
                ),
                49 => 
                array (
                  'name_en' => 'Dubai Studio City',
                  'name_local' => 'استوديو سيتي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb964',
                ),
                50 => 
                array (
                  'name_en' => 'Dubai World Central',
                  'name_local' => 'مركز دبي العالمي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb965',
                ),
                51 => 
                array (
                  'name_en' => 'Dubai Waterfront',
                  'name_local' => 'الواجهة البحرية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb966',
                ),
                52 => 
                array (
                  'name_en' => 'DuBiotech',
                  'name_local' => 'المركز الالكتروني بدبي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb967',
                ),
                53 => 
                array (
                  'name_en' => 'Emirates Golf Club',
                  'name_local' => 'نادي الإمارات للجولف',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb968',
                ),
                54 => 
                array (
                  'name_en' => 'Global Village',
                  'name_local' => 'القرية العالمية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb969',
                ),
                55 => 
                array (
                  'name_en' => 'Emirates Hills',
                  'name_local' => 'تلال الامارات',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb96a',
                ),
                56 => 
                array (
                  'name_en' => 'Green Community',
                  'name_local' => 'مجتمع الحدائق',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3be4afcdaf7e1cb96b',
                ),
                57 => 
                array (
                  'name_en' => 'Greens',
                  'name_local' => 'جرينز',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb96c',
                ),
                58 => 
                array (
                  'name_en' => 'Hatta',
                  'name_local' => 'حتا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb96d',
                ),
                59 => 
                array (
                  'name_en' => 'IMPZ',
                  'name_local' => 'مدينة الانتاج الاعلامي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb96e',
                ),
                60 => 
                array (
                  'name_en' => 'Jebel Ali',
                  'name_local' => 'جبل علي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb96f',
                ),
                61 => 
                array (
                  'name_en' => 'Jumeirah',
                  'name_local' => 'جميرا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb970',
                ),
                62 => 
                array (
                  'name_en' => 'Jumeirah Beach Residence',
                  'name_local' => 'مساكن شاطئ جميرا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb971',
                ),
                63 => 
                array (
                  'name_en' => 'Jumeirah Golf Estates',
                  'name_local' => 'منطقة الجولف الجميرا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb972',
                ),
                64 => 
                array (
                  'name_en' => 'Jumeirah Heights',
                  'name_local' => 'تلال الامارات',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb973',
                ),
                65 => 
                array (
                  'name_en' => 'Jumeirah Islands',
                  'name_local' => 'جزر الجميرا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb974',
                ),
                66 => 
                array (
                  'name_en' => 'Jumeirah Park',
                  'name_local' => 'جميرا بارك',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb975',
                ),
                67 => 
                array (
                  'name_en' => 'Jumeirah Lake Towers',
                  'name_local' => 'ابراج بحيرة الجميرا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb976',
                ),
                68 => 
                array (
                  'name_en' => 'Jumeirah Village Circle',
                  'name_local' => 'قرية الجميرا سركل',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb977',
                ),
                69 => 
                array (
                  'name_en' => 'Jumeirah Village Triangle',
                  'name_local' => 'مثلث قرية الجميرا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb978',
                ),
                70 => 
                array (
                  'name_en' => 'Karama',
                  'name_local' => 'الكرامة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb979',
                ),
                71 => 
                array (
                  'name_en' => 'Meadows',
                  'name_local' => 'ميدوز',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb97a',
                ),
                72 => 
                array (
                  'name_en' => 'Maritime City',
                  'name_local' => 'المدينة الملاحية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb97b',
                ),
                73 => 
                array (
                  'name_en' => 'Meydan Avenue',
                  'name_local' => 'ميدان افينو',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ce4afcdaf7e1cb97c',
                ),
                74 => 
                array (
                  'name_en' => 'Meydan Gated Community',
                  'name_local' => 'ميدان غايتد كوميونيتي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb97d',
                ),
                75 => 
                array (
                  'name_en' => 'Mina Al Arab',
                  'name_local' => 'ميناء العرب',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb97e',
                ),
                76 => 
                array (
                  'name_en' => 'Mirdif',
                  'name_local' => 'مردف',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb97f',
                ),
                77 => 
                array (
                  'name_en' => 'Mohammad Bin Rashid City',
                  'name_local' => 'مدينة محمد بن راشد',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb980',
                ),
                78 => 
                array (
                  'name_en' => 'Motor City',
                  'name_local' => 'مدينة السيارات',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb981',
                ),
                79 => 
                array (
                  'name_en' => 'Motor City',
                  'name_local' => 'مدينة السيارات',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb982',
                ),
                80 => 
                array (
                  'name_en' => 'Mushrif Park',
                  'name_local' => 'حديقة المشرف',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb983',
                ),
                81 => 
                array (
                  'name_en' => 'Nadd Al Hammar',
                  'name_local' => 'ند الحمر',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb984',
                ),
                82 => 
                array (
                  'name_en' => 'Nadd Al Sheba',
                  'name_local' => 'ند الشبا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb985',
                ),
                83 => 
                array (
                  'name_en' => 'Oud Al Muteena',
                  'name_local' => 'عود المطينة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb986',
                ),
                84 => 
                array (
                  'name_en' => 'Old Town',
                  'name_local' => 'المدينة القديمة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb987',
                ),
                85 => 
                array (
                  'name_en' => 'Palm Jebel Ali',
                  'name_local' => 'نخلة جبل علي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb988',
                ),
                86 => 
                array (
                  'name_en' => 'Palm jumeirah',
                  'name_local' => 'نخلة الجميرا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb989',
                ),
                87 => 
                array (
                  'name_en' => 'Ras Al Khor',
                  'name_local' => 'رأس الخور',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb98a',
                ),
                88 => 
                array (
                  'name_en' => 'Reem',
                  'name_local' => 'ريم',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb98b',
                ),
                89 => 
                array (
                  'name_en' => 'Sheikh Zayed Road',
                  'name_local' => 'شارع الشيخ زايد',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb98c',
                ),
                90 => 
                array (
                  'name_en' => 'Technology Park',
                  'name_local' => 'واحة التكنولوجيا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3de4afcdaf7e1cb98d',
                ),
                91 => 
                array (
                  'name_en' => 'TECOM',
                  'name_local' => 'تيكوم',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb98e',
                ),
                92 => 
                array (
                  'name_en' => 'The Gardens',
                  'name_local' => 'الحدائق',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb98f',
                ),
                93 => 
                array (
                  'name_en' => 'The Lagoons',
                  'name_local' => 'ذا لاجونز',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb990',
                ),
                94 => 
                array (
                  'name_en' => 'The Hills',
                  'name_local' => 'مشروع التلال',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb991',
                ),
                95 => 
                array (
                  'name_en' => 'The Lakes',
                  'name_local' => 'البحيرات',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb992',
                ),
                96 => 
                array (
                  'name_en' => 'The Meadows',
                  'name_local' => 'المروج',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb993',
                ),
                97 => 
                array (
                  'name_en' => 'The Palm Deira',
                  'name_local' => 'جزيرة النخلة ديرة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb994',
                ),
                98 => 
                array (
                  'name_en' => 'The Views',
                  'name_local' => 'ذا فيوز',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb995',
                ),
                99 => 
                array (
                  'name_en' => 'The Springs',
                  'name_local' => 'الينابيع',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb996',
                ),
                100 => 
                array (
                  'name_en' => 'The World Islands',
                  'name_local' => 'جزر العالم',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb997',
                ),
                101 => 
                array (
                  'name_en' => 'Umm Al Sheif',
                  'name_local' => 'ام الشيف',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb998',
                ),
                102 => 
                array (
                  'name_en' => 'Umm Hurair',
                  'name_local' => 'ام الحرير',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb999',
                ),
                103 => 
                array (
                  'name_en' => 'Umm Suqeim',
                  'name_local' => 'ام سقيم',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb99a',
                ),
                104 => 
                array (
                  'name_en' => 'Wadi Al Amardi',
                  'name_local' => 'وادي الاماردي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb99b',
                ),
                105 => 
                array (
                  'name_en' => 'Victory Heights',
                  'name_local' => 'فيكتوري هايتس',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3ee4afcdaf7e1cb99c',
                ),
                106 => 
                array (
                  'name_en' => 'Umm Ramool',
                  'name_local' => 'ام الرمول',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb99d',
                ),
                107 => 
                array (
                  'name_en' => 'World Trade Center',
                  'name_local' => 'المركز المالي العالمي',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb99e',
                ),
                108 => 
                array (
                  'name_en' => 'Zulal',
                  'name_local' => 'زلال',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb99f',
                ),
                109 => 
                array (
                  'name_en' => 'Zabeel',
                  'name_local' => 'زعبيل',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb9a0',
                ),
                110 => 
                array (
                  'name_en' => 'Al Badaa',
                  'name_local' => 'البدع',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb9a1',
                ),
                111 => 
                array (
                  'name_en' => 'Al Nahda',
                  'name_local' => 'النهدا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb9a2',
                ),
                112 => 
                array (
                  'name_en' => 'Al Rashidiya',
                  'name_local' => 'الراشدية',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb9a3',
                ),
                113 => 
                array (
                  'name_en' => 'South Dubai',
                  'name_local' => 'دبي جنوب',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb9a4',
                ),
                114 => 
                array (
                  'name_en' => 'Damac Hills',
                  'name_local' => 'داماك هيلز',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb9a5',
                ),
                115 => 
                array (
                  'name_en' => 'Bluewaters Island',
                  'name_local' => 'جزيرة بلوواترز',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb9a6',
                ),
                116 => 
                array (
                  'name_en' => 'Mudon',
                  'name_local' => 'مدن',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb9a7',
                ),
                117 => 
                array (
                  'name_en' => 'Liwan',
                  'name_local' => 'ليوان',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb9a8',
                ),
                118 => 
                array (
                  'name_en' => 'Serena',
                  'name_local' => 'سيرينا',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a3fe4afcdaf7e1cb9a9',
                ),
                119 => 
                array (
                  'name_en' => 'Sceince Park',
                  'name_local' => 'مجمع دبي للعلوم',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a40e4afcdaf7e1cb9aa',
                ),
                120 => 
                array (
                  'name_en' => 'Port Rashid',
                  'name_local' => 'ميناء راشد',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a40e4afcdaf7e1cb9ab',
                ),
                121 => 
                array (
                  'name_en' => 'Residence Complex',
                  'name_local' => 'مجمع دبي السكني',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a40e4afcdaf7e1cb9ac',
                ),
                122 => 
                array (
                  'name_en' => 'Remram',
                  'name_local' => 'رامرام',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a40e4afcdaf7e1cb9ad',
                ),
                123 => 
                array (
                  'name_en' => 'Al Manara',
                  'name_local' => 'المنارة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '60082a40e4afcdaf7e1cb9ae',
                ),
                124 => 
                array (
                  'name_en' => 'jmc',
                  'name_local' => 'جميرة',
                  'city' => '600816ae731d75ae35f558b9',
                  'id' => '600c0156e4afcdaf7e1cba3e',
                ),
              ),
              'id' => '600816ae731d75ae35f558b9',
            ),
            2 => 
            array (
              'name_en' => 'Sharjah',
              'name_local' => 'الشارقة',
              'country' => 
              array (
                'name_en' => 'United Arab Emirates',
                'name_local' => 'الإمارات العربية المتحدة',
                'flag' => 
                array (
                  'name' => '1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                  'alternativeText' => '',
                  'caption' => '',
                  'hash' => '1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                  'ext' => '.png',
                  'mime' => 'image/png',
                  'size' => 4.92,
                  'width' => 1280,
                  'height' => 640,
                  'url' => '/uploads/1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                  'formats' => 
                  array (
                    'thumbnail' => 
                    array (
                      'name' => 'thumbnail_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 245,
                      'height' => 123,
                      'size' => 0.63,
                      'path' => NULL,
                      'url' => '/uploads/thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'large' => 
                    array (
                      'name' => 'large_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 1000,
                      'height' => 500,
                      'size' => 3.48,
                      'path' => NULL,
                      'url' => '/uploads/large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'medium' => 
                    array (
                      'name' => 'medium_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 750,
                      'height' => 375,
                      'size' => 2.42,
                      'path' => NULL,
                      'url' => '/uploads/medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'small' => 
                    array (
                      'name' => 'small_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 500,
                      'height' => 250,
                      'size' => 1.39,
                      'path' => NULL,
                      'url' => '/uploads/small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                  ),
                  'provider' => 'local',
                  'related' => 
                  array (
                    0 => '600814ac731d75ae35f558b3',
                    1 => '6036157085841c05d6b227ec',
                  ),
                  'id' => '600814a4731d75ae35f558b2',
                ),
                'city' => '6008185a731d75ae35f558bf',
                'id' => '600814ac731d75ae35f558b3',
              ),
              'areas' => 
              array (
                0 => 
                array (
                  'name_en' => 'Abu Shagra',
                  'name_local' => 'ابو شغارة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082928e4afcdaf7e1cb8cc',
                ),
                1 => 
                array (
                  'name_en' => 'Al Butina',
                  'name_local' => 'البطينة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082928e4afcdaf7e1cb8cd',
                ),
                2 => 
                array (
                  'name_en' => 'Al Badie',
                  'name_local' => 'البادي',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082928e4afcdaf7e1cb8ce',
                ),
                3 => 
                array (
                  'name_en' => 'Al Ettihad Street',
                  'name_local' => 'شارع الاتحاد',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082928e4afcdaf7e1cb8cf',
                ),
                4 => 
                array (
                  'name_en' => 'Al Brashi',
                  'name_local' => 'البراشي',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082928e4afcdaf7e1cb8d0',
                ),
                5 => 
                array (
                  'name_en' => 'Al Fayha',
                  'name_local' => 'الفيحاء',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8d1',
                ),
                6 => 
                array (
                  'name_en' => 'Al Fisht',
                  'name_local' => 'منطقة الفشت',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8d2',
                ),
                7 => 
                array (
                  'name_en' => 'Al Ghafeyah Area',
                  'name_local' => 'الغافية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8d3',
                ),
                8 => 
                array (
                  'name_en' => 'Al Gharb',
                  'name_local' => 'الغرب',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8d4',
                ),
                9 => 
                array (
                  'name_en' => 'Al Garayen',
                  'name_local' => 'القرائن',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8d5',
                ),
                10 => 
                array (
                  'name_en' => 'Al Ghuair',
                  'name_local' => 'الغوير',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8d6',
                ),
                11 => 
                array (
                  'name_en' => 'Al Jubail',
                  'name_local' => 'الجبيل',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8d7',
                ),
                12 => 
                array (
                  'name_en' => 'Al Jurainah',
                  'name_local' => 'الجرينة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8d8',
                ),
                13 => 
                array (
                  'name_en' => 'Al Khezamia',
                  'name_local' => 'الحزامية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8d9',
                ),
                14 => 
                array (
                  'name_en' => 'Al Majaz',
                  'name_local' => 'المجاز',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8da',
                ),
                15 => 
                array (
                  'name_en' => 'Al Mareija',
                  'name_local' => 'المريجة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '60082929e4afcdaf7e1cb8db',
                ),
                16 => 
                array (
                  'name_en' => 'Al Mujarrah',
                  'name_local' => 'المجرة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8dc',
                ),
                17 => 
                array (
                  'name_en' => 'Al Nabba',
                  'name_local' => 'النباعة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8dd',
                ),
                18 => 
                array (
                  'name_en' => 'Al Nahda',
                  'name_local' => 'النهدة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8de',
                ),
                19 => 
                array (
                  'name_en' => 'Al Naimiya Area',
                  'name_local' => 'منطقة النعيمية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8df',
                ),
                20 => 
                array (
                  'name_en' => 'Al Nekhailat',
                  'name_local' => 'النخيلات',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8e0',
                ),
                21 => 
                array (
                  'name_en' => 'Al Nasreya',
                  'name_local' => 'الناصرية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8e1',
                ),
                22 => 
                array (
                  'name_en' => 'Al Nujoom Islands',
                  'name_local' => 'جزيرة النجوم',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8e2',
                ),
                23 => 
                array (
                  'name_en' => 'Al Nouf',
                  'name_local' => 'النوف',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8e3',
                ),
                24 => 
                array (
                  'name_en' => 'Al Qarain',
                  'name_local' => 'القرين',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8e4',
                ),
                25 => 
                array (
                  'name_en' => 'Al Qasbaa',
                  'name_local' => 'القصباء',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8e5',
                ),
                26 => 
                array (
                  'name_en' => 'Al Qasemiya',
                  'name_local' => 'القاسمية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8e6',
                ),
                27 => 
                array (
                  'name_en' => 'Al Rahmaniya',
                  'name_local' => 'الرحمانية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8e7',
                ),
                28 => 
                array (
                  'name_en' => 'Al Ramla',
                  'name_local' => 'الرملة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8e8',
                ),
                29 => 
                array (
                  'name_en' => 'Al Ramtha',
                  'name_local' => 'الرمثاء',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8e9',
                ),
                30 => 
                array (
                  'name_en' => 'Al Riffa Area',
                  'name_local' => 'منطقة الرفاع',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8ea',
                ),
                31 => 
                array (
                  'name_en' => 'Al Riqqa',
                  'name_local' => 'ضاحية الرقة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8eb',
                ),
                32 => 
                array (
                  'name_en' => 'Al Sajaa',
                  'name_local' => 'السجع',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8ec',
                ),
                33 => 
                array (
                  'name_en' => 'Al Shahba',
                  'name_local' => 'الشهباء',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ae4afcdaf7e1cb8ed',
                ),
                34 => 
                array (
                  'name_en' => 'Al Taawun',
                  'name_local' => 'التعاون',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8ee',
                ),
                35 => 
                array (
                  'name_en' => 'Al Sharq',
                  'name_local' => 'الشرق',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8ef',
                ),
                36 => 
                array (
                  'name_en' => 'Al Suyoh',
                  'name_local' => 'السيوح',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8f0',
                ),
                37 => 
                array (
                  'name_en' => 'Al Suyoh Suburb',
                  'name_local' => 'ضاحية السيوح',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8f1',
                ),
                38 => 
                array (
                  'name_en' => 'Al Tai',
                  'name_local' => 'الطي',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8f2',
                ),
                39 => 
                array (
                  'name_en' => 'Al Tayy Suburb',
                  'name_local' => 'ضاحية الطي',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8f3',
                ),
                40 => 
                array (
                  'name_en' => 'Al Wahda',
                  'name_local' => 'الوحدة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8f4',
                ),
                41 => 
                array (
                  'name_en' => 'Al Yarmouk',
                  'name_local' => 'اليرموك',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8f5',
                ),
                42 => 
                array (
                  'name_en' => 'Al Zubair',
                  'name_local' => 'الزبير',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8f6',
                ),
                43 => 
                array (
                  'name_en' => 'Cornich Al Buhaira',
                  'name_local' => 'كورنيش البحيرة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8f7',
                ),
                44 => 
                array (
                  'name_en' => 'Hamriyah Free Zone',
                  'name_local' => 'المنطقة الحرة بالحامرية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8f8',
                ),
                45 => 
                array (
                  'name_en' => 'Aalwan',
                  'name_local' => 'حلوان',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8f9',
                ),
                46 => 
                array (
                  'name_en' => 'Jwezaa',
                  'name_local' => 'جويرة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8fa',
                ),
                47 => 
                array (
                  'name_en' => 'Maysaloon',
                  'name_local' => 'ميسلون',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8fb',
                ),
                48 => 
                array (
                  'name_en' => 'Muelih',
                  'name_local' => 'مويلح',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8fc',
                ),
                49 => 
                array (
                  'name_en' => 'Mughaidir',
                  'name_local' => 'مغيدر',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292be4afcdaf7e1cb8fd',
                ),
                50 => 
                array (
                  'name_en' => 'Muelih Commercial',
                  'name_local' => 'تجارية مويلح',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb8fe',
                ),
                51 => 
                array (
                  'name_en' => 'Rolla Area',
                  'name_local' => 'منطقة الرولة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb8ff',
                ),
                52 => 
                array (
                  'name_en' => 'Airport Freezon',
                  'name_local' => 'المنطقة الحرة بمطار الشارقة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb900',
                ),
                53 => 
                array (
                  'name_en' => 'Industrial Area',
                  'name_local' => 'المنطقة الصناعية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb901',
                ),
                54 => 
                array (
                  'name_en' => 'Sharqan',
                  'name_local' => 'شرقان',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb902',
                ),
                55 => 
                array (
                  'name_en' => 'Umm Khanoor',
                  'name_local' => 'ام خنور',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb903',
                ),
                56 => 
                array (
                  'name_en' => 'Tilal City',
                  'name_local' => 'تلال سيتي',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb904',
                ),
                57 => 
                array (
                  'name_en' => 'Um Altaraffa',
                  'name_local' => 'ام الطرفة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb905',
                ),
                58 => 
                array (
                  'name_en' => 'Wasit',
                  'name_local' => 'ضاحية واسط',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb906',
                ),
                59 => 
                array (
                  'name_en' => 'Al Jada',
                  'name_local' => 'شارع الاتحاد',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb907',
                ),
                60 => 
                array (
                  'name_en' => 'Aaterfront City Marina',
                  'name_local' => 'الواجهة المائية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb908',
                ),
                61 => 
                array (
                  'name_en' => 'Hoshi',
                  'name_local' => 'حوشي',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb909',
                ),
                62 => 
                array (
                  'name_en' => 'University City',
                  'name_local' => 'المدينة الجامعية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb90a',
                ),
                63 => 
                array (
                  'name_en' => 'Bu Tina',
                  'name_local' => 'بوطينة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb90b',
                ),
                64 => 
                array (
                  'name_en' => 'Al Azra',
                  'name_local' => 'العزرة',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb90c',
                ),
                65 => 
                array (
                  'name_en' => 'Al Ramaqiya',
                  'name_local' => 'الرماقية',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb90d',
                ),
                66 => 
                array (
                  'name_en' => 'Al Falaj',
                  'name_local' => 'الفلج',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292ce4afcdaf7e1cb90e',
                ),
                67 => 
                array (
                  'name_en' => 'Al Yash',
                  'name_local' => 'الياش',
                  'city' => '60081756731d75ae35f558ba',
                  'id' => '6008292de4afcdaf7e1cb90f',
                ),
              ),
              'id' => '60081756731d75ae35f558ba',
            ),
            3 => 
            array (
              'name_en' => 'Al Ain',
              'name_local' => 'العين',
              'country' => 
              array (
                'name_en' => 'United Arab Emirates',
                'name_local' => 'الإمارات العربية المتحدة',
                'flag' => 
                array (
                  'name' => '1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                  'alternativeText' => '',
                  'caption' => '',
                  'hash' => '1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                  'ext' => '.png',
                  'mime' => 'image/png',
                  'size' => 4.92,
                  'width' => 1280,
                  'height' => 640,
                  'url' => '/uploads/1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                  'formats' => 
                  array (
                    'thumbnail' => 
                    array (
                      'name' => 'thumbnail_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 245,
                      'height' => 123,
                      'size' => 0.63,
                      'path' => NULL,
                      'url' => '/uploads/thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'large' => 
                    array (
                      'name' => 'large_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 1000,
                      'height' => 500,
                      'size' => 3.48,
                      'path' => NULL,
                      'url' => '/uploads/large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'medium' => 
                    array (
                      'name' => 'medium_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 750,
                      'height' => 375,
                      'size' => 2.42,
                      'path' => NULL,
                      'url' => '/uploads/medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'small' => 
                    array (
                      'name' => 'small_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 500,
                      'height' => 250,
                      'size' => 1.39,
                      'path' => NULL,
                      'url' => '/uploads/small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                  ),
                  'provider' => 'local',
                  'related' => 
                  array (
                    0 => '600814ac731d75ae35f558b3',
                    1 => '6036157085841c05d6b227ec',
                  ),
                  'id' => '600814a4731d75ae35f558b2',
                ),
                'city' => '6008185a731d75ae35f558bf',
                'id' => '600814ac731d75ae35f558b3',
              ),
              'areas' => 
              array (
                0 => 
                array (
                  'name_en' => 'Al Grayyeh',
                  'name_local' => 'القرية',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8ee4afcdaf7e1cb9af',
                ),
                1 => 
                array (
                  'name_en' => 'Al Ain Industrial Area',
                  'name_local' => 'العين الصناعية',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8ee4afcdaf7e1cb9b0',
                ),
                2 => 
                array (
                  'name_en' => 'Al Jaheli',
                  'name_local' => 'الجهلي',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8ee4afcdaf7e1cb9b1',
                ),
                3 => 
                array (
                  'name_en' => 'Al Faqa\'a',
                  'name_local' => 'الفقع',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8ee4afcdaf7e1cb9b2',
                ),
                4 => 
                array (
                  'name_en' => 'Al Hili',
                  'name_local' => 'الهيلي',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8ee4afcdaf7e1cb9b3',
                ),
                5 => 
                array (
                  'name_en' => 'Al Khabisi',
                  'name_local' => 'الخبيصي',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8ee4afcdaf7e1cb9b4',
                ),
                6 => 
                array (
                  'name_en' => 'Al Jimi',
                  'name_local' => 'الجيمي',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8ee4afcdaf7e1cb9b5',
                ),
                7 => 
                array (
                  'name_en' => 'Al Manaseer',
                  'name_local' => 'المناصير',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8ee4afcdaf7e1cb9b6',
                ),
                8 => 
                array (
                  'name_en' => 'Al Maqam',
                  'name_local' => 'المقام',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8ee4afcdaf7e1cb9b7',
                ),
                9 => 
                array (
                  'name_en' => 'Al Markhaniya',
                  'name_local' => 'المرخانية',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8ee4afcdaf7e1cb9b8',
                ),
                10 => 
                array (
                  'name_en' => 'Al Murabaa',
                  'name_local' => 'المرابعة',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9b9',
                ),
                11 => 
                array (
                  'name_en' => 'Al Mutarad',
                  'name_local' => 'المطارد',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9ba',
                ),
                12 => 
                array (
                  'name_en' => 'Al Mutawaa',
                  'name_local' => 'المطوعة',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9bb',
                ),
                13 => 
                array (
                  'name_en' => 'Al Muwahie',
                  'name_local' => 'المواهي',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9bc',
                ),
                14 => 
                array (
                  'name_en' => 'Al Muwaiji',
                  'name_local' => 'المويجي',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9bd',
                ),
                15 => 
                array (
                  'name_en' => 'Al Neyadat',
                  'name_local' => 'النيادات',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9be',
                ),
                16 => 
                array (
                  'name_en' => 'Al Oyoun Village',
                  'name_local' => 'قرية العيون',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9bf',
                ),
                17 => 
                array (
                  'name_en' => 'Al Sinaiya',
                  'name_local' => 'السنية',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9c0',
                ),
                18 => 
                array (
                  'name_en' => 'Tawam',
                  'name_local' => 'توام',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9c1',
                ),
                19 => 
                array (
                  'name_en' => 'Wahat Al Zaweya',
                  'name_local' => 'واحة الزاوية',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9c2',
                ),
                20 => 
                array (
                  'name_en' => 'Zakher',
                  'name_local' => 'زاخر',
                  'city' => '6008179c731d75ae35f558bb',
                  'id' => '60082a8fe4afcdaf7e1cb9c3',
                ),
              ),
              'id' => '6008179c731d75ae35f558bb',
            ),
            4 => 
            array (
              'name_en' => 'Ajman',
              'name_local' => 'عجمان',
              'country' => 
              array (
                'name_en' => 'United Arab Emirates',
                'name_local' => 'الإمارات العربية المتحدة',
                'flag' => 
                array (
                  'name' => '1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                  'alternativeText' => '',
                  'caption' => '',
                  'hash' => '1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                  'ext' => '.png',
                  'mime' => 'image/png',
                  'size' => 4.92,
                  'width' => 1280,
                  'height' => 640,
                  'url' => '/uploads/1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                  'formats' => 
                  array (
                    'thumbnail' => 
                    array (
                      'name' => 'thumbnail_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 245,
                      'height' => 123,
                      'size' => 0.63,
                      'path' => NULL,
                      'url' => '/uploads/thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'large' => 
                    array (
                      'name' => 'large_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 1000,
                      'height' => 500,
                      'size' => 3.48,
                      'path' => NULL,
                      'url' => '/uploads/large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'medium' => 
                    array (
                      'name' => 'medium_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 750,
                      'height' => 375,
                      'size' => 2.42,
                      'path' => NULL,
                      'url' => '/uploads/medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'small' => 
                    array (
                      'name' => 'small_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 500,
                      'height' => 250,
                      'size' => 1.39,
                      'path' => NULL,
                      'url' => '/uploads/small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                  ),
                  'provider' => 'local',
                  'related' => 
                  array (
                    0 => '600814ac731d75ae35f558b3',
                    1 => '6036157085841c05d6b227ec',
                  ),
                  'id' => '600814a4731d75ae35f558b2',
                ),
                'city' => '6008185a731d75ae35f558bf',
                'id' => '600814ac731d75ae35f558b3',
              ),
              'areas' => 
              array (
                0 => 
                array (
                  'name_en' => 'Ajman Meadows',
                  'name_local' => 'مروج عجمان',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af3e4afcdaf7e1cb9c4',
                ),
                1 => 
                array (
                  'name_en' => 'Ajman Corniche Road',
                  'name_local' => 'كورنيش عجمان',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af3e4afcdaf7e1cb9c5',
                ),
                2 => 
                array (
                  'name_en' => 'Ajman Downtown',
                  'name_local' => 'عجمان وسط المدينة',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af3e4afcdaf7e1cb9c6',
                ),
                3 => 
                array (
                  'name_en' => 'Ain Ajman',
                  'name_local' => 'عين عجمان',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af3e4afcdaf7e1cb9c7',
                ),
                4 => 
                array (
                  'name_en' => 'Ajman Industrial Area',
                  'name_local' => 'المنطقة الصناعية',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af3e4afcdaf7e1cb9c8',
                ),
                5 => 
                array (
                  'name_en' => 'Al Amerah Village',
                  'name_local' => 'قرية العامرة',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9c9',
                ),
                6 => 
                array (
                  'name_en' => 'Ajman Uptown',
                  'name_local' => 'ضواحي عجمان',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9ca',
                ),
                7 => 
                array (
                  'name_en' => 'Al Bustan',
                  'name_local' => 'البستان',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9cb',
                ),
                8 => 
                array (
                  'name_en' => 'Al Hamidiya',
                  'name_local' => 'الحميدية',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9cc',
                ),
                9 => 
                array (
                  'name_en' => 'Al Humaid City',
                  'name_local' => 'مدينة الحميدية',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9cd',
                ),
                10 => 
                array (
                  'name_en' => 'Al Ittihad Village',
                  'name_local' => 'قرية الاتحاد',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9ce',
                ),
                11 => 
                array (
                  'name_en' => 'Al Mwaihat',
                  'name_local' => 'المويحات',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9cf',
                ),
                12 => 
                array (
                  'name_en' => 'Al Naemiyah',
                  'name_local' => 'النعيمية',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9d0',
                ),
                13 => 
                array (
                  'name_en' => 'Al Raqaib',
                  'name_local' => 'الرقيب',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9d1',
                ),
                14 => 
                array (
                  'name_en' => 'Al Rashidiya',
                  'name_local' => 'الراشدية',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9d2',
                ),
                15 => 
                array (
                  'name_en' => 'Al Rawda',
                  'name_local' => 'الروضة',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9d3',
                ),
                16 => 
                array (
                  'name_en' => 'Al Zorah',
                  'name_local' => 'الزهراء',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9d4',
                ),
                17 => 
                array (
                  'name_en' => 'Al Zahraa',
                  'name_local' => 'الزهراء',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9d5',
                ),
                18 => 
                array (
                  'name_en' => 'Al Sawan',
                  'name_local' => 'الصوان',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af4e4afcdaf7e1cb9d6',
                ),
                19 => 
                array (
                  'name_en' => 'Awali City',
                  'name_local' => 'مدينة عوالي',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9d7',
                ),
                20 => 
                array (
                  'name_en' => 'Al Rumaila',
                  'name_local' => 'الراشدية',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9d8',
                ),
                21 => 
                array (
                  'name_en' => 'Green City',
                  'name_local' => 'مدينة الحدائق',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9d9',
                ),
                22 => 
                array (
                  'name_en' => 'Manama',
                  'name_local' => 'المنامة',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9da',
                ),
                23 => 
                array (
                  'name_en' => 'Marmooka City',
                  'name_local' => 'مدينة مرموكة',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9db',
                ),
                24 => 
                array (
                  'name_en' => 'Musheiref',
                  'name_local' => 'مشيرف',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9dc',
                ),
                25 => 
                array (
                  'name_en' => 'Masfoot',
                  'name_local' => 'مصفوط',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9dd',
                ),
                26 => 
                array (
                  'name_en' => 'New Industrial Area',
                  'name_local' => 'المنطقة الصناعية الجديدة',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9de',
                ),
                27 => 
                array (
                  'name_en' => 'Park View City',
                  'name_local' => 'بارك فيو سيتي',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9df',
                ),
                28 => 
                array (
                  'name_en' => 'Sheikh Khalifa Bin Zayed Street',
                  'name_local' => 'شارع الشيخ خليفة بن زايد',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9e0',
                ),
                29 => 
                array (
                  'name_en' => 'Al Helio',
                  'name_local' => 'الحيلو',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9e1',
                ),
                30 => 
                array (
                  'name_en' => 'Al Jurf',
                  'name_local' => 'الجرف',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af5e4afcdaf7e1cb9e2',
                ),
                31 => 
                array (
                  'name_en' => 'Sheikh Maktoum Bin Rashid Rd',
                  'name_local' => 'شارع الشيخ مكتوم بن راشد',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af6e4afcdaf7e1cb9e3',
                ),
                32 => 
                array (
                  'name_en' => 'Al Amerah',
                  'name_local' => 'العامرة',
                  'city' => '600817c0731d75ae35f558bc',
                  'id' => '60082af6e4afcdaf7e1cb9e4',
                ),
              ),
              'id' => '600817c0731d75ae35f558bc',
            ),
            5 => 
            array (
              'name_en' => 'Ras Al Khaimah',
              'name_local' => 'راس الخيمة',
              'country' => 
              array (
                'name_en' => 'United Arab Emirates',
                'name_local' => 'الإمارات العربية المتحدة',
                'flag' => 
                array (
                  'name' => '1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                  'alternativeText' => '',
                  'caption' => '',
                  'hash' => '1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                  'ext' => '.png',
                  'mime' => 'image/png',
                  'size' => 4.92,
                  'width' => 1280,
                  'height' => 640,
                  'url' => '/uploads/1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                  'formats' => 
                  array (
                    'thumbnail' => 
                    array (
                      'name' => 'thumbnail_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 245,
                      'height' => 123,
                      'size' => 0.63,
                      'path' => NULL,
                      'url' => '/uploads/thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'large' => 
                    array (
                      'name' => 'large_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 1000,
                      'height' => 500,
                      'size' => 3.48,
                      'path' => NULL,
                      'url' => '/uploads/large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'medium' => 
                    array (
                      'name' => 'medium_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 750,
                      'height' => 375,
                      'size' => 2.42,
                      'path' => NULL,
                      'url' => '/uploads/medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'small' => 
                    array (
                      'name' => 'small_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 500,
                      'height' => 250,
                      'size' => 1.39,
                      'path' => NULL,
                      'url' => '/uploads/small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                  ),
                  'provider' => 'local',
                  'related' => 
                  array (
                    0 => '600814ac731d75ae35f558b3',
                    1 => '6036157085841c05d6b227ec',
                  ),
                  'id' => '600814a4731d75ae35f558b2',
                ),
                'city' => '6008185a731d75ae35f558bf',
                'id' => '600814ac731d75ae35f558b3',
              ),
              'areas' => 
              array (
                0 => 
                array (
                  'name_en' => 'Al Dhait',
                  'name_local' => 'الظيت',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829abe4afcdaf7e1cb910',
                ),
                1 => 
                array (
                  'name_en' => 'Al Huamra Village',
                  'name_local' => 'قرية الحمرا',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829abe4afcdaf7e1cb911',
                ),
                2 => 
                array (
                  'name_en' => 'Al Juwais',
                  'name_local' => 'الجويس',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829abe4afcdaf7e1cb912',
                ),
                3 => 
                array (
                  'name_en' => 'Al Ghubb',
                  'name_local' => 'الغب',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829abe4afcdaf7e1cb913',
                ),
                4 => 
                array (
                  'name_en' => 'Al Huamra',
                  'name_local' => 'الحمرا',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829abe4afcdaf7e1cb914',
                ),
                5 => 
                array (
                  'name_en' => 'Al Mamourah',
                  'name_local' => 'المعمورة',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb915',
                ),
                6 => 
                array (
                  'name_en' => 'Al Marjan Island',
                  'name_local' => 'جزيرة المرجان',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb916',
                ),
                7 => 
                array (
                  'name_en' => 'Al Nakheel',
                  'name_local' => 'النخيل',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb917',
                ),
                8 => 
                array (
                  'name_en' => 'Al Qusaidat',
                  'name_local' => 'القصيدات',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb918',
                ),
                9 => 
                array (
                  'name_en' => 'Al Uraibi',
                  'name_local' => 'العريبي',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb919',
                ),
                10 => 
                array (
                  'name_en' => 'Al kornish',
                  'name_local' => 'كورنيش راس الخيمة',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb91a',
                ),
                11 => 
                array (
                  'name_en' => 'Dana Island',
                  'name_local' => 'جزيرة الدانة',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb91b',
                ),
                12 => 
                array (
                  'name_en' => 'Julfa',
                  'name_local' => 'جلفار',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb91c',
                ),
                13 => 
                array (
                  'name_en' => 'Khuzam',
                  'name_local' => 'خزام',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb91d',
                ),
                14 => 
                array (
                  'name_en' => 'Mina Al Arab',
                  'name_local' => 'ميناء العرب راس الخيمة',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb91e',
                ),
                15 => 
                array (
                  'name_en' => 'PAK FTZ',
                  'name_local' => 'المنطقة التجارية الحرة',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ace4afcdaf7e1cb91f',
                ),
                16 => 
                array (
                  'name_en' => 'PAK Industrial And Technology Park',
                  'name_local' => 'واحة التكنولوجيا',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ade4afcdaf7e1cb920',
                ),
                17 => 
                array (
                  'name_en' => 'Creek',
                  'name_local' => 'خليج راس الخيمة',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ade4afcdaf7e1cb921',
                ),
                18 => 
                array (
                  'name_en' => 'Gateway',
                  'name_local' => 'راس الخيمة جيتواي',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ade4afcdaf7e1cb922',
                ),
                19 => 
                array (
                  'name_en' => 'Waterfront',
                  'name_local' => 'الواجهة المائية',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ade4afcdaf7e1cb923',
                ),
                20 => 
                array (
                  'name_en' => 'Saraya Islands',
                  'name_local' => 'جزر سرايا',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ade4afcdaf7e1cb924',
                ),
                21 => 
                array (
                  'name_en' => 'Sheikh Mohammad Bin Zayed Road',
                  'name_local' => 'شارع الشيخ محمد بن زايد',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ade4afcdaf7e1cb925',
                ),
                22 => 
                array (
                  'name_en' => 'Sidroh',
                  'name_local' => 'سدورة',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ade4afcdaf7e1cb926',
                ),
                23 => 
                array (
                  'name_en' => 'Yasmin Village',
                  'name_local' => 'قرية الياسمين',
                  'city' => '6008180d731d75ae35f558bd',
                  'id' => '600829ade4afcdaf7e1cb927',
                ),
              ),
              'id' => '6008180d731d75ae35f558bd',
            ),
            6 => 
            array (
              'name_en' => 'Um Al Quwain',
              'name_local' => 'ام القوين',
              'country' => 
              array (
                'name_en' => 'United Arab Emirates',
                'name_local' => 'الإمارات العربية المتحدة',
                'flag' => 
                array (
                  'name' => '1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                  'alternativeText' => '',
                  'caption' => '',
                  'hash' => '1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                  'ext' => '.png',
                  'mime' => 'image/png',
                  'size' => 4.92,
                  'width' => 1280,
                  'height' => 640,
                  'url' => '/uploads/1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                  'formats' => 
                  array (
                    'thumbnail' => 
                    array (
                      'name' => 'thumbnail_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 245,
                      'height' => 123,
                      'size' => 0.63,
                      'path' => NULL,
                      'url' => '/uploads/thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'large' => 
                    array (
                      'name' => 'large_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 1000,
                      'height' => 500,
                      'size' => 3.48,
                      'path' => NULL,
                      'url' => '/uploads/large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'medium' => 
                    array (
                      'name' => 'medium_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 750,
                      'height' => 375,
                      'size' => 2.42,
                      'path' => NULL,
                      'url' => '/uploads/medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'small' => 
                    array (
                      'name' => 'small_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 500,
                      'height' => 250,
                      'size' => 1.39,
                      'path' => NULL,
                      'url' => '/uploads/small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                  ),
                  'provider' => 'local',
                  'related' => 
                  array (
                    0 => '600814ac731d75ae35f558b3',
                    1 => '6036157085841c05d6b227ec',
                  ),
                  'id' => '600814a4731d75ae35f558b2',
                ),
                'city' => '6008185a731d75ae35f558bf',
                'id' => '600814ac731d75ae35f558b3',
              ),
              'areas' => 
              array (
                0 => 
                array (
                  'name_en' => 'Al Dar Al Baidaa',
                  'name_local' => 'الدار البيضاء',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '60082119e4afcdaf7e1cb8ac',
                ),
                1 => 
                array (
                  'name_en' => 'Al Kaber',
                  'name_local' => 'منطقة الكابر',
                  'city' => '60081837731d75ae35f558be',
                  'store' => '601f0ab685d95e5383acfb8e',
                  'stores' => 
                  array (
                    0 => '6047212c82ed8f364144f797',
                    1 => '6036157085841c05d6b227ec',
                    2 => '601f0ab685d95e5383acfb8e',
                  ),
                  'id' => '60082119e4afcdaf7e1cb8ad',
                ),
                2 => 
                array (
                  'name_en' => 'Al Aahad',
                  'name_local' => 'الآحاد',
                  'city' => '60081837731d75ae35f558be',
                  'stores' => 
                  array (
                    0 => '6047212c82ed8f364144f797',
                  ),
                  'id' => '60082119e4afcdaf7e1cb8ae',
                ),
                3 => 
                array (
                  'name_en' => 'Al Haditha',
                  'name_local' => 'الحديثة',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '60082119e4afcdaf7e1cb8af',
                ),
                4 => 
                array (
                  'name_en' => 'Al Humra',
                  'name_local' => 'الحمرة',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '60082119e4afcdaf7e1cb8b0',
                ),
                5 => 
                array (
                  'name_en' => 'Al Khor',
                  'name_local' => 'الخور',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '60082119e4afcdaf7e1cb8b1',
                ),
                6 => 
                array (
                  'name_en' => 'Al Raas',
                  'name_local' => 'الراس',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '60082119e4afcdaf7e1cb8b2',
                ),
                7 => 
                array (
                  'name_en' => 'Al Ramla',
                  'name_local' => 'الرملة',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '60082119e4afcdaf7e1cb8b3',
                ),
                8 => 
                array (
                  'name_en' => 'Al Raudah',
                  'name_local' => 'الروضة',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '60082119e4afcdaf7e1cb8b4',
                ),
                9 => 
                array (
                  'name_en' => 'Al Maidan',
                  'name_local' => 'الميدان',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '60082119e4afcdaf7e1cb8b5',
                ),
                10 => 
                array (
                  'name_en' => 'Al Riqqa',
                  'name_local' => 'الرقة',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '6008211ae4afcdaf7e1cb8b6',
                ),
                11 => 
                array (
                  'name_en' => 'Al Salam City',
                  'name_local' => 'مدينة السلام',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '6008211ae4afcdaf7e1cb8b7',
                ),
                12 => 
                array (
                  'name_en' => 'Al Salamah',
                  'name_local' => 'ضاحية السلام',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '6008211ae4afcdaf7e1cb8b8',
                ),
                13 => 
                array (
                  'name_en' => 'Al Surra',
                  'name_local' => 'السرة',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '6008211ae4afcdaf7e1cb8b9',
                ),
                14 => 
                array (
                  'name_en' => 'Emirates Modern Industrial',
                  'name_local' => 'منطقة الامارات الصناعية الحديثة',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '6008211ae4afcdaf7e1cb8ba',
                ),
                15 => 
                array (
                  'name_en' => 'Moalla',
                  'name_local' => 'فلج المعلا',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '6008211ae4afcdaf7e1cb8bb',
                ),
                16 => 
                array (
                  'name_en' => 'Beidah',
                  'name_local' => 'خور البيضاء',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '6008211ae4afcdaf7e1cb8bc',
                ),
                17 => 
                array (
                  'name_en' => 'Old Induustrial Area',
                  'name_local' => 'المنطقة الصناعية القديمة',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '6008211ae4afcdaf7e1cb8bd',
                ),
                18 => 
                array (
                  'name_en' => 'Marina',
                  'name_local' => 'مارينا ام القوين',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '6008211ae4afcdaf7e1cb8be',
                ),
                19 => 
                array (
                  'name_en' => 'White Bay',
                  'name_local' => 'الخليج الابيض',
                  'city' => '60081837731d75ae35f558be',
                  'id' => '6008211ae4afcdaf7e1cb8bf',
                ),
              ),
              'id' => '60081837731d75ae35f558be',
            ),
            7 => 
            array (
              'name_local' => 'الفجيرة',
              'name_en' => 'Fujairah',
              'country' => 
              array (
                'name_en' => 'United Arab Emirates',
                'name_local' => 'الإمارات العربية المتحدة',
                'flag' => 
                array (
                  'name' => '1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                  'alternativeText' => '',
                  'caption' => '',
                  'hash' => '1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                  'ext' => '.png',
                  'mime' => 'image/png',
                  'size' => 4.92,
                  'width' => 1280,
                  'height' => 640,
                  'url' => '/uploads/1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                  'formats' => 
                  array (
                    'thumbnail' => 
                    array (
                      'name' => 'thumbnail_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 245,
                      'height' => 123,
                      'size' => 0.63,
                      'path' => NULL,
                      'url' => '/uploads/thumbnail_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'large' => 
                    array (
                      'name' => 'large_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 1000,
                      'height' => 500,
                      'size' => 3.48,
                      'path' => NULL,
                      'url' => '/uploads/large_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'medium' => 
                    array (
                      'name' => 'medium_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 750,
                      'height' => 375,
                      'size' => 2.42,
                      'path' => NULL,
                      'url' => '/uploads/medium_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                    'small' => 
                    array (
                      'name' => 'small_1280px-Flag_of_the_United_Arab_Emirates.svg.png',
                      'hash' => 'small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4',
                      'ext' => '.png',
                      'mime' => 'image/png',
                      'width' => 500,
                      'height' => 250,
                      'size' => 1.39,
                      'path' => NULL,
                      'url' => '/uploads/small_1280px_Flag_of_the_United_Arab_Emirates_svg_318837c3c4.png',
                    ),
                  ),
                  'provider' => 'local',
                  'related' => 
                  array (
                    0 => '600814ac731d75ae35f558b3',
                    1 => '6036157085841c05d6b227ec',
                  ),
                  'id' => '600814a4731d75ae35f558b2',
                ),
                'city' => '6008185a731d75ae35f558bf',
                'id' => '600814ac731d75ae35f558b3',
              ),
              'areas' => 
              array (
                0 => 
                array (
                  'name_en' => 'Sharm',
                  'name_local' => 'شرم',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '600829ffe4afcdaf7e1cb928',
                ),
                1 => 
                array (
                  'name_en' => 'Faseel',
                  'name_local' => 'الفصيل',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '600829ffe4afcdaf7e1cb929',
                ),
                2 => 
                array (
                  'name_en' => 'Fujairah Freezone',
                  'name_local' => 'المنطقة الحرة',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '600829ffe4afcdaf7e1cb92a',
                ),
                3 => 
                array (
                  'name_en' => 'Gurfah',
                  'name_local' => 'الغرفة',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '600829ffe4afcdaf7e1cb92b',
                ),
                4 => 
                array (
                  'name_en' => 'Sakamkam',
                  'name_local' => 'سكمكم',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '60082a00e4afcdaf7e1cb92c',
                ),
                5 => 
                array (
                  'name_en' => 'Saniaya',
                  'name_local' => 'سنايا',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '60082a00e4afcdaf7e1cb92d',
                ),
                6 => 
                array (
                  'name_en' => 'Merashid',
                  'name_local' => 'مراشد',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '60082a00e4afcdaf7e1cb92e',
                ),
                7 => 
                array (
                  'name_en' => 'Corniche Fujairah',
                  'name_local' => 'كورنيش الفجيرة',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '60082a00e4afcdaf7e1cb92f',
                ),
                8 => 
                array (
                  'name_en' => 'Deba Fujairah',
                  'name_local' => 'دبا',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '60082a00e4afcdaf7e1cb930',
                ),
                9 => 
                array (
                  'name_en' => 'Downtown Fujairah',
                  'name_local' => 'وسط المدينة',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '60082a00e4afcdaf7e1cb931',
                ),
                10 => 
                array (
                  'name_en' => 'Sheikh Hamad Bin Abdullah St',
                  'name_local' => 'شارع الشيخ حمد بن عبدالله',
                  'city' => '600828aee4afcdaf7e1cb8cb',
                  'id' => '60082a00e4afcdaf7e1cb932',
                ),
              ),
              'id' => '600828aee4afcdaf7e1cb8cb',
            ),
        ];

        $cities_array =  [];
        foreach ($cites as $city){
            $data = [
                'name'=>$city['name_en'], 
                'name_local'=>$city['name_local'],
                'country_id'=>1
            ];

            City::create(['name'=>$city['name_en'], 
            'name_local'=>$city['name_local'],
            'country_id'=>1])->save();
            // array_push($cities_array , $data);
        };
        // $fp = fopen('D://results.json', 'w');
        // fwrite($fp, json_encode($cities_array ,JSON_UNESCAPED_UNICODE));
        // fclose($fp);

        print_r('done');
    }
}
