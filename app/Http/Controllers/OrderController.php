<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $status='recived'; $status_value = 0;

            if(!empty($request->recieved ) ){
                $status= 'recived';
                $status_value = $request->recived;
            }elseif(!empty($request->in_process ) ){
                $status= 'in_process';
                $status_value = $request->in_process;
            }elseif(!empty($request->in_delivery ) ){
                $status= 'in_delivery';
                $status_value = $request->in_delivery;
            }elseif(!empty($request->deliverd ) ){
                $status= 'deliverd';
                $status_value = $request->deliverd;
            }
           

            $data = DB::table('orders')
            ->select('id','name','name_locale')
            ->where($status , $status_value )
            ->get();

            return DataTables::of($data)->make(true);
        }
        $page_title = 'Orders';
        $page_description = 'This page is to show all orders';

        return view('orders.index', compact('page_title', 'page_description'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
