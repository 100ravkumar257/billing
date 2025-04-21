<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Brian2694\Toastr\Facades\Toastr;
use Gate;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        // If the request is an AJAX call for DataTables
        if ($request->ajax()) {
            $data = Testimonial::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if (Gate::check('testimonial-edit')) {
                        $edit = '<a href="'.route('admin.testimonials.edit', $row->id).'" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> '.__('default.table.edit').'
                                </a>';
                    } else {
                        $edit = '';
                    }
    
                    if (Gate::check('testimonial-delete')) {
                        $delete = '<button class="custom-delete-btn remove-testimonial" data-id="'.$row->id.'" data-action="'.route('admin.testimonials.destroy').'">
                                        <i class="fe fe-trash"></i> '.__('default.table.delete').'
                                    </button>';
                    } else {
                        $delete = '';
                    }
                    $action = $edit . ' ' . $delete;
                    return $action;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 1) {
                        $current_status = 'checked';
                    } else {
                        $current_status = '';
                    }

                    $status = "
                        <input type='checkbox' id='status_$row->id' class='check' onclick='changeTestimonialStatus(event.target, $row->id);' $current_status>
                        <label for='status_$row->id' class='checktoggle'>checkbox</label>
                    ";
                    return $status;
                })
                ->rawColumns(['action', 'status'])
                ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
                ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
                ->escapeColumns([])
                ->make(true);
        }

        $testimonials = Testimonial::paginate(10); // Paginate the testimonials
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ];

        $messages = [
            'name.required' => __('default.form.validation.name.required'),
            'position.required' => __('default.form.validation.position.required'),
            'description.required' => __('default.form.validation.description.required'),
            'status.required' => __('default.form.validation.status.required'),
        ];

        $this->validate($request, $rules, $messages);
        
        $data = $request->all();

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('testimonials', 'public');
                $data['image'] = $imagePath;
            }

            Testimonial::create($data);

            Toastr::success(__('testimonial.message.store.success'));
            return redirect()->route('admin.testimonials.index');
        } catch (\Exception $e) {
            Toastr::error(__('testimonial.message.store.error'));
            return redirect()->route('admin.testimonials.index');
        }
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ];

        $messages = [
            'name.required' => __('default.form.validation.name.required'),
            'position.required' => __('default.form.validation.position.required'),
            'description.required' => __('default.form.validation.description.required'),
            'status.required' => __('default.form.validation.status.required'),
        ];

        $this->validate($request, $rules, $messages);

        $testimonial = Testimonial::findOrFail($id);
        $data = $request->all();

        try {
            if ($request->hasFile('image')) {
                if ($testimonial->image) {
                    \Storage::disk('public')->delete($testimonial->image);
                }
                $imagePath = $request->file('image')->store('testimonials', 'public');
                $data['image'] = $imagePath;
            }

            $testimonial->update($data);
            Toastr::success(__('testimonial.message.update.success'));
            return redirect()->route('admin.testimonials.index');
        } catch (\Exception $e) {
            Toastr::error(__('testimonial.message.update.error'));
            return redirect()->route('admin.testimonials.index');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $testimonial = Testimonial::findOrFail($request->id);
            if ($testimonial->image) {
                \Storage::disk('public')->delete($testimonial->image);
            }
            $testimonial->delete();
            Toastr::success(__('testimonial.message.delete.success'));
            return redirect()->route('admin.testimonials.index');
        } catch (\Exception $e) {
            Toastr::error(__('testimonial.message.delete.error'));
            return redirect()->route('admin.testimonials.index');
        }
    }

    public function status_update(Request $request)
    {
        $testimonial = Testimonial::findOrFail($request->id);
        $testimonial->status = !$testimonial->status;
        $testimonial->save();

        return response()->json(['message' => 'Testimonial status updated']);
    }
}
