{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<style>
.card-img-top {
width: 100%;
height: 40vh;
object-fit: cover;

}
</style>
<div class="card card-custom example example-compact">
    <div class="card-header">
        <h3 class="card-title">
            View Order # {{$order->id}}
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <a href="{{ url('orders') }}" class="btn btn-secondary">Go Back</a>
            </div>
        </div>
    </div>
    <!--begin::Form-->
    <div class="card-body">

        <div class="form-group row">
            <div class="col-lg-12">
                <label class="badge badge-secondary">Current status</label>
                @if( $order->recived == 0 &&  $order->in_process == 0 && $order->in_delivery == 0 && $order->deliverd == 0)
                <p class="badge badge-light"> 
                    Sent
                </p>
                @elseif ( $order->recived == 1 &&  $order->in_process == 0 && $order->in_delivery == 0 && $order->deliverd == 0)
                <p class="label label-lg label-light-primary label-inline"> 
                    Recived
                </p>
                @elseif ( $order->recived == 1 &&  $order->in_process == 1 && $order->in_delivery == 0 && $order->deliverd == 0)
                <p class="label label-lg label-light-warning label-inline"> 
                     In process
                </p>
                @elseif ( $order->recived == 1 &&  $order->in_process == 1 && $order->in_delivery == 1 && $order->deliverd == 0)
                <p class="label label-lg label-light-warning label-inline"> 
                     In Delivery
                </p>
                @elseif ( $order->recived == 1 &&  $order->in_process == 1 && $order->in_delivery == 1 && $order->deliverd == 1)
                <p class="label label-lg label-light-success label-inline"> 
                     Deliverd
                </p>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 text-center">
                <button id="recived" type="button" class="btn btn-primary"
                    {{ $order->recived == 0 ? '' : 'disabled' }}>
                    Recieved </button>
                <button id="in_process" type="button" class="btn btn-warning"
                    {{ $order->recived == 1 && $order->in_process == 0 ? '' : 'disabled' }}>
                    In Process </button>
                <button id="in_delivery" type="button" class="btn btn-warning"
                    {{ $order->recived == 1 && $order->in_process == 1 && $order->in_delivery == 0 ? '' : 'disabled' }}>
                    In Delivery </button>
                <button id="deliverd" type="button" class="btn btn-success"
                    {{ $order->recived == 1 && $order->in_process == 1 && $order->in_delivery == 1 && $order->deliverd == 0 ? '' : 'disabled' }}>
                    Deliverd </button>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        Amount Details
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">

                                    <div class="col-lg-12">
                                        <label class="badge badge-secondary">Amount</label>
                                        <p class="badge badge-light">{{ $order->amount }} AED</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="badge badge-secondary">Tax</label>
                                        <p class="badge badge-light">{{ $order->tax }} AED</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="badge badge-secondary">Delivery Fee</label>
                                        <p class="badge badge-light">{{ $order->delivery_fee }} AED</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="badge badge-secondary">Total Amount</label>
                                        <p class="badge badge-light">{{ $order->total_amount }} AED</p>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        User Info
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">

                                    <div class="col-lg-12">
                                        <label class="badge badge-secondary">Location </label>
                                        <p class="badge badge-light">{{ $order->city }}, {{ $order->area }},
                                            {{ $order->street_n }}, {{ $order->building_n }},
                                            {{ $order->floor_n }}, {{ $order->appartment_n }} </p>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <label class="badge badge-secondary">GPS Location </label>
                                        <p class="badge badge-light">{{ $order->gps_link }} </p>
                                    </div> -->
                                    <div class="col-lg-12">
                                        <label class="badge badge-secondary">Phone number </label>
                                        <p class="badge badge-light">{{ $order->phone_number }} </p>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <label class="badge badge-secondary">Device Type </label>
                                        <p class="badge badge-light">{{ $order->device_type }} </p>
                                    </div> -->
                                    <div class="col-lg-12">
                                        <label class="badge badge-secondary">Customer Note</label>
                                        <p class="badge badge-light">{{ $order->customer_note }} </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">
                                Items
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            @foreach( $order->items as $item)
                                <div class="col-lg-4">
                                    <div class="card" style="width: 18rem;">

                                        <img class="embed-responsive card-img-top"
                                            src="{{ url($item->main_screen_image != null ?'uploads/items/'.$item->main_screen_image : '/media/item/blank.png' ) }}"
                                            alt="Card image cap">
                                            <div class="card-body">
                                            <h5 class="card-title">{{ intval($item->pivot->quantity) .' X ' . $item->name }}</h5>
                                            
                                        @if($item->compulsoryChoices->count() )    
                                        
                                            
                                            <p class="card-text"> Compulsory Choices:</p>
                                            @foreach($item->compulsoryChoices as $choise)
                                            <p class="card-text"> {{ $choise['name']}}</p>
                                            @endforeach
                                        @endif 
                                        @if($item->multipleChoices->count() )       
                                            <p class="card-text"> Multiple Choices :</p>
                                            @foreach($item->multipleChoices as $mChoise)
                                            <p class="card-text"> {{ $mChoise['name'] }}</p>
                                            @endforeach
                                        @endif 

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="card-footer">
        <div class="row">

        </div>
    </div>

    <!--end::Form-->
</div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    var order = {!! $order->toJson() !!};

    $("#recived").on("click", function () {
       
        $.ajax({
            type: "POST",
            url: "{{ url('orders/change_status') }}",
            data: {
                'id': order.id,
                'status': 'recived',
                'value': '1',
                '_token': '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function (res) {
                location.reload();
            }
        });

    });
    $("#in_process").on("click", function () {
       
        $.ajax({
            type: "POST",
            url: "{{ url('orders/change_status') }}",
            data: {
                'id': order.id,
                'status': 'in_process',
                'value': '1',
                '_token': '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function (res) {
                location.reload();
            }
        });
    });
    $("#in_delivery").on("click", function () {
        $.ajax({
            type: "POST",
            url: "{{ url('orders/change_status') }}",
            data: {
                'id': order.id,
                'status': 'in_delivery',
                'value': '1',
                '_token': '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function (res) {
                location.reload();
            }
        });
    });
    $("#deliverd").on("click", function () {
        $.ajax({
            type: "POST",
            url: "{{ url('orders/change_status') }}",
            data: {
                'id': order.id,
                'status': 'deliverd',
                'value': '1',
                '_token': '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function (res) {
                location.reload();
            }
        });
    });

</script>
@endsection
