{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom example example-compact">
    <div class="card-header">
        <h3 class="card-title">
            Add New Multiple Choice
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <a href="{{ url('multiple_choice') }}" class="btn btn-secondary">Go Back</a>
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
    <form action="{{ url('multiple_choice') }}" method="POST">
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
                    <input type="text" name="name_locale" required class="form-control" placeholder="Enter Local Name" />
                    <span class="form-text text-muted">Please enter Local Name, Max 50 character allowed</span>
                </div>
                <!-- <div class="col-lg-6">
                    <label>Description<span class="text-danger">*</span></label>
                    <input type="text" name="description"  class="form-control"
                        placeholder="Enter description" />
                    <span class="form-text text-muted">Please enter description, Max 50 character allowed</span>
                </div>
                <div class="col-lg-6">
                    <label>Description_locale</label>
                    <input type="text" name="description_locale" class="form-control"
                        placeholder="Enter Local Description locale" />
                    <span class="form-text text-muted">Please enter Locale Description, Max 50 character allowed</span>
                </div> -->




            </div>
            	<!--  Component -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Multiple Choice Components</h4>
							<div class="component-info">							
								<div class="row form-row component-cont">
									<div class="col-12 col-md-10 col-lg-11">
										<div class="row form-row">
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-group">
													<label> Name <span class="text-danger">*</span></label>
													<input type="text" required name="entry_name[]" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-4">
												<div class="form-group">
													<label>Name locale <span class="text-danger">*</span></label>
													<input type="text" required name="entry_name_locale[]" class="form-control">
												</div>
											</div>
										
										</div>
									</div>
									
								</div>
							</div>
							<div class="add-more">
								<a href="javascript:void(0);" class="add-component"><i class="fa fa-plus-circle"></i> Add more </a>
							</div>
						</div>
					</div>
					<!-- / Component -->

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
<script >

    $(".component-info").on('click','.trash', function () {
		$(this).closest('.component-cont').remove();
		return false;
    });

    $(".add-component").on('click', function () {
		
		var component_content = '<div class="row form-row component-cont">' +
			'<div class="col-12 col-md-10 col-lg-11">' +
				'<div class="row form-row">' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label> Name </label>' +
							'<input type="text" required name="entry_name[]" class="form-control">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label> Name locale </label>' +
							'<input type="text" required name="entry_name_locale[]" class="form-control">' +
						'</div>' +
					'</div>' +
				
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
		'</div>';
		
        $(".component-info").append(component_content);
    });
</script>
@endsection


