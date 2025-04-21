@extends('admin.layouts.master')

@section('page_title')
    {{ __('testimonial.create.title') }}
@endsection

@push('css')
    <style>
        #output {
            height: 300px;
            width: 300px;
        }
    </style>
@endpush

@section('content')
    <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">{{ __('testimonial.create.title') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">{{ __('testimonial.index.title') }}</a></li>
                            <li class="breadcrumb-item active-breadcrumb"><a href="{{ route('admin.testimonials.create') }}">{{ __('testimonial.create.title') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="create-btn pull-right">
                            <button type="submit" class="btn custom-create-btn">{{ __('default.form.save-button') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-12" style="margin: auto;">
                    <div class="input-group mb-5">
                        <img src="" alt="..." id="output" class="img-thumbnail rounded mx-auto d-block mb-3" onerror="this.src='{{ asset('assets/admin/img/default-user.png') }}';">
                        <input type="text" hidden id="image1" class="form-control" name="image">
                        <div class="input-group-append" style="width: 100%;">
                            <button class="btn btn-secondary btn-lg btn-block" type="button" id="button-image">
                            <i data-feather="image" class="feather-icon"></i> Select Testimonial Image
                            </button>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Testimonial Details</h5>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="required">{{ __('default.form.name') }}:</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required value="{{ old('name') }}">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="position" class="required">{{ __('default.form.position') }}:</label>
                                <input type="text" name="position" id="position" class="form-control @error('position') form-control-error @enderror" required value="{{ old('position') }}">

                                @error('position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="required">{{ __('default.form.description') }}:</label>
                                <textarea name="description" id="description" rows="4" class="form-control @error('description') form-control-error @enderror" required>{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status" class="required">{{ __('default.form.status') }}:</label>
                                <select name="status" id="status" class="form-control @error('status') form-control-error @enderror" required>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('default.form.active') }}</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('default.form.inactive') }}</option>
                                </select>

                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@push('scripts')
<script>
function changeTestimonialStatus(checkbox, id) {
    var status = checkbox.checked ? 1 : 0;

    // Send the status update via AJAX
    $.ajax({
        url: '{{ route('admin.testimonials.update') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: id,
            status: status
        },
        success: function(response) {
            toastr.success(response.message);
        },
        error: function() {
            toastr.error('An error occurred while updating the status.');
        }
    });
}

</script>
@endpush
