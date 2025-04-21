<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Gate;
use DataTables;

class ShadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:shades-list', ['only' => ['index']]);
        $this->middleware('permission:shades-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:shades-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:shades-delete', ['only' => ['destroy']]);
    }

    // List all shades
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Shade::orderBy('name', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $edit = Gate::allows('shades-edit') ? 
                        '<a href="' . route('shades.edit', $row->id) . '" class="custom-edit-btn mr-1"><i class="fe fe-pencil"></i> Edit</a>' : '';
                    $delete = Gate::allows('shades-delete') ? 
                        '<button class="custom-delete-btn remove-shade" data-id="' . $row->id . '" data-action="' . route('shades.destroy') . '"><i class="fe fe-trash"></i> Delete</button>' : '';
                    return $edit . ' ' . $delete;
                })
                ->addColumn('status', function($row) {
                    $current_status = $row->status == 1 ? 'checked' : '';
                    $status = "
                        <input type='checkbox' id='status_$row->id' class='check' onclick='changeShadeStatus(event.target, $row->id);' $current_status>
                        <label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $status;
                })
                ->editColumn('created_at', '{{ date("jS M Y", strtotime($created_at)) }}')
                ->rawColumns(['action', 'status']) // Render raw HTML for actions and status
                ->make(true);
        }
        return view('admin.shades.index');
    }

    // Show form to create new shade
    public function create()
    {
        return view('admin.shades.create');
    }

    // Store new shade
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:shades,name',
        ]);

        $messages = [
            'name.required'  => __('shades.form.validation.name.required'),
        ];

        try {
            $slug = Str::slug($request->name, '-');
            Shade::create([
                'name' => $request->name,
                'slug' => $slug,
                'status' => $request->status,
            ]);
            Toastr::success(__('shades.message.store.success'));
            return redirect()->route('shades.index');
        } catch (\Exception $e) {
            Toastr::error(__('shades.message.store.error'));
            return redirect()->route('shades.index');
        }
    }

    // Show form to edit shade
    public function edit($id)
    {
        $row = Shade::findOrFail($id);
        return view('admin.shades.edit', compact('row'));
    }

    // Update existing shade
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:shades,name,' . $id,
        ]);

        try {
            $shade = Shade::findOrFail($id);
            $slug = Str::slug($request->name, '-');
            $shade->update([
                'name' => $request->name,
                'slug' => $slug,
                'status' => $request->status,
            ]);
            Toastr::success(__('shades.message.update.success'));
            return redirect()->route('shades.index');
        } catch (\Exception $e) {
            Toastr::error(__('shades.message.update.error'));
            return redirect()->route('shades.index');
        }
    }

    // Delete shade
    public function destroy(Request $request)
    {
        try {
            $shade = Shade::findOrFail($request->id);
            $shade->delete();
            Toastr::success(__('shades.message.destroy.success'));
            return back();
        } catch (\Exception $e) {
            Toastr::error(__('shades.message.destroy.error'));
            return redirect()->route('shades.index');
        }
    }

    // Update shade status 
    public function status_update(Request $request)
    {
        $shade = Shade::find($request->id)->update(['status' => $request->status]);

        return response()->json([
            'message' => $request->status == 1 ? 'Shade activated successfully' : 'Shade deactivated successfully',
        ]);
    }
}
