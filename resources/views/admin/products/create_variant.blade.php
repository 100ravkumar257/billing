@extends('admin.layouts.master')

@section('page_title')
{{ isset($variant) ? __('product.edit.title') : __('product.create.title') }}
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
<form
    action="{{ isset($variant) ? route('products.variant.update', [$product->id, $variant->id]) : route('products.variant.store', $product->id) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($variant))
        @method($variant ? 'PUT' : 'POST')
    @endif

    <div class="page-header">
        <div class="card breadcrumb-card">
            <div class="row justify-content-between align-content-between" style="height: 100%;">
                <div class="col-md-6">
                    <h3 class="page-title">{{ isset($variant) ? __('Variant Edit') : __('Variant Create') }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('products.index') }}">{{ __('product.index.title') }}</a>
                        </li>
                        <li class="breadcrumb-item active-breadcrumb">
                            <a href="{{ route('products.create') }}">{{ __('Variants') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="create-btn pull-right">
                        <button type="submit"
                            class="btn custom-create-btn">{{ isset($variant) ? __('default.form.update-button') : __('default.form.save-button') }}</button>
                    </div>
                </div>
            </div>
        </div><!-- /card finish -->
    </div><!-- /Page Header -->

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h2>{{ $product->name }}</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-center mb-0" id="table">
                        <h5>Variants-Table</h5>
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>SKU</th>
                                <th>Size(Variant Name)</th>
                                <th>Calculated Size(In Kg)</th>
                                <th>Pcs per Pack</th>
                                <th>Layers</th>
                                <th>Packing Weight</th>
                                
                                <th>Box Qty</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->variants as $variantItem)
                                <tr>
                                    <td>{{ $variantItem->id }}</td>
                                    <td>{{ $variantItem->sku }}</td>
                                    <td>{{ $variantItem->size }}</td>
                                    <td>{{ $variantItem->calculated_size }}</td>
                                    <td>{{ $variantItem->pcs_per_pack }}</td>
                                    <td>{{ $variantItem->layers_per_pack }}</td>
                                    <td>{{ $variantItem->packing_weight }}</td>
                                    <td>{{ $variantItem->box_qty }}</td>
                                    <td>{{ $variantItem->price }}</td>
                                    <td>{{ $variantItem->status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="?vid={{ $variantItem->id }}" class="btn btn-primary btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm remove-product"
                                            data-id="{{ $variantItem->id }}" 
                                            data-action="{{ route('products.variant.destroy', [$product->id, $variantItem->id]) }}">
                                            <i class="fe fe-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <section class="crud-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"> Variants Form</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div id="variants-container">
                                <div class="variant-entry row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sku" class="required">{{ __('default.form.sku') }}:</label>
                                            <input type="text" name="sku[]"
                                                class="form-control @error('sku.*') form-control-error @enderror"
                                                value="{{ old('sku[]', isset($variant) ? $variant->sku : '') }}"
                                                placeholder="Enter SKU" required>
                                            @error('sku.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="size" class="required">{{ __('Size (Variant Name)') }}:</label>
                                            <input type="text" step="0.01" name="size[]"
                                                class="form-control @error('size.*') form-control-error @enderror"
                                                value="{{ old('size[]', isset($variant) ? $variant->size : '') }}"
                                                placeholder="Enter Size (Variant Name)" required>
                                            @error('size.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="calculated_size"
                                                class="required">{{ __('Calculated Size (In Kg)') }}:</label>
                                            <input type="number" step="0.01" name="calculated_size[]"
                                                class="form-control @error('calculated_size.*') form-control-error @enderror"
                                                value="{{ old('calculated_size[]', isset($variant) ? $variant->calculated_size : '') }}"
                                                placeholder="Calculated Size (In Kg)" required readonly>
                                            @error('calculated_size.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pcs_per_pack" class="required">{{ __('Pcs Per Layers') }}:</label>
                                            <input type="number" name="pcs_per_pack[]"
                                                class="form-control @error('pcs_per_pack.*') form-control-error @enderror"
                                                value="{{ old('pcs_per_pack[]', isset($variant) ? $variant->pcs_per_pack : '') }}"
                                                placeholder="Enter Pcs per Pack" required>
                                            @error('pcs_per_pack.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="layers_per_pack"
                                                class="required">{{ __('Layers Per Box') }}:</label>
                                            <input type="number" name="layers_per_pack[]"
                                                class="form-control @error('layers_per_pack.*') form-control-error @enderror"
                                                value="{{ old('layers_per_pack[]', isset($variant) ? $variant->layers_per_pack : '') }}"
                                                placeholder="Enter Layers per Pack" required>
                                            @error('layers_per_pack.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="packing_weight"
                                                class="required">{{ __('Packing Weight') }}:</label>
                                            <input type="number" step="0.01" name="packing_weight[]"
                                                class="form-control @error('packing_weight.*') form-control-error @enderror"
                                                value="{{ old('packing_weight[]', isset($variant) ? $variant->packing_weight : '') }}"
                                                placeholder="Enter Packing Weight" required readonly>
                                            @error('packing_weight.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="box_qty" class="required">{{ __('Box Qty') }}:</label>
                                            <input type="number" name="box_qty[]"
                                                class="form-control @error('box_qty.*') form-control-error @enderror"
                                                value="{{ old('box_qty[]', isset($variant) ? $variant->box_qty : '') }}"
                                                placeholder="Enter Box Quantity" required readonly>
                                            @error('box_qty.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price" class="required">{{ __('Price') }}:</label>
                                            <input type="number" step="0.01" name="price[]" 
                                                class="form-control @error('price.*') form-control-error @enderror"
                                                value="{{ old('price[]', isset($variant) ? $variant->price : '') }}"
                                                placeholder="Enter Box price" required>

                                            @error('price.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit"
                                    class="btn btn-secondary">{{ isset($variant) ? __('default.form.update-button') : __('default.form.save-button') }}</button>
                            </div>
                        </div> <!-- card-body-end -->
                    </div> <!-- card-end -->
                </div> <!-- col-md-12-end -->
            </div> <!-- row-end -->
    </section>

</form>

@push('scripts')
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const productDensity = {{ $product->density ?? 1 }};  

    const pcsPerPackInputs = document.querySelectorAll('input[name="pcs_per_pack[]"]');
    const layersPerPackInputs = document.querySelectorAll('input[name="layers_per_pack[]"]');
    const boxQtyInputs = document.querySelectorAll('input[name="box_qty[]"]');
    const packingWeightInputs = document.querySelectorAll('input[name="packing_weight[]"]');
    const calculatedSizeInputs = document.querySelectorAll('input[name="calculated_size[]"]');
    const sizeInputs = document.querySelectorAll('input[name="size[]"]'); 

    function updateBoxQty() {
        pcsPerPackInputs.forEach((input, index) => {
            const pcsPerPack = parseFloat(input.value) || 0;
            const layersPerPack = parseFloat(layersPerPackInputs[index].value) || 0;
            const boxQty = pcsPerPack * layersPerPack; 
            boxQtyInputs[index].value = boxQty;
            updateCalculatedSize(index);  
        });
    }

    function updatePackingWeight(index) {
        const calculatedSize = parseFloat(calculatedSizeInputs[index].value) || 0;
        const boxQty = parseFloat(boxQtyInputs[index].value) || 0;
        const packingWeight = calculatedSize * boxQty;
        packingWeightInputs[index].value = packingWeight.toFixed(2);
    }

    function updateCalculatedSize(index) {
        const sizeValue = sizeInputs[index].value.trim(); 
        if (sizeValue.toLowerCase().includes('ml')) {
            const sizeInMl = parseFloat(sizeValue.replace('ml', '').trim()); 
            if (!isNaN(sizeInMl)) {
                const weightInKg = (sizeInMl * productDensity) / 1000;  
                calculatedSizeInputs[index].value = weightInKg.toFixed(2); 
            } else {
                calculatedSizeInputs[index].value = ''; 
            }
        }
        else if (sizeValue.toLowerCase().includes('l')) {
            const sizeInL = parseFloat(sizeValue.replace('L', '').trim()); 
            if (!isNaN(sizeInL)) {
                const weightInKg = sizeInL * productDensity;  
                calculatedSizeInputs[index].value = weightInKg.toFixed(2); 
            } else {
                calculatedSizeInputs[index].value = ''; 
            }
        }
        else {
            const sizeInKg = parseFloat(sizeValue);
            if (!isNaN(sizeInKg)) {
                calculatedSizeInputs[index].value = sizeInKg.toFixed(2); 
            } else {
                calculatedSizeInputs[index].value = ''; 
            }
        }
        updatePackingWeight(index);  
    }

    sizeInputs.forEach((input, index) => {
        input.addEventListener('input', function() {
            updateCalculatedSize(index);
        });
    });

    pcsPerPackInputs.forEach(input => input.addEventListener('input', updateBoxQty));
    layersPerPackInputs.forEach(input => input.addEventListener('input', updateBoxQty));

    sizeInputs.forEach((input, index) => {
        updateCalculatedSize(index);
    });

    updateBoxQty(); 
});

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.remove-product');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const variantId = button.getAttribute('data-id');
            const deleteUrl = button.getAttribute('data-action');

            if (confirm('Are you sure you want to delete this variant?')) {
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = button.closest('tr');
                        row.remove();
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                })
                .catch(error => {
                    alert('Error occurred while deleting the variant.');
                });
            }
        });
    });
});

    </script>
    
@endpush

@endsection
