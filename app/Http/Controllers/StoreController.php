<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreaStore;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Store;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $stores = Store::all();
        if ($request->ajax()) {

            $data = DB::table('stores')
            ->join('areas', 'areas.id', '=', 'stores.area_id')
            ->select('stores.*','areas.name as area_name_en','areas.name_local as area_name_local')
            ->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', 'stores.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $page_title = 'Stores';
        $page_description = 'This page is to show all the records in store table';

        return view('stores.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $countries = Country::all();
        $page_title = 'Add New Store';
        $page_description = 'This page is to add new record in Stores table';

        return view('stores.create', compact('page_title', 'page_description','countries'));


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
        // dd($request->all());
        $request->validate([
            'name_locale' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'slogan' => ['required', 'max:255'],
            'slogan_locale' => ['required', 'max:255'],
            'location_text' => ['required', 'max:255'],
            'location_text_locale' => ['required', 'max:255'],
            'phone_number' => ['required', 'max:255'],
            'delivery_time_range' => ['required', 'max:255'],
            'google_map_link' => ['required'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         
        ]);


        $input = $request->all();

        //fixed id
           $input['area_id'] = 1;

        //check if is open checked 
        
            $input['is_open'] = isset($request->is_open) ? true : false;
     
        
       
        //check if allow hot price checked
  
            $input['allow_add_hot_price'] = isset($request->allow_add_hot_price) ? true : false;
       

        
        

        

        if ($image = $request->file('image')) {
            $destinationPath = 'uploads/stores/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['image'] = "$recordImage";
        }
        if ($image = $request->file('cover_image')) {
            $destinationPath = 'uploads/stores/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['cover_image'] = "$recordImage";
        }
         //create new store
       

         //add store areas
         $store = Store::create($input);
         $store->deliveryAreas()->attach( $input['areas']);
        


        
        return redirect()->action([StoreController::class, 'index'])
                        ->with('success','Store created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     */
    public function show(Store $store)
    {
        $page_title = 'Show Store';
        $page_description = 'This page is to show state details';
        
        return view('stores.show',compact('store', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $countries = Country::all();
        $page_title = 'Edit Store';
        $page_description = 'This page is to edit state details';
        return view('stores.edit',compact('store', 'page_title', 'page_description' , 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name_locale' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'slogan' => ['required', 'max:255'],
            'slogan_locale' => ['required', 'max:255'],
            'location_text' => ['required', 'max:255'],
            'location_text_locale' => ['required', 'max:255'],
            'phone_number' => ['required', 'max:255'],
            'delivery_time_range' => ['required', 'max:255'],
            'google_map_link' => ['required'],
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         
        ]);
        $input = $request->all();

        //fixed id
           $input['area_id'] = 1;

        //check if is open checked 
        
            $input['is_open'] = isset($request->is_open) ? true : false;
     
        
       
        //check if allow hot price checked
  
            $input['allow_add_hot_price'] = isset($request->allow_add_hot_price) ? true : false;
       

        
        

        

        if ($image = $request->file('image')) {
            $destinationPath = 'uploads/stores/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['image'] = "$recordImage";
        }else{
            unset($input['image']);
        }
        if ($image = $request->file('cover_image')) {
            $destinationPath = 'uploads/stores/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['cover_image'] = "$recordImage";
        }else{
            unset($input['cover_image']);
        }
         //create new store
       

         //add store areas
          $store->update($input);
          //delete old area records 
          $store->deliveryAreas()->detach();
        //   AreaStore::where('store_id' ,$store->id )->delete();
          $store->deliveryAreas()->attach( $input['areas']);
          return redirect()->action([StoreController::class, 'index'])
          ->with('success','Store updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
