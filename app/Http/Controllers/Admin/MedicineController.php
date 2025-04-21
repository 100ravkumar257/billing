<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Category;
class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('category')->get();
        return view('admin.medicines.index', compact('medicines'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.medicines.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'expiry_date' => 'required|date',
            'prescription_required' => 'boolean'
        ]);

        Medicine::create($request->all());

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine added.');
    }

    public function edit(Medicine $medicine)
    {
        $categories = Category::all();
        return view('admin.medicines.edit', compact('medicine', 'categories'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'expiry_date' => 'required|date',
            'prescription_required' => 'boolean'
        ]);

        $medicine->update($request->all());

        return redirect()->route('admin.medicines.index')->with('success', 'Medicine updated.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('admin.medicines.index')->with('success', 'Medicine deleted.');
    }
}
