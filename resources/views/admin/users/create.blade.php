@extends('admin.layouts.master')

@section('page_title')
    {{ __('user.create.title') }}
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
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="page-header">
            <div class="card breadcrumb-card">
                <div class="row justify-content-between align-content-between" style="height: 100%;">
                    <div class="col-md-6">
                        <h3 class="page-title">{{__('user.index.title')}}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('users.index') }}">{{ __('user.index.title') }}</a></li>
                            <li class="breadcrumb-item active-breadcrumb"><a
                                    href="{{ route('users.create') }}">{{ __('user.create.title') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="create-btn pull-right">
                            <button type="submit"
                                class="btn custom-create-btn">{{ __('default.form.save-button') }}</button>
                        </div>
                    </div>
                </div>
            </div><!-- /card finish -->	
        </div><!-- /Page Header -->


        <div class="card-body">

            <!-- <div class="row">
                <div class="col-md-4 col-sm-12" style="margin: auto;">
                    <div class="input-group mb-5">
                            <img src="" alt="..." id="output" class="img-thumbnail rounded mx-auto d-block mb-3" onerror="this.src='{{ asset('assets/admin/img/default-user.png') }}';">

                        <input type="text" hidden id="image1" class="form-control" name="image">
                        <div class="input-group-append" style="width: 100%;">
                            <button class="btn btn-secondary btn-lg btn-block" type="button" id="button-image">
                            <i data-feather="image" class="feather-icon"></i>
                            Select User's Image
                            </button>
                        </div>
                    </div>
                </div>
            </div>  -->

            <div class="row">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Personal Information
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="required">{{ __('default.form.name') }}:</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') form-control-error @enderror" required="required" value="{{ old('name') }}">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="mobile" class="required">{{ __('default.form.mobile') }}:</label>
                                <input type="number" name="mobile" id="mobile" class="form-control @error('mobile') form-control-error @enderror"  required="required" value="{{ old('mobile') }}">

                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="approver" class="required">Approver Status</label>
                                <select name="approver" id="approver" class="form-control">
                                    <option value="">-- Select Approver Status --</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('approver')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> <!-- card-body-end -->
                    </div><!-- card-end -->
                </div> <!-- col-md-4-end -->

                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">
                            Authentication
                        </h5>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="email" class="required">{{ __('default.form.email') }}:</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') form-control-error @enderror" required="required" value="{{ old('email') }}">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="required">{{ __('default.form.password') }}:</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') form-control-error @enderror" required="required">

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="required">{{ __('default.form.password-confirm') }}:</label>
                                <input type="password" name="confirm-password" id="password-confirm" class="form-control @error('password-confirm') form-control-error @enderror" required="required">

                                @error('confirm-password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> <!-- card-body-end -->
                    </div> <!-- card-end -->
                </div> <!-- col-md-4-end -->

                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">
                            Role & Permission
                        </h5>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="roles" class="required">{{ __('default.form.role') }}</label>
                                <select name="roles" id="roles" class="select2" >
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('roles')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> <!-- card-body-end -->

                        <h5 class="card-header">
                            Parents
                        </h5>

                        <div class="card-body" id="parent-container" style="display: none;">
                            <div class="form-group">
                                <label for="parent_id" class="required">Select Parent Users</label>
                                <select name="parent_id" id="parent_id" class="select2">
                                    <option value="">-- Select Parent User --</option>
                                    <!-- @foreach ($users as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach -->
                                </select>

                                @error('parent_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> <!-- card-body-end -->
                    </div> <!-- card-end -->
                </div> <!-- col-md-4-end -->

            </div> <!-- row-end -->

        </div> <!-- card-body-end -->

    </form>
@endsection


@push('scripts')
<script>
    $('#roles').on('change', function() {
        var selectedRole = $(this).val();

        if (selectedRole) {
        $('#parent-container').show();
            $.ajax({
                url: 'get-parent-users-by-role', 
                type: 'GET',
                data: { role: selectedRole },
                success: function(response) {
                    var parentRoleSelect = $('#parent_id');
                    parentRoleSelect.empty(); 
                    parentRoleSelect.append('<option value="">-- Select Parent Role --</option>');
                    console.log('response',response)
                    $.each(response.data, function(index, user) {
                        parentRoleSelect.append('<option value="' + user.id + '">' + user.name + '</option>');
                    });

                    parentRoleSelect.trigger('change');
                }
            });
        } else {
            $('#parent-container').hide();
            $('#parent_id').empty().append('<option value="">-- Select Parent Role --</option>');
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
	document.getElementById('button-image').addEventListener('click', (event) => {
		event.preventDefault();
		inputId = 'image1';
		window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
		});
	});

	let inputId = '';
	let output = 'output';

	function fmSetLink($url) {
        document.getElementById(inputId).value = $url;
        document.getElementById(output).src = $url;
	}

</script>
@endpush
