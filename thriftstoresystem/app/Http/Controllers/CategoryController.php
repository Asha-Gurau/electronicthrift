<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('priority', 'asc')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'priority' => 'required|numeric',
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        Category::create($data);
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'priority' => 'required|numeric',
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->update($data);

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Check if category has associated products
        if (Product::where('category_id', $id)->exists()) {
            return redirect()->route('category.index')->with('error', 'Category cannot be deleted as it has associated products');
        }

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }

}
