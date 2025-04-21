@extends('admin.layouts.master')

@section('page_title')
    {{ __('cms.create.title') }}
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
    <div class="container mt-5 ">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Product Variant Form</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Selection -->
                    <h5 class="mb-3">Product</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">{{ __('default.form.product_name') }}</label>
                            <input type="text" name="product_id" class="form-control" value="{{ old('product_id') }}" required>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ __('default.form.category') }}</label>
                            <select name="category_id" class="form-select @error('category_id') form-control-error @enderror" required>
                                <option>{{ __('default.form.select_category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ __('default.form.brand') }}</label>
                            <select name="brand_id" class="form-select @error('brand_id') form-control-error @enderror" required>
                                <option>{{ __('default.form.select_brands') }}</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>

                    <!-- Variant Details Section -->
                    <h5 class="mb-3">Variant Details</h5>
                    <div id="variants-container">
                        <div class="row variant-entry mb-3">
                            <div class="col-md-3">
                                <label class="form-label">{{ __('default.form.size') }} (ml)</label>
                                <select name="variant_size[]" class="form-select @error('variant_size') form-control-error @enderror">
                                    <option>200ml</option>
                                    <option>400ml</option>
                                    <option>600ml</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">{{ __('default.form.calculated_size') }} (kg)</label>
                                <input type="text" name="calculated_size[]" class="form-control" value="0.2kg">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">{{ __('default.form.density') }}</label>
                                <input type="number" name="density[]" class="form-control @error('density') form-control-error @enderror" placeholder="Density" value="{{ old('density') }}">
                                @error('density')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">{{ __('default.form.packaging_weight') }} (kg)</label>
                                <input type="number" name="packaging_weight[]" class="form-control" placeholder="Weight" value="{{ old('packaging_weight') }}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Packaging Details -->
                    <h5 class="mb-3">Packaging Details</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">{{ __('default.form.pcs_per_pack') }}</label>
                            <input type="number" name="pcs_per_pack" class="form-control" placeholder="Enter Pcs" value="{{ old('pcs_per_pack') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ __('default.form.layers_per_pack') }}</label>
                            <input type="number" name="layers_per_pack" class="form-control" placeholder="Enter Layers" value="{{ old('layers_per_pack') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ __('default.form.total_pack_size') }}</label>
                            <input type="text" name="total_pack_size" class="form-control" placeholder="Auto-calculated" readonly>
                        </div>
                    </div>

                    <hr>

                    <!-- Pricing & Inventory -->
                    <h5 class="mb-3">Pricing & Inventory</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">{{ __('default.form.price') }}</label>
                            <input type="number" name="price" class="form-control" placeholder="₹" value="{{ old('price') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ __('default.form.stock') }}</label>
                            <input type="number" name="stock" class="form-control" placeholder="Stock Quantity" value="{{ old('stock') }}">
                        </div>
                    </div>

                    <!-- Add New Variant Button -->
                    <button class="btn btn-outline-primary mt-3" type="button" onclick="addVariant()">+ Add New Variant</button>

                    <hr>

                    <!-- Status Selection -->
                    <div class="col-md-4">
                        <label class="form-label">{{ __('default.form.status') }}</label>
                        <select name="status" class="form-select @error('status') form-control-error @enderror" required>
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success w-100">{{ __('default.form.save_button') }}</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addVariant() {
            let container = document.getElementById("variants-container");
            let variantEntry = document.createElement("div");
            variantEntry.classList.add("row", "variant-entry", "mb-3");

            variantEntry.innerHTML = `
                <div class="col-md-3">
                    <label class="form-label">{{ __('default.form.size') }} (ml)</label>
                    <select name="variant_size[]" class="form-select">
                        <option>200ml</option>
                        <option>400ml</option>
                        <option>600ml</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ __('default.form.calculated_size') }} (kg)</label>
                    <input type="text" name="calculated_size[]" class="form-control" value="0.2kg">
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ __('default.form.density') }}</label>
                    <input type="number" name="density[]" class="form-control" placeholder="Density">
                </div>
                <div class="col-md-3">
                    <label class="form-label">{{ __('default.form.packaging_weight') }} (kg)</label>
                    <input type="number" name="packaging_weight[]" class="form-control" placeholder="Weight">
                </div>
            `;

            container.appendChild(variantEntry);
        }

        // JavaScript function to calculate total pack size dynamically
        document.querySelectorAll("input[name='pcs_per_pack'], input[name='layers_per_pack']").forEach(input => {
            input.addEventListener("input", calculateTotalPackSize);
        });

        function calculateTotalPackSize() {
            let pcsPerPack = parseFloat(document.querySelector("input[name='pcs_per_pack']").value) || 0;
            let layersPerPack = parseFloat(document.querySelector("input[name='layers_per_pack']").value) || 0;
            let totalPackSize = pcsPerPack * layersPerPack;
            document.querySelector("input[name='total_pack_size']").value = totalPackSize.toFixed(2);
        }
    </script>
@endsection
