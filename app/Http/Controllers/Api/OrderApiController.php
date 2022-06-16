<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\OrderItems;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // echo json_encode($request->all());
        // exit;
        DB::beginTransaction();
        try{
            //create order and get order id
            $order = new Order();
            // $order->order_number = uniqid('ORD.');
            // $order->user_id = $request->user_id;

            $order->city = $request->city;
            $order->area = $request->area;

            $order->amount = floatval($request->amount);
            $order->tax = floatval($request->tax);
            $order->delivery_fee = floatval($request->delivery_fee);
            $order->total_amount = floatval($request->total_amount);

            $order->street_n = $request->street_n;
            $order->building_n = $request->building_n;
            $order->floor_n = $request->floor_n;
            $order->appartment_n = $request->appartment_n;

            $order->phone_number = $request->phone_number;
            $order->gps_link = $request->gps_link;
            $order->device_type = $request->device_type;
            $order->device_token = $request->device_token;
            $order->customer_note = $request->customer_note;
            
            $order->save();

            $items = $request->items;
            foreach($items as $item){
            
                $item['item_id'] = intval($item['item_id']);
                $item['quantity'] = floatval($item['quantity']);
                $item['unit_price'] = floatval($item['unit_price']);
                $item['order_id'] = $order->id;
                OrderItems::create($item);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $this->sendError($e);
        }
        return $this->sendResponse($order, 'Order created successfully.');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($order)
    {
        
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
