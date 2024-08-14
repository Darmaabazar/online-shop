<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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
            'status' => 'required|boolean',
            'image' => 'mimes:jpeg,jpg,png,gif,webp|required|max:10000'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/assets/category/images'), $imageName);
            $validateData['image'] = 'admin/assets/category/images'.$imageName;
        }
        else {
            $validateData['image'] = null;
        }

        Category::query()->create($validateData);

        return redirect('/admin/categories')->with('success', 'Category has been created');
    }

    public function show($id) {

    }

    public function edit($id) {

    }

    public function update(Request $request, $id) {

    }

    public function destroy($id) {

    }
}
