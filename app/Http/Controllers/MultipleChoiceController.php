<?php

namespace App\Http\Controllers;


use App\Models\multiple_choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Multiple_choice_entry;

class MultipleChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('multiple_choices')
            ->select('id','name','name_locale')
            ->get();
            return DataTables::of($data)->make(true);
        }

        $page_title = 'Multiple Choices';
        $page_description = 'This page is to show all the records in multiple choices table';

        return view('multiple_choices.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
       
        $page_title = 'Add New Multiple Choices';
        $page_description = 'This page is to add new record in multiple choices table';
        
        return view('multiple_choices.create', compact('page_title', 'page_description'));
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

            $multiple_choice_input = [
                'name'=> $request->input('name'),
                'name_locale'=>$request->input('name_locale'),
            ] ;
            
            $multiple_choice  = Multiple_choice::create($multiple_choice_input);    
            //adding multiple_choice Components
            $entry_names = $request->input('entry_name'); // input array
            $entry_name_locales = $request->input('entry_name_locale');// input array
            $components=[];
            foreach ($entry_names as $key => $name) {
                $data = [
                    'name'=>$name,
                    'name_locale'=> $entry_name_locales[$key],
                    'multiple_choice_id'=>$multiple_choice->id
                ];
               array_push($components ,$data );
               
            }
           
            Multiple_choice_entry::insert($components);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->action([self::class, 'create'])
            ->with('error','Error Creating Multiple Choice.');
        }
        
        return redirect()->action([self::class, 'index'])
                        ->with('success','Multiple Choice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Multiple_choice  $multiple_choice
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Multiple_choice $multiple_choice)
    {
        
        $page_title = 'Show Multipule choice';
        $page_description = 'This page is to Show multiple_choice details';
        //
        return view('multiple_choices.show',compact('multiple_choice', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Multiple_choice $multiple_choice)
    {
        $page_title = 'Edit Multipule Choice';
        $page_description = 'This page is to Edit Multipule choice details';
        
        return view('multiple_choices.edit',compact('multiple_choice', 'page_title', 'page_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  (Multiple_choice $multiple_choice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Multiple_choice $multiple_choice)
    {
        $request->validate([
            'name' => ['required',  'max:255'],
            'name_locale' => ['required', 'max:255'],
        ]);
        
        DB::beginTransaction();
        try {
        $multiple_choice_input = [
            'name'=> $request->input('name'),
            'name_locale'=>$request->input('name_locale'),
        ] ;
        
   
        $multiple_choice->update($multiple_choice_input);


        //adding multiple_choice Components
        $entry_names = $request->input('entry_name'); // input array
        $entry_name_locales = $request->input('entry_name_locale');// input array
        $multiple_choice_components=[];
        foreach ($entry_names as $key => $name) {
            $data = [
                'name'=>$name,
                'name_locale'=> $entry_name_locales[$key],
                'multiple_choice_id'=>$multiple_choice->id
            ];
            array_push($multiple_choice_components ,$data );
            
        }
        //delete previous entries
        Multiple_choice_entry::where('multiple_choice_id' , $multiple_choice->id)->delete();
        //insert new entries
        Multiple_choice_entry::insert($multiple_choice_components);

        DB::commit();
        // all good
    } catch (\Exception $e) {
        DB::rollback();
        // something went wrong
        return redirect()->action([self::class, 'edit'])
        ->with('error','Error Updating Multiple Choice.');
    }
    
    return redirect()->action([self::class, 'index'])
                    ->with('success','Multiple Choice Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->input('id');
            
            DB::beginTransaction();
            try {
            $com1 = Multiple_choice_entry::where('multiple_choice_id',$id)->delete();
            $com2 = Multiple_choice::where('id',$id)->delete();
            DB::commit();
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                return Response()->json('Error Deleting Multiple Choice');
            }
            return Response()->json($com2);
        }
    }
}
