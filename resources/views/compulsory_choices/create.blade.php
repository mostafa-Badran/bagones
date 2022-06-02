{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom example example-compact">
    <div class="card-header">
        <h3 class="card-title">
            Add New compulsory_choice
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <a href="{{ url('compulsory_choice') }}" class="btn btn-secondary">Go Back</a>
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
    <form action="{{ url('compulsory_choice') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group row">

                <div class="col-lg-6">
                    <label>Name_en<span class="text-danger">*</span></label>
                    <input type="text" name="name" required class="form-control" placeholder="Enter Name" />
                    <span class="form-text text-muted">Please enter Name, Max 50 character allowed</span>
                </div>
                <div class="col-lg-6">
                    <label>Name_locale</label>
                    <input type="text" name="name_locale" class="form-control" placeholder="Enter Local Name" />
                    <span class="form-text text-muted">Please enter Local Name, Max 50 character allowed</span>
                </div>
                <div class="col-lg-6">
                    <label>Description<span class="text-danger">*</span></label>
                    <input type="text" name="description" required class="form-control"
                        placeholder="Enter description" />
                    <span class="form-text text-muted">Please enter description, Max 50 character allowed</span>
                </div>
                <div class="col-lg-6">
                    <label>Description_locale</label>
                    <input type="text" name="description_locale" class="form-control"
                        placeholder="Enter Local Description locale" />
                    <span class="form-text text-muted">Please enter Locale Description, Max 50 character allowed</span>
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

