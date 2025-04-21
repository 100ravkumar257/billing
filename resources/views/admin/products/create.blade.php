@extends('admin.layouts.master')

@section('page_title')
    {{ __('product.create.title') }}
@endsection

@push('css')
    <style>
        #output {
            width: 100%;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush

@section('content')
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">{{ __('product.create.title') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('products.index') }}">{{ __('product.index.title') }}</a>
                            </li>
                            <li class="breadcrumb-item active-breadcrumb">
                                <a href="{{ route('products.create') }}">{{ __('product.create.title') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="create-btn pull-right">
                            <button type="submit" class="btn custom-create-btn">{{ __('default.form.save-button') }}</button>
                        </div>
                    </div>
                </div>
            </div><!-- /card finish -->
        </div><!-- /Page Header -->

        <section class="crud-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h5 class="card-title"> Product Information</h5>
                        </div> -->

                        <div class="card-body">
                            <div class="row">


                                <!-- Category -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id" class="required">{{ __('default.form.category') }}:</label>
                                        <select name="category_id" id="category_id" class="form-control @error('category_id') form-control-error @enderror" required>
                                            <option value="" disabled selected>{{ __('default.form.choose_category') }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Brand -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brand_id" class="required">{{ __('default.form.brand') }}:</label>
                                        <select name="brand_id" id="brand_id" class="form-control @error('brand_id') form-control-error @enderror" required>
                                            <option value="" disabled selected>{{ __('default.form.choose_brand') }}</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Product Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="required">{{ __('default.form.product_name') }}:</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Product Slug -->
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug" class="required">{{ __('default.form.slug') }}:</label> -->
                                        <input type="text" name="slug" id="slug" class="form-control @error('slug') form-control-error @enderror" required value="{{ old('slug') }}" style="display: none;">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    <!-- </div>
                                </div> -->
                                <!-- Density -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="density" class="required">{{ __('default.form.density') }} (g/cm³):</label>
                                        <input type="number" step="0.01" name="density" id="density" class="form-control @error('density') form-control-error @enderror" required value="{{ old('density') }}">
                                        @error('density')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Short Description -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="short_desc" class="required">{{ __('default.form.short_description') }}:</label>
                                        <textarea rows="3" name="short_desc" id="short_desc" class="form-control @error('short_desc') form-control-error @enderror" required>{{ old('short_desc') }}</textarea>
                                        @error('short_desc')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <!-- Image -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image" class="required">{{ __('default.form.upload_image') }}</label>
                                        <input type="file" name="image" id="image" class="form-control @error('image') form-control-error @enderror" required value="{{ old('image') }}">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="required">{{ __("default.form.status") }}:</label>
                                        <select type="text" name="status" id="status" class="form-control @error('status') form-control-error @enderror" required>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div> <!-- card-body-end -->
                    </div> <!-- card-end -->
                </div> <!-- col-md-12-end -->
            </div> <!-- row-end -->
        </section>
    </form>
@endsection

@push('scripts')
<script>
window.onload = function () {
    let nameInput = document.getElementById("name");
    let slugInput = document.getElementById("slug");

    if (nameInput && slugInput) {
        nameInput.addEventListener("input", function() {
            // Automatically generate the slug when name is changed
            let slug = nameInput.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
            slugInput.value = slug;
        });
    }
};
</script>
@endpush
