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
<form action="{{ route('products.variant.store', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Page Header -->
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

    <!-- Product Details Section -->
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="product_name" class="required">{{ __('default.form.product_name') }}:</label>
                <input type="text" name="product_name" id="product_name" class="form-control @error('product_name') form-control-error @enderror" required value="{{$product->name}}">
                @error('product_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="category_id" class="required">{{ __('default.form.category') }}:</label>
                <input type="text" name="category_id" id="category_id" class="form-control @error('category_id') form-control-error @enderror" required value="{{$product->category_id}}">
                @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="brand_id" class="required">{{ __('default.form.brand') }}:</label>
                <input type="text" name="brand_id" id="brand_id" class="form-control @error('brand_id') form-control-error @enderror" required value="{{$product->brand_id}}">
                @error('brand_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <!-- Variants Section -->
    <div id="variants-container">
        <div class="variant-entry row mb-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="sku" class="required">{{ __('default.form.sku') }}:</label>
                    <input type="text" name="sku[]" class="form-control @error('sku') form-control-error @enderror" required>
                    @error('sku')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="size" class="required">{{ __('default.form.size') }}:</label>
                    <input type="number" step="0.01" name="size[]" class="form-control @error('size') form-control-error @enderror" required>
                    @error('size')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="calculated_size" class="required">{{ __('calculated_size') }}:</label>
                    <input type="number" step="0.01" name="calculated_size[]" class="form-control @error('calculated_size') form-control-error @enderror" required>
                    @error('calculated_size')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="pcs_per_pack" class="required">{{ __('pcs_per_pack') }}:</label>
                    <input type="number" name="pcs_per_pack[]" class="form-control @error('pcs_per_pack') form-control-error @enderror" required>
                    @error('pcs_per_pack')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="layers_per_pack" class="required">{{ __('layers_per_pack') }}:</label>
                    <input type="number" name="layers_per_pack[]" class="form-control @error('layers_per_pack') form-control-error @enderror" required>
                    @error('layers_per_pack')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="packing_weight" class="required">{{ __('packing_weight') }}:</label>
                    <input type="number" step="0.01" name="packing_weight[]" class="form-control @error('packing_weight') form-control-error @enderror" required>
                    @error('packing_weight')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="box_weight" class="required">{{ __('box_weight') }}:</label>
                    <input type="number" step="0.01" name="box_weight[]" class="form-control @error('box_weight') form-control-error @enderror" required>
                    @error('box_weight')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="box_qty" class="required">{{ __('box_qty') }}:</label>
                    <input type="number" name="box_qty[]" class="form-control @error('box_qty') form-control-error @enderror" required>
                    @error('box_qty')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-secondary" onclick="addVariant()">Add Variant</button>

    <!-- Status Section -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="status" class="required">{{ __("default.form.status") }}:</label>
                <select name="status" id="status" class="form-control @error('status') form-control-error @enderror" required>
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        function addVariant() {
            let container = document.getElementById("variants-container");
            let variantEntry = document.createElement("div");
            variantEntry.classList.add("row", "variant-entry", "mb-3");

            variantEntry.innerHTML = `
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="sku" class="required">{{ __('default.form.sku') }}:</label>
                        <input type="text" name="sku[]" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="size" class="required">{{ __('default.form.size') }}:</label>
                        <input type="number" step="0.01" name="size[]" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="calculated_size" class="required">{{ __('default.form.calculated_size') }}:</label>
                        <input type="number" step="0.01" name="calculated_size[]" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pcs_per_pack" class="required">{{ __('default.form.pcs_per_pack') }}:</label>
                        <input type="number" name="pcs_per_pack[]" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="layers_per_pack" class="required">{{ __('default.form.layers_per_pack') }}:</label>
                        <input type="number" name="layers_per_pack[]" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="packing_weight" class="required">{{ __('default.form.packing_weight') }}:</label>
                        <input type="number" step="0.01" name="packing_weight[]" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="box_weight" class="required">{{ __('box_weight') }}:</label>
                        <input type="number" step="0.01" name="box_weight[]" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="box_qty" class="required">{{ __('box_qty') }}:</label>
                        <input type="number" name="box_qty[]" class="form-control" required>
                    </div>
                </div>

                <button type="button" onclick="removeVariant(this.closest('.variant-entry'))">Remove Variant</button>
            `;

            container.appendChild(variantEntry);
        }

        function removeVariant(variantEntry) {
            variantEntry.remove();
        }
    </script>
@endpush

@endsection
