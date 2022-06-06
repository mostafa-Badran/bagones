<?php 

$subcategories = null;
$items = null;
// $subcategories_visibilty = false;
// if($home->sub_category_id != null ){
    $subcategories = App\Models\Category::where('parent_id' , '!=',null )->get();
// }
// if($home->item_id != null ){
    $items = App\Models\Item::all();
// }

?>
{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom example example-compact">
    <div class="card-header">
        <h3 class="card-title">
            Edit home
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
    <form action="{{ url('home/update',$home) }}" method="POST"
        enctype="multipart/form-data" id="edit_home">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>Content Type<span class="text-danger">*</span></label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="content_type_id" name="content_type_id">
                          
                            @foreach($content_types as $content_type)
                                <option   value="{{ $content_type['id'] }}" > {{ $content_type['name'] }}
                                </option>

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
                      
                            @foreach($home->content_type->appearances as $appearance)
                            <option @if ($appearance['id']==$home->appearance_number)
                                    {{ 'selected' }} @endif
                                    value="{{ $appearance['id'] }}">{{ $appearance['number'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group row " id="subcategory_select" >
                <div class="col-lg-4">
                    <label>sub category <span class="text-danger">*</span></label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="subcategory_id" name="sub_category_id">
                            @if($home->sub_category_id != null)
                                @foreach($subcategories as $sub_category)
                                    <option @if ($sub_category['id']==$home->sub_category_id)
                                        {{  'selected' }} @endif
                                        value="{{ $sub_category['id'] }}">{{ $sub_category['name'] }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

            </div>
        

            <div class="form-group row" id="item_select">
                <div class="col-lg-4">
                    <label> Item <span class="text-danger">*</span></label>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control kt-select2 select2" id="item_id" name="item_id">
                            <!-- <option value="">Select subCategory</option> -->
                            @if($home->item_id != null)
                                @foreach($items as $item)
                                    <option @if ($item['id']==$home->item_id)
                                        {{  'selected' }} @endif
                                        value="{{ $item['id'] }}">{{ $item['name'] }}
                                    </option>
                                @endforeach
                            @endif
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
    var sub_category = {{$home->sub_category_id  == null ? 0 : 1}};
    var item_id = {{$home->item == null ? 0 : 1}};

    console.log(sub_category);
    console.logitem_id

    if(sub_category == 0){
        $('#subcategory_select').hide();
    }
    if(item_id == 0){
        $('#item_select').hide();
    }

    $('#content_type_id').select2({
    placeholder: "Select a content type",
    allowClear: true
    });
    $('#content_type_id').val(<?php echo $home->content_type_id; ?>).trigger("change");
    $('#appearance_id').select2({
        placeholder: "Select apprearance number ",
        allowClear: true
    });
    $('#subcategory_id').select2({
        placeholder: "Select a sub category",
        allowClear: true
    });
    $('#item_id').select2({
        placeholder: "Select a item",
        allowClear: true
    });


$('#content_type_id').on('select2:select', function (e) {
    // console.log(e.params.data.id);
        $("#appearance_id").empty();
        $("#subcategory_id").empty();        
        $("#item_id").empty(); 

        $('#edit_home').trigger("reset");
        $('#subcategory_select').hide();
        $('#item_select').hide();

        var content_type_id = e.params.data.id ;//$('#content_type_id').val();
        var content_type_text = e.params.data.text; //$('#content_type_id option:selected').text();
        $('#content_type_id').val(content_type_id);
      
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
                // $('#subcategory_select').hide();
                $('#item_select').show();
                getItems();
                break;

            default:
                // code block
        }

    })

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
