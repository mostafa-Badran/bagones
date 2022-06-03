<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
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

            $data = Category::select('id','name','name_locale','image', 'parent_id' )
            ->where('parent_id', null) //select main categories
            ->get();
           
            $results = [];
            foreach($data as $category){
                // $country->image = env('APP_URL') . '/uploads/country/' . $country->image;
                $category->image = asset('uploads/category/' . $category->image);
                array_push($results, $category);
            }

            return DataTables::of($results)->addIndexColumn()
                ->addColumn('action', 'categories.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $page_title = 'Categories';
        $page_description = 'This page is to show all the records in category table';

        return view('categories.index', compact('page_title', 'page_description'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::all();
        $page_title = 'Add New Category';
        $page_description = 'This page is to add new record in category table';

        //
        return view('categories.create', compact('page_title', 'page_description' ));
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
            'name' => ['required', 'unique:categories', 'max:50'],
            'name_locale' => ['required', 'unique:categories', 'max:50'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);
        $input = $request->all();
     
  
    if ($image = $request->file('image')) {
        $destinationPath = 'uploads/category/';
        $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $recordImage);
        $input['image'] = "$recordImage";
    }


        Category::create($input);
        return redirect()->action([CategoryController::class, 'index'])->with('success','Category created successfully.');;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category = Category::find($category->id);
        $page_title = 'Show Category';
        $page_description = 'This page is to show category details';
        //
        return view('categories.show',compact('category', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = Category::find($category->id);
        $page_title = 'Edit Category';
        $page_description = 'This page is to edit record in category table';
        //
        return view('categories.edit',compact('category', 'page_title', 'page_description','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        // dd($request);
        $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')->ignore($category), 'max:50'],
            'name_locale' => [Rule::unique('categories', 'name_locale')->ignore($category), 'max:50'],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'uploads/category/';
            $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $recordImage);
            $input['image'] = "$recordImage";
        }else{
            unset($input['image']);
        }
        // dd($request);
        $category->update($input);
       
        return redirect()->action([CategoryController::class, 'index'])
                        ->with('success','Category updated successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $com = Category::where('id',$request->id)->delete();
        return Response()->json($com);
    }

    public function dataAjax(Request $request)
    {
        
        $search = $request->search;

        if($search == ''){
           $categories = Category::where('parent_id', null)->orderby('name','asc')->select('id','name')->limit(5)->get();
        }else{
           $categories = Category::where('parent_id', null)->orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
        }

        // $response = array();
        foreach($categories as $category){
           $response[] = array(
                "id"=>$category->id,
                "text"=>$category->name
           );
        }
        return response()->json($response);
    }





    

   
}
