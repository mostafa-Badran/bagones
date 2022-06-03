<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Attribute_entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('attributes as a')
            ->select('a.id','a.name','a.name_locale')
            ->get();
            return DataTables::of($data)->make(true);
        }

        $page_title = 'attributes';
        $page_description = 'This page is to show all the records in attributes table';

        return view('attributes.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
       
        $page_title = 'Add New Attribute';
        $page_description = 'This page is to add new record in attribute table';
        
        return view('attributes.create', compact('page_title', 'page_description'));
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
        ]);

        
        DB::beginTransaction();
        try {

            $attribute_input = [
                'name'=> $request->input('name'),
                'name_locale'=>$request->input('name_locale'),
            ] ;
            
            $attribute  = Attribute::create($attribute_input);    
            //adding Attribute Components
            $entry_names = $request->input('entry_name'); // input array
            $entry_name_locales = $request->input('entry_name_locale');// input array
            $attribute_components=[];
            foreach ($entry_names as $key => $name) {
                $data = [
                    'name'=>$name,
                    'name_locale'=> $entry_name_locales[$key],
                    'attribute_id'=>$attribute->id
                ];
               array_push($attribute_components ,$data );
               
            }
           
            Attribute_entry::insert($attribute_components);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->action([self::class, 'create'])
            ->with('error','Error Creating Attribute.');
        }
        
        return redirect()->action([self::class, 'index'])
                        ->with('success','Attribure created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Attribute  $attribute
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Attribute $attribute)
    {
        
        $page_title = 'Show Attribute';
        $page_description = 'This page is to Show attribute details';
        //
        return view('attributes.show',compact('attribute', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $page_title = 'Edit Attribute';
        $page_description = 'This page is to Edit attribute details';
        //
        return view('attributes.edit',compact('attribute', 'page_title', 'page_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   Attribute $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Attribute $attribute)
    {
        $request->validate([
            'name' => ['required',  'max:255'],
            'name_locale' => ['required', 'max:255'],
        ]);

        DB::beginTransaction();
        try {
        $attribute_input = [
            'name'=> $request->input('name'),
            'name_locale'=>$request->input('name_locale'),
        ] ;
        
   
        $attribute->update($attribute_input);


        //adding Attribute Components
        $entry_names = $request->input('entry_name'); // input array
        $entry_name_locales = $request->input('entry_name_locale');// input array
        $attribute_components=[];
        foreach ($entry_names as $key => $name) {
            $data = [
                'name'=>$name,
                'name_locale'=> $entry_name_locales[$key],
                'attribute_id'=>$attribute->id
            ];
            array_push($attribute_components ,$data );
            
        }
        //delete previous entries
        Attribute_entry::where('attribute_id' , $attribute->id)->delete();
        //insert new entries
        Attribute_entry::insert($attribute_components);
        
        DB::commit();
        // all good
    } catch (\Exception $e) {
        DB::rollback();
        // something went wrong
        return redirect()->action([self::class, 'create'])
        ->with('error','Error Creating Attribute.');
    }
    
    return redirect()->action([self::class, 'index'])
                    ->with('success','Attribure created successfully.');
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
