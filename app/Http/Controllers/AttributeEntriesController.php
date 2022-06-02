<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Attribute_entry;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AttributeEntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('attribute_entries as a')
            ->leftjoin('attributes', 'attributes.id', '=', 'a.attribute_id')
            ->select('a.id','a.name','a.name_locale','attributes.name as attribute')
            ->get();
            return DataTables::of($data)->make(true);
        }

        $page_title = 'Attributes Entries';
        $page_description = 'This page is to show all the records in attributes entries table';

        return view('attributes_entries.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        //get attributes
        $attributes = Attribute::all();
        $page_title = 'Add New Attribute Entry';
        $page_description = 'This page is to add new record in attribute entry table';
        
        // return view('attributes_entries.store', compact('page_title', 'page_description','attributes'));
        return view('attributes_entries.store', compact('page_title', 'page_description','attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required',  'max:255'],
            'name_locale' => ['required', 'max:255'],
            'attribute_id' => ['required'],
        ]);

        Attribute_entry::create($request->all());

        return redirect()->action([self::class, 'index'])
                        ->with('success','Attribure created successfully.');
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
