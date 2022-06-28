{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">  Items
                    <div class="text-muted pt-2 font-size-sm"> items Datatable</div>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ url('items/create' ) }}" class="btn btn-primary font-weight-bolder">
                <i class="la la-plus"></i>New Item</a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">
            @if ($message = Session::get('success'))
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
            <table class="table table-bordered table-hover main_datatable" id="kt_datatable">
                <thead>
                <tr>
                    <th>ID</th> 
                    <th>Item Image</th>
                    <th>Name</th>
                    <th>Sub Category</th>
                    <th>Price</th>
                    <th>New Price</th>
                    <th>In Stock</th>           
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
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    

    {{-- page scripts --}}
    <script type="text/javascript">
        $(function () {

            var table = $('.main_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('items') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    // {data: 'main_screen_image', name: 'main_screen_image'},
                    {
                        "data": "main_screen_image",
                        "render": function (data) {
                            // $image url(/media/users/blank.png)
                                if(data ){
                                    // return '<img src="{{asset("/media/users/blank.png")}}" class="avatar" width="50" height="50"/>';
                                    return '<img src=" {{asset("uploads/items")}}/' + data + '" class="avatar" width="50" height="50"/>';

                                }else{
                                    return data;
                                }
                            
                            }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'sub_category_name', name: 'sub_category_name'},                    
                    {data: 'price', name: 'price'},                    
                    {data: 'new_price', name: 'new_price'},                    
                    {
                        "data": "in_stock",
                        "render": function (data) {
                            // $image url(/media/users/blank.png)
                                if(data === 1){
                                        return 'Yes';
                            
                            
                             }else {
                                return 'No'
                             }
                            }
                    } ,                  
               
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        

        $('body').on('click', '.delete', function () {
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {

                    // ajax
                    $.ajax({
                        type:"POST",
                        url: "{{ url('items/delete') }}",
                        data:{
                            'id': id,
                            '_token': '{{ csrf_token() }}',
                        },
                        dataType: 'json',
                        success: function(res){
                        // success: function(res){
                        // success: function(res){
                            $('.main_datatable').DataTable().ajax.reload();
                        }
                    });
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
        });
    </script>
    <!-- @if ($message = Session::get('success')) -->
    <script>
        // $('#alert').show();
        //     setTimeout(function() {
        //         $('#alert').hide();
        // }, 5000);
     </script>
    <!-- @endif -->
@endsection
