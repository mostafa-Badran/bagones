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


    
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function get_city_select_list(Request $request)
    {
        // dd($request);
        // if ($request->ajax()) {
        $search = $request->search;
        $country_id = $request->country_id;

        if($search == ''){
           $cities = City::orderby('name','asc')
           ->select('id','name')
           ->where('country_id' , $country_id)
           ->get();
        }else{
           $cities = City::orderby('name','asc')->select('id','name')
           ->where('name', 'like', '%' .$search . '%')
           ->where('country_id' , $country_id)           
           ->get();
        }

        $response = array();
        foreach($cities as $city){
           $response[] = array(
                "id"=>$city->id,
                "text"=>$city->name
           );
        }
        return response()->json($response);
        // return response()->json("HHHHHHHHHH");
    // }
    
    }

}
