{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')


    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Appearances
                    <div class="text-muted pt-2 font-size-sm"> Appearances Datatable</div>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ url('appearance/create') }}" class="btn btn-primary font-weight-bolder">
                <i class="la la-plus"></i>New Record</a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">
            @if ($message = Session::get('success'))
            <div id="alert" class="alert alert-custom alert-notice alert-light-success fade show" role="alert">
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
                    <th>Number</th>
                    <th>Content Type</th>  
                    <!-- <th>Image</th>   -->
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
                ajax: "{{ url('appearance') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'number', name: 'number'},  
                    {data: 'content_type', name: 'content_type'},  
                    // {
                    //     "data": "image",
                    //     "render": function (data) {
                    //         return '<img src=" {{asset("uploads/appearance")}}/' + data + '" class="avatar" width="50" height="50"/>';
                    //         }
                    // },
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
                        url: "{{ url('appearance/destroy') }}",
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
    @if ($message = Session::get('success'))
    <script>
        $('#alert').show();
            setTimeout(function() {
                $('#alert').hide();
        }, 5000);
    </script>
    @endif
@endsection
