<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Item;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Compulsory_choice;
use App\Models\Multiple_choice;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Store $store)
    {
        //
        $items = Item::where('store_id' , $store->id)->get();
        $page_title = $store->name.' - '.'Items';
        $page_description = `This page is to show $store->name Items table`;

        return view('items.index', compact('page_title', 'page_description' ,'items' , 'store'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Store $store)
    {
        
        $categories = Category::all();
        $attributes = Attribute::all();
        $compulsory_choices = Compulsory_choice::all();
        $multipule_choices = Multiple_choice::all();
        $page_title = 'Add New Item';
        $page_description = 'This page is to add new item for store '.$store->name;

        return view('items.create', compact('page_title', 'page_description','store','categories' , 'attributes' ,'compulsory_choices' ,'multipule_choices' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $store)
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
        $input['store_id'] = $store->id;
        //save item
        //save item
        $item = Item::Create($input);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
