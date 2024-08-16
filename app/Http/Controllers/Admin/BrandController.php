<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index() {
        $brands = Brand::query()->orderBy('created_at', 'desc')->get();
        return view('admin.brand.index', compact('brands'));
    }

    public function create() {
        return view('admin.brand.create');
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/brands'), $imageName);
            $validateData['image'] = 'uploads/brands/'.$imageName;
        }
        else {
            $validateData['image'] = null;
        }

        Brand::query()->create([
            'name' => $request->name,
            'status' => ($request->status === 'on') ? 1 : 0,
            'image' => $validateData['image']
        ]);

        return redirect('/admin/brands')->with('success', 'Brand has been created');
    }

    public function edit($id) {
        $brand = Brand::query()->findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id) {
        $validateData = $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        $brand = Brand::query()->findOrFail($id);

        if ($request->hasFile('image')) {
            $destination = $brand -> image;

            if(File::exists($destination)) {
                File::delete($destination);
            }
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/brands'), $imageName);
            $validateData['image'] = 'uploads/brands/'.$imageName;
        }
        else {
            $validateData['image'] = null;
        }
        $brand->update([
            'name' => $request->name,
            'status' => ($request->status === 'on') ? 1 : 0,
            'image' => $validateData['image']
        ]);
        return redirect('/admin/brands')->with('success', 'Brand has been updated');
    }
    public function destroy($id) {
        $brand = Brand::query()->findOrFail($id);
        $destination = $brand -> image;
        if(File::exists($destination)) {
            File::delete($destination);

        }
        $brand->delete();
        return redirect('/admin/brands')->with('success', 'Brand has been deleted');
    }
}
