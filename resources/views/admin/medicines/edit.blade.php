@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Edit Medicine</h2>

    <form action="{{ route('admin.medicines.update', $medicine->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $medicine->name }}" class="w-full border p-2" required>

        <select name="category_id" class="w-full border p-2">
            <option value="">-- Select Category --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @if($medicine->category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
            @endforeach
        </select>

        <input type="number" step="0.01" name="price" value="{{ $medicine->price }}" class="w-full border p-2" required>
        <input type="number" name="stock" value="{{ $medicine->stock }}" class="w-full border p-2" required>
        <input type="date" name="expiry_date" value="{{ $medicine->expiry_date }}" class="w-full border p-2" required>

        <label class="inline-flex items-center">
            <input type="checkbox" name="prescription_required" value="1" class="mr-2" @if($medicine->prescription_required) checked @endif>
            Requires Prescription
        </label>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
