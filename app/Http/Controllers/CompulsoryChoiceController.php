<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Compulsory_choice;
use App\Models\Compulsory_choice_entry;

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

            $data = DB::table('compulsory_choices')
            ->select('id','name','name_locale')
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

        
        DB::beginTransaction();
        try {

            $compulsory_choice_input = [
                'name'=> $request->input('name'),
                'name_locale'=>$request->input('name_locale'),
            ] ;
            
            $compulsory_choice  = Compulsory_choice::create($compulsory_choice_input);    
            //adding compulsory_choice Components
            $entry_names = $request->input('entry_name'); // input array
            $entry_name_locales = $request->input('entry_name_locale');// input array
            $components=[];
            foreach ($entry_names as $key => $name) {
                $data = [
                    'name'=>$name,
                    'name_locale'=> $entry_name_locales[$key],
                    'compulsory_choice_id'=>$compulsory_choice->id
                ];
               array_push($components ,$data );
               
            }
           
            Compulsory_choice_entry::insert($components);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return redirect()->action([self::class, 'create'])
            ->with('error','Error Creating Compulsory Choice.');
        }
        
        return redirect()->action([self::class, 'index'])
                        ->with('success','Compulsory Choice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Compulsory_choice  $compulsory_choice
     * 
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
     * @param  Compulsory_choice $compulsory_choice
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Compulsory_choice $compulsory_choice)
    {
        $page_title = 'Edit Compulsory Choice';
        $page_description = 'This page is to Edit compulsory choice details';
        
        return view('compulsory_choices.edit',compact('compulsory_choice', 'page_title', 'page_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Compulsory_choice $compulsory_choice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compulsory_choice $compulsory_choice)
    {
        $request->validate([
            'name' => ['required',  'max:255'],
            'name_locale' => ['required', 'max:255'],
        ]);
        
        DB::beginTransaction();
        try {
        $compulsory_choice_input = [
            'name'=> $request->input('name'),
            'name_locale'=>$request->input('name_locale'),
        ] ;
        
   
        $compulsory_choice->update($compulsory_choice_input);


        //adding compulsory_choice Components
        $entry_names = $request->input('entry_name'); // input array
        $entry_name_locales = $request->input('entry_name_locale');// input array
        $compulsory_choice_components=[];
        foreach ($entry_names as $key => $name) {
            $data = [
                'name'=>$name,
                'name_locale'=> $entry_name_locales[$key],
                'compulsory_choice_id'=>$compulsory_choice->id
            ];
            array_push($compulsory_choice_components ,$data );
            
        }
        //delete previous entries
        Compulsory_choice_entry::where('compulsory_choice_id' , $compulsory_choice->id)->delete();
        //insert new entries
        Compulsory_choice_entry::insert($compulsory_choice_components);

        DB::commit();
        // all good
    } catch (\Exception $e) {
        DB::rollback();
        // something went wrong
        return redirect()->action([self::class, 'edit'])
        ->with('error','Error Updating Compulsory Choice.');
    }
    
    return redirect()->action([self::class, 'index'])
                    ->with('success','Compulsory Choice Updated successfully.');
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
            $com1 = Compulsory_choice_entry::where('compulsory_choice_id',$id)->delete();
            $com2 = Compulsory_choice::where('id',$id)->delete();
            DB::commit();
                // all good
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                return Response()->json('Error Deleting Compulsory Choice');
            }
            return Response()->json($com2);
        }   
    }
}
