<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appearance;
use App\Models\Content_type;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;


class AppearanceController extends Controller
{
    protected $namespace = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            
            $data = Appearance::join('content_types', 'appearances.content_type_id', '=', 'content_types.id')              	
              		->get(['appearances.id', 'appearances.number','content_types.name as content_type']);
            
            return DataTables::of($data)->addIndexColumn()            
                ->addColumn('action', 'appearances.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $page_title = 'Appearances';
        $page_description = 'This page is to show all the records in appearance table';

        return view('appearances.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $content_types = Content_type::all();
        $page_title = 'Add New Appearance';
        $page_description = 'This page is to add new record in appearance table';

        return view('appearances.create', compact('page_title', 'page_description' , 'content_types'));
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
            'number' => ['required', 'unique:appearances'],
            'content_type_id' => ['required'],
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        // if ($image = $request->file('image')) {
        //     $destinationPath = 'uploads/appearance/';
        //     $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $recordImage);
        //     $input['image'] = "$recordImage";
        // }

        Appearance::create($input);

        return redirect()->action([AppearanceController::class, 'index'])
                        ->with('success','Appearance created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appearance  $appearance
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Appearance $appearance)
    {
        $page_title = 'Show Appearance';
        $page_description = 'This page is to show appearance details';
        //
        return view('appearances.show',compact('appearance', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appearance  $appearance
     * @return \Illuminate\Contracts\View\View
     */
    public function edit( $id)
    {
        $appearance = Appearance::find($id);
        // dd( $appearance ->number);
        
        $content_types = Content_type::all();
        $page_title = 'Edit Appearance';
        $page_description = 'This page is to edit record in appearance table';
        //
        return view('appearances.edit',compact('appearance','content_types', 'page_title', 'page_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appearance  $appearance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appearance $appearance)
    {
        //
        // $request->validate([
        //     'type' => ['required', Rule::unique('appearances', 'type')->ignore($appearance), 'max:50'],
        // ]);

        $appearance->update($request->all());

        return redirect()->action([self::class, 'index'])
                        ->with('success','Appearance updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appearance  $appearance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $com = Appearance::where('id',$request->id)->delete();
        return Response()->json($com);
    }
}
