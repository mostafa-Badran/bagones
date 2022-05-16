{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom example example-compact">
    <div class="card-header">
        <h3 class="card-title">
            Edit Store 
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <a href="{{ url('store') }}" class="btn btn-secondary">Go Back</a>
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
    <form action="{{ url('store/update',$store) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ $store->name }}" required class="form-control" placeholder="Enter Store Name" />
                    <span class="form-text text-muted">Please enter Name</span>
                </div>

                <div class="col-lg-4">
                    <label>Name locale<span class="text-danger">*</span></label>
                    <input type="text" name="name_locale" value="{{ $store->name_locale }}" class="form-control" placeholder="Enter Store Locale Name" />
                    <span class="form-text text-muted">Please enter Locale Name</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Slogan<span class="text-danger">*</span></label>
                    <input type="text" name="slogan" value="{{ $store->slogan }}" required class="form-control" placeholder="Enter Store Slogan" />
                    <span class="form-text text-muted">Please enter Slogan</span>
                </div>

                <div class="col-lg-4">
                    <label>Slogan locale<span class="text-danger">*</span></label>
                    <input type="text" name="slogan_locale" value="{{ $store->slogan_locale }}" class="form-control"
                        placeholder="Enter Store Slogan Locale" />
                    <span class="form-text text-muted">Please enter Slogan Locale </span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Store Location Address<span class="text-danger">*</span></label>
                    <input type="text" name="location_text" value="{{ $store->location_text }}" required class="form-control"
                        placeholder="Enter Store Location Adress" />
                    <span class="form-text text-muted">Please enter location address </span>
                </div>

                <div class="col-lg-4">
                    <label>Store Location Address locale<span class="text-danger">*</span></label>
                    <input type="text" name="location_text_locale" value="{{ $store->location_text_locale }}" class="form-control"
                        placeholder="Enter Store Location Adress Locale" />
                    <span class="form-text text-muted">Please enter location address Locale </span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Store Phone Number<span class="text-danger">*</span></label>
                    <input type="text" name="phone_number" value="{{ $store->phone_number }}" required class="form-control"
                        placeholder="Enter Store Phone Number" />
                    <span class="form-text text-muted">Please enter store phone number </span>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-lg-12 my-2">
                    <label>Delivery Areas<span class="text-danger">*</span></label>

                </div>
                <div class="col-lg-12">
                    <label>Country<span class="text-danger">*</span></label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="country_select" name="country_id">
                            <option></option>
                            @foreach($countries as $country)
                                <option value="{{ $country['id'] }}">
                                    {{ $country['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>city</label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="city_select" name="city_id">
                         
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>area</label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="areas" name="areas[]" multiple="multiple">
                          
                        </select>
                    </div>

                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Delivery Time Range<span class="text-danger">*</span></label>
                    <input type="text" name="delivery_time_range" value="{{ $store->delivery_time_range }}" required class="form-control"
                        placeholder="Enter delivery_time_range" />
                    <span class="form-text text-muted">Please enter delivery_time_range </span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Google Map Link<span class="text-danger">*</span></label>
                    <input type="text" name="google_map_link" value="{{ $store->google_map_link }}" required class="form-control"
                        placeholder="Enter Google Map Link" />
                    <span class="form-text text-muted">Please enter google map link </span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label">Is Open<span class="text-danger">*</span></label>
                <div class="col-3">
                    <span class="switch">
                        <label>
                            <input type="checkbox"  name="is_open"  />
                            <span></span>
                        </label>
                    </span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 col-form-label">Allow Add Hot Price<span class="text-danger">*</span></label>
                <div class="col-3">
                    <span class="switch">
                        <label>
                            <input type="checkbox"  name="allow_add_hot_price" <?= $store->allow_add_hot_price == true? 'checked="checked"' : '' ?> />
                            <span></span>
                        </label>
                    </span>
                </div>
            </div>
            <br>
            <br>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Image<span class="text-danger">*</span></label>
               
                        <div class="image-input image-input-empty image-input-outline" id="kt_image_5"
                            style="background-image: url(/uploads/stores/{{ $store->image }})">
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
                </div>
                <div class="col-lg-4">
                    <label>Cover Image<span class="text-danger">*</span></label>
                   
                        <div class="image-input image-input-empty image-input-outline" id="kt_image_4"
                            style="background-image: url(/uploads/stores/{{ $store->cover_image }})">
                            
                        
                        <div class="image-input-wrapper"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                            data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="cover_image" accept=".png, .jpg, .jpeg" />
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
                </div>


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

</div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    $('#subcategory_select').hide();
    $('#country_select').select2({
        placeholder: "Select country",
        allowClear: true
    });
    $('#city_select').select2({
        placeholder: "Select city ",
        allowClear: true
    });
    $('#areas').select2({
        placeholder: "Select area",
        allowClear: true
    });

    //Image
    var avatar5 = new KTImageInput('kt_image_5');

    avatar5.on('cancel', function (imageInput) {
        swal.fire({
            title: 'Image successfully changed !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar5.on('change', function (imageInput) {
        swal.fire({
            title: 'Image successfully changed !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar5.on('remove', function (imageInput) {
        swal.fire({
            title: 'Image successfully removed !',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'Got it!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    //cover image
    var avatar4 = new KTImageInput('kt_image_4');

    avatar4.on('cancel', function (imageInput) {
        swal.fire({
            title: 'Image successfully changed !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar4.on('change', function (imageInput) {
        swal.fire({
            title: 'Image successfully changed !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar4.on('remove', function (imageInput) {
        swal.fire({
            title: 'Image successfully removed !',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'Got it!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });



    //get cities 

    $('#country_select').change(function () {
        // alert($('#country_select').val());
        var country_id=  $('#country_select').val();
        
        $( "#city_select" ).select2({
        ajax: {
            url: "{{url('api/country/cities')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              '_token': '{{ csrf_token() }}',
              'search' : params.term, // search term
              'country_id':country_id
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });

    });

    $('#city_select').change(function () {
        var city_id=  $('#city_select').val();
        // alert(city_id);
        $( "#areas" ).select2({
        ajax: {
          url: "{{url('api/city/areas')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              '_token': '{{ csrf_token() }}',
              'search' : params.term, // search term
              'city_id':city_id
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });
    });

    //get areas

</script>
@endsection
