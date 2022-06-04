{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom example example-compact">
    <div class="card-header">
        <h3 class="card-title">
            Add New Home secion
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <a href="{{ url('home') }}" class="btn btn-secondary">Go Back</a>
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
    <form action="{{ url('home') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Content Type<span class="text-danger">*</span></label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="content_type_id" name="content_type_id"
                           >
                            <option value="">Select Content Type</option>
                            @foreach($content_types as $content_type)
                                <option value="{{ $content_type['id'] }}">
                                    {{ $content_type['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Appearance number <span class="text-danger">*</span></label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="appearance_id" name="appearance_number"
                            >
                            <option value="">Select Appearance number</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="form-group row" id="subcategory_select">
                <div class="col-lg-4">
                    <label>sub category <span class="text-danger">*</span></label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="subcategory_id" name="sub_category_id">
                            <!-- <option value="">Select subCategory</option> -->
                        </select>
                    </div>
                </div>

            </div>
            <div class="form-group row" id="item_select">
                <div class="col-lg-4">
                    <label>Item <span class="text-danger">*</span></label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="item_id" name="item_id">
                        </select>
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
    <!--end::Form-->
</div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    $('#subcategory_select').hide();
    $('#item_select').hide();

    $('#content_type_id').select2({
        placeholder: "Select a content type",
        allowClear: true
    });
    $('#appearance_id').select2({
        placeholder: "Select apprearance number ",
        allowClear: true
    });
    $('#subcategory_id').select2({
        placeholder: "Select a sub category",
        allowClear: true
    });
    $('#item_id').select2({
        placeholder: "Select Item",
        allowClear: true
    });

    $('#content_type_id').change(function () {

        $("#appearance_id").empty();
        $("#subcategory_id").empty();
        $("#item_id").empty();

        $('#subcategory_select').hide();
        $('#item_select').hide();

        var content_type_id = $('#content_type_id').val();
        var content_type_text = $('#content_type_id option:selected').text();

        // alert(content_type_text.trim());
        console.log(content_type_text.trim());
        var url = "{{ url('api/contentTypes') }}" + '/' + content_type_id + '/appearance';
        getAppearances(url);
        //check selection  
        switch (content_type_text.trim().toLocaleLowerCase()) {
            case 'category':
                // code block
                // $('#subcategory_select').hide();
                break;
            case 'offer':
                // $('#subcategory_select').hide();
                break;
            case 'sub category':
                $('#subcategory_select').show();
                getSubCategories();
                break;
            case 'item':
                $('#item_select').show();
                getItems();

                break;

            default:
                // code block
        }

        // console.log(url);


    });

    function getAppearances(_url) {
        $("#appearance_id").select2({
            ajax: {
                url: _url,
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        '_token': '{{ csrf_token() }}',
                        'search': params.term // search term
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
    }


    function getSubCategories() {
        let subCatUrl = "{{ url('api/subcategory/dataAjax') }}";
        $("#subcategory_id").select2({
            ajax: {
                url: subCatUrl,
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        '_token': '{{ csrf_token() }}',
                        'search': params.term // search term
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
    }
    function getItems() {
        let itemsUrl = "{{ url('api/item/dataAjax') }}";
        $("#item_id").select2({
            ajax: {
                url: itemsUrl,
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        '_token': '{{ csrf_token() }}',
                        'search': params.term // search term
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
    }

</script>
@endsection
