{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Stores
                <div class="text-muted pt-2 font-size-sm">All Stores Datatable</div>
            </h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="{{ url('store/create') }}" class="btn btn-primary font-weight-bolder">
                <i class="la la-plus"></i>New Record</a>
            <!--end::Button-->
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
        <table class="table table-bordered table-hover main_datatable" id="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Store name</th>
                    <th>Slogan</th>
                    <th>location address</th>
                    <th>Is open</th>
                    <th>Add hot price</th>
                    <th>Phone</th>
                    <th>area</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

        </table>

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
    $(function () {

        var table = $('.main_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('store') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },            
                {
                    data: 'slogan',
                    name: 'slogan'
                },           
                {
                    data: 'location_text',
                    name: 'location_text'
                },           
                {
                    data: 'is_open',
                    name: 'is_open'
                },
                {
                    data: 'allow_add_hot_price',
                    name: 'allow_add_hot_price'
                },
                {
                    data: 'phone_number',
                    name: 'phone_number'
                },
                {
                    data: 'area_name_en',
                    name: 'area_name_en'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });

</script>

@endsection
