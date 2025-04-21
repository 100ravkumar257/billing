@extends('admin.layouts.master')

@section('page_title')
    {{ __('cms.create.title') }}
@endsection

@push('css')
    <style>
 
        .form-container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }

        .form-container .form-section {
            width: 65%; 
        }

        .form-container .list-section {
            width: 30%; 
            padding-left: 20px;
        }

       
        .card {
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .card-header {
            background-color: #f7f7f7;
        }

  
        .list-section ul {
            list-style-type: none;
            padding: 0;
        }

        .list-section ul li {
            background-color: #f1f1f1;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
        }
    </style>
@endpush

@section('content')
    <form action="{{ route('hierarchy.store') }}" method="POST">
        @csrf

        <div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">{{ __('Hierarchy.create') }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
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

        <section class="crud-body">
            <div class="form-container">
               
                <div class="form-section">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ __('Hierarchy-Form') }}</h5>
                        </div>

                        <div class="card-body">
                            @if(session('success'))
                                <p style="color: green;">{{ session('success') }}</p>
                            @endif

                            @if($errors->any())
                                <div style="color: red;">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="name" class="required">{{ __('default.form.name') }}:</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" value="{{ old('name') }}" required="required">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="parent_id" class="required">{{ __('parent_id') }}:</label>
                                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') form-control-error @enderror" required="required">
                                    <option value="0" {{ old('parent_id') == 0 ? 'selected' : '' }}>None</option>
                                    @foreach($parents as $hierarchy)
                                        <option value="{{ $hierarchy->id }}" {{ old('parent_id') == $hierarchy->id ? 'selected' : '' }}>
                                            {{ $hierarchy->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> 

                            <div class="form-group">
                                <label for="description" class="required">{{ __('default.form.description') }}:</label>
                                <textarea name="description" id="description" rows="5" class="form-control @error('description') form-control-error @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status" class="required">{{ __('default.form.status') }}:</label>
                                <select name="status" id="status" class="form-control @error('status') form-control-error @enderror" required="required">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div> 
                </div>

              
                <!-- <div class="list-section">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Parent Hierarchy</h5>
                        </div>

                        <div class="card-body">
                            <ul>
                                @foreach($parents as $hierarchy)
                                    <li><strong>{{ $hierarchy->name }}</strong> (ID: {{ $hierarchy->id }})</li>
                                @endforeach
                            </ul>
                        </div>
                    </div> 
                </div> -->
                <div class="list-section">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Parent Hierarchy</h5>
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Parent Name</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($parents as $hierarchy)
                                        <tr>
                                            <td>{{ $hierarchy->id }}</td>
                                            <td>{{ $hierarchy->name }}</td>
                                            <td>
                                                
                                                @if($hierarchy->parent_id)
                                                    @php
                                                        $parent = $parents->firstWhere('id', $hierarchy->parent_id);
                                                    @endphp
                                                    {{ $parent ? $parent->name : '0' }}
                                                @else
                                                    No Parent
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </form>
@endsection
