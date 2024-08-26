<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index() {
        $products = Product::query()->orderBy('created_at', 'desc')->get();
        return view('admin.product.index', compact('products'));
    }

    public function create() {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.create', compact('brands', 'categories'));
    }

    public function store(Request $request) {
        $validateData = $request->validate([

        ]);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/categories'), $imageName);
            $validateData['image'] = 'uploads/categories/'.$imageName;
        }
        else {
            $validateData['image'] = null;
        }

        Product::create($validateData);

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
    }
}
