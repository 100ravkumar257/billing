@extends('admin.layouts.master')

@section('page_title')
    {{ __('Edit Product Variant') }}
@endsection

@section('content')
    <div class="page-header">
        <div class="card breadcrumb-card">
            <div class="row justify-content-between align-content-between" style="height: 100%;">
                <div class="col-md-6">
                    <h3 class="page-title">{{ __('Edit Product Variant') }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('products.index') }}">{{ __('Products') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                        </li>
                        <li class="breadcrumb-item active-breadcrumb">
                            <a href="{{ route('products.variant.edit', [$product->id, $variant->id]) }}">{{ __('Edit Variant') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- /card finish -->
    </div><!-- /Page Header -->

    <form action="{{ route('products.variant.update', [$product->id, $variant->id]) }}" method="POST">
    <!-- <form action="{{ route('products.variant.store', $product->id) }}" method="POST"> -->
    <form action="{{ route('products.variant.delete', [$product->id, $variantItem->id]) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>

        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sku" class="required">{{ __('SKU') }}:</label>
                    <input type="text" name="sku" value="{{ old('sku', $variant->sku) }}" class="form-control @error('sku') form-control-error @enderror" required>
                    @error('sku')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="size" class="required">{{ __('Size') }}:</label>
                    <input type="number" step="0.01" name="size" value="{{ old('size', $variant->size) }}" class="form-control @error('size') form-control-error @enderror" required>
                    @error('size')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="calculated_size" class="required">{{ __('Calculated Size') }}:</label>
                    <input type="number" step="0.01" name="calculated_size" value="{{ old('calculated_size', $variant->calculated_size) }}" class="form-control @error('calculated_size') form-control-error @enderror" required>
                    @error('calculated_size')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="pcs_per_pack" class="required">{{ __('Pcs Per Pack') }}:</label>
                    <input type="number" name="pcs_per_pack" value="{{ old('pcs_per_pack', $variant->pcs_per_pack) }}" class="form-control @error('pcs_per_pack') form-control-error @enderror" required>
                    @error('pcs_per_pack')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="layers_per_pack" class="required">{{ __('Layers Per Pack') }}:</label>
                    <input type="number" name="layers_per_pack" value="{{ old('layers_per_pack', $variant->layers_per_pack) }}" class="form-control @error('layers_per_pack') form-control-error @enderror" required>
                    @error('layers_per_pack')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="packing_weight" class="required">{{ __('Packing Weight') }}:</label>
                    <input type="number" step="0.01" name="packing_weight" value="{{ old('packing_weight', $variant->packing_weight) }}" class="form-control @error('packing_weight') form-control-error @enderror" required>
                    @error('packing_weight')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- <div class="col-md-3">
                <div class="form-group">
                    <label for="box_weight" class="required">{{ __('Box Weight') }}:</label>
                    <input type="number" step="0.01" name="box_weight" value="{{ old('box_weight', $variant->box_weight) }}" class="form-control @error('box_weight') form-control-error @enderror" required>
                    @error('box_weight')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div> -->

            <div class="col-md-3">
                <div class="form-group">
                    <label for="box_qty" class="required">{{ __('Box Qty') }}:</label>
                    <input type="number" name="box_qty" value="{{ old('box_qty', $variant->box_qty) }}" class="form-control @error('box_qty') form-control-error @enderror" required>
                    @error('box_qty')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
        </div>
    </form>

    <!-- Delete Variant Form -->
    <form action="{{ route('products.variant.destroy', [$product->id, $variant->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">{{ __('Delete Variant') }}</button>
    </form>
@endsection
