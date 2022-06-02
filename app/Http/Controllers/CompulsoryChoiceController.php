<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Attribute_entry;
use App\Models\CompulsoryChoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Compulsory_choice;

class CompulsoryChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('compulsory_choices as a')
            ->select('a.id','a.name','a.name_locale','a.description','a.description_locale')
            ->get();
            return DataTables::of($data)->make(true);
        }

        $page_title = 'Compulsory Choices';
        $page_description = 'This page is to show all the records in Compulsory Choices table';

        return view('compulsory_choices.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
       
        $page_title = 'Add New Compulsory Choice';
        $page_description = 'This page is to add new record in Compulsory Choice table';
        
        return view('compulsory_choices.create', compact('page_title', 'page_description'));
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

        Compulsory_choice::create($request->all());

        return redirect()->action([self::class, 'index'])
                        ->with('success','Compulsory_choice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Attribute  $attribute
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Compulsory_choice $compulsory_choice)
    {
        
        $page_title = 'Show Compulsory Choice';
        $page_description = 'This page is to Show compulsory choice details';
        //
        return view('compulsory_choices.show',compact('compulsory_choice', 'page_title', 'page_description'));
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
