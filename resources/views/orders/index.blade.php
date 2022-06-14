<!-- 4 tabs -->
{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Orders
                <div class="text-muted pt-2 font-size-sm">All Orders Datatable</div>
            </h3>
        </div>
        <div class="card-toolbar">

        </div>
    </div>

    <div class="card-body">
        @if($message = Session::get('success'))
            <div id="alert" class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
                <!-- <div class="alert-icon"><i class="flaticon-warning"></i></div> -->
                <div class="alert-text">{{ $message }}</div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                    </button>
                </div>
            </div>
        @endif

        <div class="card-body pt-0">

            <!-- Tab Menu -->
            <nav class="user-tabs mb-4">
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" onclick="new_orders()" href="#new_orders"
                            data-toggle="tab">New Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" onclick="recived_table()" href="#recived_order" data-toggle="tab">
                            <span>Recived Orders</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" onclick="in_process_table()" href="#in_process"
                            data-toggle="tab"><span>In Process</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" onclick="in_delivery_table()" href="#in_delivery"
                            data-toggle="tab"><span>In Delevery</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="deliverd_table()" href="#deliverd"
                            data-toggle="tab"><span>Deliverd</span></a>
                    </li>

                </ul>
            </nav>
            <!-- /Tab Menu -->

            <!-- Tab Content -->
            <div class="tab-content pt-0">

                <!-- <input type="hidden" id="patient_id" value=""> -->
                <!-- Appointment Tab -->
                <div id="new_orders" class="tab-pane fade show active">
                    <div class="card card-table mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="appoinment_table" class="table table-hover table-center mb-0">
                                    <thead>
                                        <tr>

                                            <th>Order Id </th>
                                            <th>Items Qty</th>
                                            <th>Total Amount</th>
                                            <th>Created At</th>
                                            <th>Type</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Appointment Tab -->
                <!-- orders Tab -->
                <div id="recived_order" class="tab-pane fade">
                    <div class="card card-table mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="order_table" class="table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Pharmacy</th>
                                            <th>Order Date</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /orders Tab -->
                <!-- patient lab requests Tab -->
                <div id="in_process" class="tab-pane fade">
                    <div class="card card-table mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="pat_lab_request_table" class="table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Request Id </th>
                                            <th>Labratory</th>
                                            <th>appointment Date</th>
                                            <th>Type</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /patient lab requests Tab -->

                <!-- Measurements Tab -->
                <div class="tab-pane fade" id="in_delivery">

                    <div class="card card-table mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="measurement_table" style="width:100%"
                                    class="table table-hover table-center mb-0">
                                    <thead>
                                        <tr>

                                        </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Measurements Tab -->

                <!-- Prescription Tab -->
                <div class="tab-pane fade" id="deliverd">
                    <div class="card card-table mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="prescription_table" style="width:100%"
                                    class="table table-hover table-center mb-0">
                                    <thead>
                                        <tr>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Prescription Tab -->




            </div>
            <!-- Tab Content -->
        </div>


    </div>

</div>

@endsection

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
    type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"
    type="text/javascript"></script>

{{-- page scripts --}}
<script type="text/javascript">
    var new_orders = $('#new_orders_table').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ url('orders') }}",
                ajax: {
                    "url": "{{ url('orders') }}",
                    "type": "POST",
                    "data": function (data) {},
                },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'name_locale',
                            name: 'name_locale'
                        },
                        {
                            data: 'multipule_choice',
                            name: 'multipule_choice'
                        },

                    ],
                });

            function new_orders_table() {
                new_orders.ajax.reload(null, false);
            }
    //-----------------------------------------------        
    var recived = $('#').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ url('orders') }}",
                ajax: {
                    "url": "{{ url('orders') }}",
                    "type": "POST",
                    "data": function (data) {
                        data.recived = 1
                    },
                },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'name_locale',
                            name: 'name_locale'
                        },
                        {
                            data: 'multipule_choice',
                            name: 'multipule_choice'
                        },

                    ],
                });

            function recived_table() {
                recived.ajax.reload(null, false);
            }
    //-----------------------------------------------        
    var in_process = $('#').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ url('orders') }}",
                ajax: {
                    "url": "{{ url('orders') }}",
                    "type": "POST",
                    "data": function (data) {
                        data.in_process = 1
                    },
                },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'name_locale',
                            name: 'name_locale'
                        },
                        {
                            data: 'multipule_choice',
                            name: 'multipule_choice'
                        },

                    ],
                });

            function in_process_table() {
                in_process.ajax.reload(null, false);
            }
     //----------------------------------------------------------       
    var in_delivery = $('#').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ url('orders') }}",
                ajax: {
                    "url": "{{ url('orders') }}",
                    "type": "POST",
                    "data": function (data) {
                        data.in_delivery = 1
                    },
                },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'name_locale',
                            name: 'name_locale'
                        },
                        {
                            data: 'multipule_choice',
                            name: 'multipule_choice'
                        },

                    ],
                });

            function in_delivery_table() {
                in_delivery.ajax.reload(null, false);
            }
//----------------------------------
            var deliverd = $('#').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ url('orders') }}",
                ajax: {
                    "url": "{{ url('orders') }}",
                    "type": "POST",
                    "data": function (data) {
                        data.deliverd = 1
                    },
                },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'name_locale',
                            name: 'name_locale'
                        },
                        {
                            data: 'multipule_choice',
                            name: 'multipule_choice'
                        },

                    ],
                });

            function deliverd_table() {
                deliverd.ajax.reload(null, false);
            }


</script>
@if($message = Session::get('success'))
    <script>
        $('#alert').show();
        setTimeout(function () {
            $('#alert').hide();
        }, 5000);

    </script>
@endif
@endsection
