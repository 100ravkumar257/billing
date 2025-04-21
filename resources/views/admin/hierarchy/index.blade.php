

@section('content')
    <div class="container">
        <h2>Create Hierarchy</h2>

   
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('hierarchy.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Hierarchy Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="parent_id">Parent Hierarchy</label>
                <select name="parent_id" id="parent_id" class="form-control" required>
                    <option value="0">Select Parent</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Hierarchy</button>
        </form>
    </div>
@endsection
