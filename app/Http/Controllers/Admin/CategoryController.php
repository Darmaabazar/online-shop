<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::query()->orderBy('created_at', 'desc')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
            'status' => 'nullable',
            'image' => 'image|mimes:jpeg,jpg,png,gif,webp|required|max:10000'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/categories'), $imageName);
            $validateData['image'] = 'uploads/categories/'.$imageName;
        }
        else {
            $validateData['image'] = null;
        }

        Category::query()->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => ($validateData['status'] === 'on') ? 1 : 0,
            'image' => $validateData['image']
        ]);

        return redirect('/admin/categories')->with('success', 'Category has been created');
    }

    public function edit(Request $request, Category $category) {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $category) {
        $validateData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
            'status' => 'nullable',
            'image' => 'image|mimes:jpeg,jpg,png,gif,webp|required|max:10000'
        ]);

        $category = Category::query()->find($category);

        if ($request->hasFile('image')) {
            $destination = $category -> image;

            if(File::exists($destination)) {
                File::delete($destination);
            }

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/categories'), $imageName);
            $validateData['image'] = 'uploads/categories/'.$imageName;
        } else {
            $validateData['image'] = $category->image;
        }

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => ($validateData['status'] === 'on') ? 1 : 0,
            'image' => $validateData['image']
        ]);
        return redirect('/admin/categories/')->with('success', 'Category has been updated');
    }

    public function destroy($id) {
        $category = Category::query()->findOrFail($id);

        $destination = $category -> image;

        if(File::exists($destination)) {
            File::delete($destination);
        }

        $category->delete();
        return redirect('/admin/categories/')->with('success', 'Category has been deleted');
    }
}
