<?php

namespace App\Http\Controllers;

use App\Models\Content_type;
use Illuminate\Http\Request;
use App\Models\Home;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use App\Models\Category;

class HomeController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Home::all();
         
        

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', 'home.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $page_title = 'Home';
        $page_description = 'This page is to show all the records in home table';

        return view('home.index', compact('page_title', 'page_description'));
    }

  

    public function create() {
        $page_title = 'Add New Home record';
        $page_description = 'This page is to add new record in Home table';

        $content_types = Content_type::all();
        
        return view('home.create', compact('page_title', 'page_description' ,'content_types'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        
        $request->validate([
            'content_type_id' => ['required',], //not null
            'appearance_number' => ['required', ], //not null
            // 'sub_category_id' => ['required'], // nullable
            // 'item_id' => ['required',],// nullable
            // 'category_id' => ['required',],// nullable
            // 'offer_id' => ['required',],// nullable
            // 'disposition' => ['required'] // uniqe  - order in main home disposition
        ]);       



        Home::create($request->all());

        return redirect()->action([HomeController::class, 'index'])
                        ->with('success','home record created successfully.');
    }

    public function edit() {

    }
    
    public function update() {

    }
    public function destroy() {

    }


}
