@extends('admin.layouts.master')

@section('page_title')
    {{__('packagingtype.edit.title')}}
@endsection

@push('css')
	<style>
		#output{
			width: 100%;
		}
	</style>
@endpush

@section('content')
	<form method="post" action="{{ route('packaging-types.update', $row->id) }}" enctype="multipart/form-data" id="packagingtype_edit_form">
		@csrf()

		<!-- Page Header -->
		<div class="page-header"> 
			<div class="card breadcrumb-card">
				<div class="row justify-content-between align-content-between" style="height: 100%;">
					<div class="col-md-6">
						<h3 class="page-title">{{__('packagingtype.index.title')}}</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="{{ route('dashboard') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-item">
								<a href="{{ route('categories.index') }}">{{ __('packagingtype.index.title') }}</a>
							</li>
							<li class="breadcrumb-item active-breadcrumb">
								<a href="{{ route('categories.edit', $row->id) }}">{{ __('packagingtype.edit.title') }} - ({{ $row->unit }})</a>
							</li>
						</ul>
					</div>
					<div class="col-md-3">
						<div class="create-btn pull-right">
							<button type="submit" class="btn custom-create-btn">{{ __('default.form.update-button') }}</button>
						</div>
					</div>
				</div>
			</div><!-- /card finish -->	
		</div><!-- /Page Header -->

		<section class="crud-body">
			<div class="row">
				<div class="col-md-12">

					<div class="card">
						<div class="card-header">
							<h5 class="card-title">
								({{ $row->unit }}) Product Packaging Type Information
							</h5>
						</div>
						
						<div class="card-body">
							<div class="row">
							<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="size" class="required">{{__('default.form.size')}}:</label>
                                        <input type="text" name="size" id="size" class="form-control @error('size') form-control-error @enderror" required="required" value="{{$row->size}}">

                                        @error('size')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="unit" class="required">{{__('default.form.unit')}}:</label>
                                        <input type="text" name="unit" id="unit" class="form-control @error('unit') form-control-error @enderror" required="required" value="{{$row->unit}}">

                                        @error('unit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
									<div class="form-group">
										<label for="status" class="required">{{__("default.form.status")}}:</label>
										<select type="text" name="status" id="status" class="form-control @error('status') form-control-error @enderror" required="required">
											<option value="1" @if($row->status == "1") selected @endif>Active</option>
											<option value="0" @if($row->status == "0") selected @endif>Inactive</option>
										</select>

										@error('status')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
                                </div>
				
								</div> <!-- col-md-12-end -->
							</div> <!-- row-end -->		
						</div> <!-- card-body-end -->

					</div> <!-- card-end -->

				</div> <!-- col-md-12-end -->
			</div> <!-- row-end -->	
		</section> <!-- card-body-end -->
		
	</form>
@endsection


@push('scripts')
<script>
	document.addEventListener("DOMContentLoaded", function() {

	document.getElementById('button-image').addEventListener('click', (event) => {
		event.preventDefault();

		inputId = 'image1';

		window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
	});

	});

	// input
	let inputId = '';
	let output = 'output';

	// set file link
	function fmSetLink($url) {
	document.getElementById(inputId).value = $url;
	document.getElementById(output).src = $url;
	}
</script>
@endpush