<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\City;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SubCategoryController extends Controller
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
            ->where('parent_id','!=', 0) //select sub categories
            ->get();
            // dd($data);
            $results = [];
            foreach($data as $category){
                $category->image = asset('uploads/category/' . $category->image);
                array_push($results, $category);
            }

            return DataTables::of($results)->addIndexColumn()
                ->addColumn('action', 'subCategories.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $page_title = 'Sub Categories';
        $page_description = 'This page is to show all the records in subCategory table';

        return view('subCategories.index', compact('page_title', 'page_description'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $page_title = 'Add New Sub Category';
        $page_description = 'This page is to add new record in category table';

        
        return view('subCategories.create', compact('page_title', 'page_description' ));
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
            'parent_id' => ['required'],
        ]);
       $input = $request->all();

       if ($image = $request->file('image')) {

        $destinationPath = public_path().'uploads/category/';
        File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
        $recordImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $recordImage);
        $input['image'] = "$recordImage";
    }
    
        Category::create($input);

        return redirect()->action([SubCategoryController::class, 'index'])
                        ->with('success','Sub Category created successfully.');
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
        return view('subCategories.show',compact('category', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = category::find($category->id);
        $page_title = 'Edit Category';
        $page_description = 'This page is to edit record in category table';
        //
        return view('subCategories.edit',compact('category', 'page_title', 'page_description'));
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
        $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')->ignore($category), 'max:50'],
            'name_locale' => [Rule::unique('categories', 'name_locale')->ignore($category), 'max:50'],
            'parent_id' => ['required'],
        ]);

        $category->update($request->all());

        return redirect()->action([SubCategoryController::class, 'index'])
                        ->with('success','Sub Category updated successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id',$request->id)->delete();
        return Response()->json($category);
    }

    public function dataAjax(Request $request)
    {
        
        $search = $request->search;

        if($search == ''){
           $categories = Category::orderby('name','asc')->select('id','name')->limit(5)->get();
        }else{
           $categories = Category::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
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
