@extends('admin.layouts.master')

@section('page_title')
    {{__('brands.create.title')}}
@endsection

@push('css')
    <style>
        #output {
            width: 100%;
        }
    </style>
@endpush
  
@section('content')
    <form method="post" action="{{ route('brands.store') }}" enctype="multipart/form-data">
        @csrf() 

        <div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">{{__('brands.index.title')}}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('currencies.index') }}">{{ __('brands.index.title') }}</a>
                            </li>
                            <li class="breadcrumb-item active-breadcrumb">
                                <a href="{{ route('currencies.create') }}">{{ __('brands.create.title') }}</a>
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
                        
                     
                        
                        <div class="card-body"> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="required">{{__('default.form.name')}}:</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{old('name')}}">

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                <div class="form-group">
                                        <label for="image">{{ __('default.form.image') }}:</label>
                                        <input type="file" name="image" id="image" class="form-control @error('image') form-control-error @enderror">

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status" class="required">{{__("default.form.status")}}:</label>
                                        <select type="text" name="status" id="status" class="form-control @error('status') form-control-error @enderror" required="required">
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
