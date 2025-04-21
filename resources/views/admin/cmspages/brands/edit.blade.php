@extends('admin.layouts.master')

@section('page_title')
    {{ __('brand.edit.title') }}
@endsection

@push('css')
    <style>
        #output {
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <form method="POST" action="{{ route('brands.update', $brand->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">{{ __('brand.index.title') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('brands.index') }}">{{ __('brand.index.title') }}</a>
                            </li>
                            <li class="breadcrumb-item active-breadcrumb">
                                <a href="{{ route('brands.edit', $brand->id) }}">{{ __('brand.edit.title') }} - ({{ $brand->name }})</a>
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
                            <h5 class="card-title">{{ __('brand.edit.brand-info') }} - ({{ $brand->name }})</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="name" class="required">{{ __('default.form.name') }}:</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{ old('name', $brand->name) }}">

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug" class="required">{{ __('default.form.slug') }}:</label>
                                        <input type="text" name="slug" id="slug" class="form-control @error('slug') form-control-error @enderror" value="{{ old('slug', $brand->slug) }}" readonly>

                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status" class="required">{{ __('default.form.status') }}:</label>
                                        <select type="text" name="status" id="status" class="form-control @error('status') form-control-error @enderror" required="required">
                                            <option value="1" @if($brand->status == 1) selected @endif>{{ __('default.form.active') }}</option>
                                            <option value="0" @if($brand->status == 0) selected @endif>{{ __('default.form.inactive') }}</option>
                                        </select>

                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Image Field -->
                                    <div class="form-group">
                                        <label for="image">{{ __('default.form.image') }}:</label>
                                        <input type="file" name="image" id="image" class="form-control @error('image') form-control-error @enderror">

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Display Current Image -->
                                    @if($brand->image)
                                        <div class="form-group">
                                            <img src="{{ asset('storage/brands/' . $brand->image) }}" alt="Current Brand Image" width="100" height="100">
                                        </div>
                                    @else
                                    <p>No Image </p>
                                    @endif

                                </div> <!-- /col-md-12 -->
                            </div> <!-- /row -->
                        </div> <!-- /card-body-finish -->

                    </div> <!-- card-finish -->

                </div> <!-- /col-md-12 -->
            </div> <!-- row-finish -->
        </section> <!-- card-body-finish -->

    </form>
@endsection

@push('scripts')
<script type="text/javascript">
    $("#name").keyup(function(){
        var name = this.value;
        name = name.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
        $("#slug").val(name);
    });
</script>
@endpush
