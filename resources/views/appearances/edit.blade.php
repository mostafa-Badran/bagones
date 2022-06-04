<?php
// dd($appearance->content_type_id);
?>
{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom example example-compact">
    <div class="card-header">
        <h3 class="card-title">
            Edit Appearance
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <a href="{{ url('appearance') }}" class="btn btn-secondary">Go Back</a>
            </div>
        </div>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--begin::Form-->
    <form action="{{ url('appearance/update', $appearance) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group row">
               
                <div class="col-lg-4">
                    <label>Number<span class="text-danger">*</span></label>
                    <input type="text" name="number" required class="form-control" placeholder="Enter Appearance Number" 
                    value="{{$appearance->number}}"/>
                    <span class="form-text text-muted">Please enter Name, Max 50 character allowed</span>
                </div>
               
                <div class="col-lg-4">
                    <label>Content Type<span class="text-danger">*</span></label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="kt_select2_1" name="content_type_id">
                            @foreach ($content_types as $content_type)
                                <option value="{{$content_type['id']}}" {{ $appearance->content_type_id == $content_type['id'] ? 'selected="selected"': ""}}>{{$content_type['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- <div class="form-group row"> -->
                <div class="col-lg-4">

                    <!-- <div class="image-input image-input-empty image-input-outline" id="kt_image_5"
                        style="background-image: url(/media/categories/category.png)">
                        <div class="image-input-wrapper"></div>
                       

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="profile_avatar_remove" />
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="remove" data-toggle="tooltip" title="Remove avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                </div> -->
                <!-- </div> -->
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-8">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    // CSRF Token
    // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    // var avatar5 = new KTImageInput('kt_image_5');

    // avatar5.on('cancel', function (imageInput) {
    //     swal.fire({
    //         title: 'Image successfully changed !',
    //         type: 'success',
    //         buttonsStyling: false,
    //         confirmButtonText: 'Awesome!',
    //         confirmButtonClass: 'btn btn-primary font-weight-bold'
    //     });
    // });

    // avatar5.on('change', function (imageInput) {
    //     swal.fire({
    //         title: 'Image successfully changed !',
    //         type: 'success',
    //         buttonsStyling: false,
    //         confirmButtonText: 'Awesome!',
    //         confirmButtonClass: 'btn btn-primary font-weight-bold'
    //     });
    // });

    // avatar5.on('remove', function (imageInput) {
    //     swal.fire({
    //         title: 'Image successfully removed !',
    //         type: 'error',
    //         buttonsStyling: false,
    //         confirmButtonText: 'Got it!',
    //         confirmButtonClass: 'btn btn-primary font-weight-bold'
    //     });
    // }); 


</script>
@endsection
