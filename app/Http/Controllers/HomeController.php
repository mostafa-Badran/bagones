<?php

namespace App\Http\Controllers;

use App\Models\Content_type;
use Illuminate\Http\Request;
use App\Models\Home;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

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

            $data = Home::leftJoin('content_types' , 'homes.content_type_id','=','content_types.id')
            ->leftJoin('categories' , 'homes.sub_category_id','=','categories.id')
            ->leftJoin('items' , 'homes.item_id','=','items.id')
            ->leftJoin('appearances' , 'homes.appearance_number','=','appearances.id')
            ->get(['homes.id','content_types.name as content_type', 'appearances.number as appearance_number' , 'categories.name as sub_category_name' , 'items.name as item_name']);
         
            // dd($data->toSql());

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

      /**
     * Display the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home)
    {
       
        $page_title = 'Show Home  Record';
        $page_description = 'This page is to show Home record details';
        //
        return view('home.show',compact('home', 'page_title', 'page_description'));
    }

    public function edit(Home $home) {
        $content_types = Content_type::all();
        // $appearances = $home->content_type->appearances;
        $page_title = 'Edit Home';
        $page_description = 'This page is to edit record in Home table';
        
        return view('home.edit',compact('home', 'page_title', 'page_description' , 'content_types'));
    }
    
    function update(Request $request, Home $home){
        // dd($request->all());
        $request->validate([
            'content_type_id' => ['required',], //not null
            'appearance_number' => ['required', ], //not null
        ]);
       
        $input = $request->all();
        if( empty($input['item_id'])){
            $input['item_id']=null;
        }
        if( empty($input['sub_category_id'])){ 
            $input['sub_category_id']=null;
        }
    
        $home->update($input);
       
        return redirect()->action([HomeController::class, 'index'])
                        ->with('success','Home record updated successfully');
    }
    public function destroy(Request $request) {
        $com = Home::where('id',$request->id)->delete();
        return Response()->json($com);
    }


}
