<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Order;
use App\Services\FCMService;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $status='recived';
            $status_value = 0;

            $query = DB::table('orders')
            ->select('id','phone_number' , 'city' , 'area' ,'gps_link','created_at','updated_at', 'total_amount');
          

            if(!empty($request->recived ) ){
               $query->where('recived' , 1);
               $query->where('in_process' , 0);
               $query->where('in_delivery' , 0);
               $query->where('deliverd' , 0);
            }elseif(!empty($request->in_process ) ){
                $query->where('recived' , 1);
                $query->where('in_process' , 1);
                $query->where('in_delivery' , 0);
                $query->where('deliverd' , 0);
            }elseif(!empty($request->in_delivery ) ){
                $query->where('recived' , 1);
                $query->where('in_process' , 1);
                $query->where('in_delivery' , 1);
                $query->where('deliverd' , 0);
            }elseif(!empty($request->deliverd ) ){
                $query->where('recived' , 1);
                $query->where('in_process' , 1);
                $query->where('in_delivery' , 1);
                $query->where('deliverd' , 1);
            }else{
                $query->where('recived' , 0);
                $query->where('in_process' , 0);
                $query->where('in_delivery' , 0);
                $query->where('deliverd' , 0);
            }
            
           
            // print_r($status.'-'.$status_value) ;exit;
           
            $query->orderByDesc('id')       
            ->get();
            // print_r($data);
            // exit;
            return DataTables::of($query)->addIndexColumn()
            ->addColumn('action', 'orders.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
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
     * @param  Order  $order
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Order $order)
    {
        $page_title = 'Show Order ';
        $page_description = 'This page is to show order details';
        //
        return view('orders.show',compact('order', 'page_title', 'page_description'));
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

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $order = Order::find($id);

        if($status == 'deliverd'){
            $order->setDeliverd();
            $order->setInDelivery();
            $order->setInProcess();
            $order->setRecived();
            $this->sendNotificationrToUser($order->device_token ,$status,$order );
        }

        elseif($status == 'in_delivery'){
            $order->setInDelivery();
            $order->setInProcess();
            $order->setRecived();
            $this->sendNotificationrToUser($order->device_token ,$status,$order );
        }
        elseif($status == 'in_process'){
            $order->setInProcess();
            $order->setRecived();
            $this->sendNotificationrToUser($order->device_token ,$status,$order );
        }
        elseif($status == 'recived'){
            $order->setRecived();
            $this->sendNotificationrToUser($order->device_token ,$status,$order );
        }
        // $order->update([$status => 1]);
        return Response()->json('success');
    }


    private function sendNotificationrToUser($device_token , $status , $order )
    {
       // get a user to get the fcm_token that already sent.               from mobile apps 
    //    $user = User::findOrFail($id);
    // dd($device_token);
    $title = '';
    $body= '';
    if($status == 'deliverd'){
        $title = 'Order status';
        $body= ' Deliverd';
    }

    elseif($status == 'in_delivery'){
        $title = 'Order status';
        $body= ' On the way';
    }
    elseif($status == 'in_process'){
        $title = 'Order status';
        $body= ' In Process';
    }
    elseif($status == 'recived'){
        $title = 'Order status';
        $body= ' Order Received';
    }
        if($device_token==null ||  $device_token == '' ){
            return;
        }

      FCMService::send(
          $device_token,
          [
            'title' => $title,
            'body' => $body,
            'order_id'=>$order->id
          ],
          [
            'title' => $title,
            'body' =>$body
          ]
      );
    }

}
