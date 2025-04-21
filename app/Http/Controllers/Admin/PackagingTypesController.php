<?php

namespace App\Http\Controllers\Admin;

use App\Models\PackagingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class PackagingTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:packaging-type-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:packaging-type-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:packaging-type-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:packaging-type-delete', ['only' => ['destroy']]);
    }

    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PackagingType::orderBy('size', 'asc')->get();
             
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = '<a href="' . route('packaging-types.edit', $row->id) . '" class="custom-edit-btn mr-1"><i class="fe fe-pencil"></i> Edit</a>';
                    $delete = '<button class="custom-delete-btn remove-packaging" data-id="' . $row->id . '" data-action="' . route('packaging-types.destroy') . '"><i class="fe fe-trash"></i> Delete</button>';
                    return $edit . ' ' . $delete;
                })
                ->addColumn('status', function ($row) {
                    $current_status = $row->status == 1 ? 'checked' : '';
                    $status = "
                        <input type='checkbox' id='status_$row->id' class='check' onclick='changePackagingStatus(event.target, $row->id);' $current_status>
                        <label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $status;
                })
                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.packaging-types.index');
    }

    
    public function create()
    {
        return view('admin.packaging-types.create');
    }

    public function store(Request $request)
    {
        $rules =[
            'size' => 'required|numeric',
            'unit' => 'required|string|max:10',
        ];

        $messages = [
            'size.required'  => __('default.form.validation.size.required'),
            'unit.required'  => __('default.form.validation.unit.required'),
            'unit.string'    => __('default.form.validation.unit.string'), 
            'unit.max'      => __('default.form.validation.unit.max'),
        ];
        $this->validate($request, $rules, $messages);
        try {
            PackagingType::create([
                'size' => $request->size,
                'unit' => $request->unit,
                'status' => $request->status ?? 1, 
            ]); 
            Toastr::success(__('packagingtype.message.store.success'));
            return redirect()->route('packaging-types.index');
        } catch (\Exception $e) {
            Toastr::error(__('packagingtype.message.store.error'));
            return redirect()->route('packaging-types.index');
        }
    }

    
    public function edit($id)
    {
        $row = PackagingType::findOrFail($id);
        return view('admin.packaging-types.edit', compact('row'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'size' => 'required|numeric',
            'unit' => 'required|string|max:10',
        ]);

        try {
            $packagingType = PackagingType::findOrFail($id);
            $packagingType->update([
                'size' => $request->size,
                'unit' => $request->unit,
                'status' => $request->status ?? 1,
            ]);
            Toastr::success(__('packagingtype.message.update.success'));
            return redirect()->route('packaging-types.index');
        } catch (\Exception $e) {
            Toastr::error(__('packagingtype.message.update.error'));
            return redirect()->route('packaging-types.index');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $packagingType = PackagingType::findOrFail($request->id);
            $packagingType->delete();
            Toastr::success(__('packagingtype.message.destroy.success'));
            return back();
        } catch (\Exception $e) {
            Toastr::error(__('packagingtype.message.destroy.error'));
            return redirect()->route('packaging-types.index');
        }
    }
    

    public function status_update(Request $request)
    { 
        try {
            $packagingType = PackagingType::findOrFail($request->id);
            $packagingType->update(['status' => $request->status]);
            return response()->json([
                'message' => $request->status == 1 ? 'Status activated successfully.' : 'Status deactivated successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating status.'], 500);
        }
    }
}
