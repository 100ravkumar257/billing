@extends('admin.layouts.master')

@section('page_title')
    {{ __('testimonials.index.title') }}
@endsection

@push('css')
    <style>
        .table tr td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
	<div class="page-header">
		<div class="card breadcrumb-card">
			<div class="row justify-content-between align-content-between" style="height: 100%;">
				<div class="col-md-6">
					<h3 class="page-title">{{ __('testimonials.index.title') }}</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active-breadcrumb">
							<a href="{{ route('testimonials.index') }}">{{ __('testimonials.index.title') }}</a>
						</li>
					</ul>
				</div>
				<div class="col-md-3">
                    <div class="create-btn pull-right">
                        <a href="{{ route('testimonials.create') }}" class="btn custom-create-btn">{{ __('default.form.add-button') }}</a>
                    </div>                 
                </div>
			</div>
		</div><!-- /card finish -->	
	</div><!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-center mb-0" id="table">
                        <thead>
                            <tr>
                                <th class="">{{ __('default.table.sl') }}</th>
                                <th class="">{{ __('default.table.name') }}</th>
                                <th class="">{{ __('default.table.position') }}</th>
                                <th class="">{{ __('default.table.status') }}</th>
                                <th class="">{{ __('default.table.action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($testimonials as $testimonial)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->position }}</td>
                                    <td>
                                        <span class="badge {{ $testimonial->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $testimonial->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        
                                        <form action="{{ route('testimonials.destroy') }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $testimonial->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>

                                        <a href="{{ route('testimonials.status_update', ['id' => $testimonial->id]) }}" class="btn btn-info btn-sm">
                                            {{ $testimonial->status ? 'Deactivate' : 'Activate' }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No testimonials found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $testimonials->links() }}
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
        
$(document).ready(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('testimonials.index') }}", 
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'name', name: 'name' },
            { data: 'position', name: 'position' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
            
        ],
        error: function(xhr, error, thrown) {
            console.log('AJAX Error: ', error);
            console.log('XHR: ', xhr);
            console.log('Thrown: ', thrown);
        }
    });
});

        function changeTestimonialStatus(_this, id) {
            var status = $(_this).prop('checked') == true ? 1 : 0;
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: `{{ route('testimonials.status_update') }}`,
                type: 'GET',
                data: {
                    _token: _token,
                    id: id,
                    status: status
                },
                success: function(result) {
                    if(status == 1){
                        toastr.success(result.message);
                    }else{
                        toastr.error(result.message);
                    } 
                }
            });
        }
    </script>

@endpush
