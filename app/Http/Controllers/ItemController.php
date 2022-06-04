<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Item;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Compulsory_choice;
use App\Models\Multiple_choice;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        
        //
        // $items = Item::where('store_id' , $store->id)->get();
        //check for stores
        // $items = Item::all();
        // dd($items );
        if ($request->ajax()) {
            $items = Item::leftJoin('categories', 'categories.id', '=', 'items.sub_category_id')
            ->get(['items.id as id','items.main_screen_image as main_screen_image','items.name as name','categories.name as sub_category_name','items.price as price' ,'items.new_price as new_price','items.in_stock as in_stock']);

            return DataTables::of($items)->addIndexColumn()
            ->addColumn('action', 'items.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    
        $page_title = 'Items';
        $page_description = `This page is to show Items table`;

        return view('items.index', compact('page_title', 'page_description' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $stores = Store::all();
        $x= 0;
        if($stores->count() == 0 ){
        // if($x == 0 ){
            return view('items.store_error');

        }

        // $categories = Category::all();
        $attributes = Attribute::all();
        $compulsory_choices = Compulsory_choice::all();
        $multipule_choices = Multiple_choice::all();

        $page_title = 'Add New Item';
        $page_description = 'This page is to add new item';

        return view('items.create', compact('page_title', 'page_description','stores' , 'attributes' ,'compulsory_choices' ,'multipule_choices' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        
    //    print_r('<pre>');
    //    var_dump( $request->file());
    //    var_dump( $request->all());
    //    exit;
        //validate

        $input =$request->all();

        //check if is open checked     
        $input['in_stock'] = isset($request->in_stock) ? true : false;

        if ($image = $request->file('main_screen_image')) {
            $destinationPath = 'uploads/items/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['main_screen_image'] = "$recordImage";
        }

        if ($image = $request->file('cover_image')) {
            $destinationPath = 'uploads/items/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['cover_image'] = "$recordImage";
        }
        // $input['store_id'] = $store->id;
       
        //save item
        $item = Item::Create($input);

        //save many to many relations
        if(!empty($input['attributes'])){
            $item->attributes()->attach( $input['attributes']);
        }
        if(!empty($input['compulsory_choices'])){
            $item->compulsoryChoices()->attach( $input['compulsory_choices']);
        }
        if(!empty($input['multipule_choices'])){
            $item->multipleChoices()->attach( $input['multipule_choices']);
        }
    
       

        return redirect()->action([self::class, 'index'])
        ->with('success','Item created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Item $item)
    {
        $stores = Store::all();
        $attributes = Attribute::all();
        $compulsory_choices = Compulsory_choice::all();
        $multipule_choices = Multiple_choice::all();

        $page_title = 'Edit Item';
        
        $page_description = 'This page is to edit item details';
        //
        return view('items.edit',compact('item', 'page_title', 'page_description','stores' , 'attributes' ,'compulsory_choices' ,'multipule_choices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        
        $input =$request->all();

        //check if is open checked     
        $input['in_stock'] = isset($request->in_stock) ? true : false;

       
        if ($image = $request->file('main_screen_image')) {
            $destinationPath = 'uploads/items/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['main_screen_image'] = "$recordImage";
        }else{
            unset($input['main_screen_image']);
        }
        
        if ($image = $request->file('cover_image')) {
            $destinationPath = 'uploads/items/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['cover_image'] = "$recordImage";
        }else{
            unset($input['cover_image']);
        }

        $item->update($input);

        //save many to many relations 
        
        if(!empty($input['attributes'])){
            $item->attributes()->detach();
            $item->attributes()->attach( $input['attributes']);
        }
        if(!empty($input['compulsory_choices'])){
            $item->compulsoryChoices()->detach();
            $item->compulsoryChoices()->attach( $input['compulsory_choices']);
        }
        if(!empty($input['multipule_choices'])){
            $item->multipleChoices()->detach();
            $item->multipleChoices()->attach( $input['multipule_choices']);
        }

        return redirect()->action([self::class, 'index'])
        ->with('success','Item updated successfully.');

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
