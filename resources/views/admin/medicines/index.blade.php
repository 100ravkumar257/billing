@extends('layouts.admin') {{-- Adjust this if your layout file has a different name --}}

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">All Medicines</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.medicines.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Add Medicine</a>

    <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Category</th>
                <th class="py-2 px-4 border-b">Price</th>
                <th class="py-2 px-4 border-b">Stock</th>
                <th class="py-2 px-4 border-b">Expiry</th>
                <th class="py-2 px-4 border-b">Prescription</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($medicines as $medicine)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $medicine->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $medicine->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $medicine->category->name ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">₹{{ number_format($medicine->price, 2) }}</td>
                    <td class="py-2 px-4 border-b">{{ $medicine->stock }}</td>
                    <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($medicine->expiry_date)->format('M Y') }}</td>
                    <td class="py-2 px-4 border-b">
                        @if($medicine->prescription_required)
                            <span class="text-red-600 font-semibold">Yes</span>
                        @else
                            <span class="text-green-600 font-semibold">No</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('admin.medicines.edit', $medicine->id) }}" class="text-blue-600 hover:underline">Edit</a> |
                        <form action="{{ route('admin.medicines.destroy', $medicine->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this medicine?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="py-4 px-4 text-center text-gray-500">No medicines found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
 