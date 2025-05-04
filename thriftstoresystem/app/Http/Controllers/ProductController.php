<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;  // Add this line

use Illuminate\Http\Request;

class ProductController extends Controller
{

    // public function index()
    // {
    //     $products = Product::all();
    //     return view('product.index', compact('products'));
    // }



    public function index()
    {
        // Fetch products where status is not 'Rejected'
        $products = Product::where('status', '!=', 'Rejected')->get();

        return view('product.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::orderBy('priority')->get();
        return view('product.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|numeric',
            'status' => 'required',
            'photopath' => 'required|image',
        ]);


        //store picture
        $photo = $request->file('photopath');
        $photoname = time() . '.' . $photo->extension();
        $photo->move(public_path('images/products'), $photoname);
        $data['photopath'] = $photoname;

        Product::create($data);
        return redirect(route('product.index'))->with('success', 'Product created successfully');
    }


    public function edit($id)
    {
        $product = product::find($id);
        $categories = Category::orderBy('priority')->get();
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|numeric',
            'status' => 'required',
            'photopath' => 'nullable|image',
        ]);

        $product = product::find($id);
        $data['photopath'] = $product->photopath;
        if ($request->hasFile('photopath')) {
            //store picture
            $photo = $request->file('photopath');
            $photoname = time() . '.' . $photo->extension();
            $photo->move(public_path('images/products'), $photoname);
            $data['photopath'] = $photoname;
            //delete old photo
            $oldphoto = public_path('images/products/' . $product->photopath);
            if (file_exists($oldphoto)) {
                unlink($oldphoto);
            }
        }
        $product->update($data);
        return redirect()->route('product.index')->with('success', 'product updated successfully');
    }
    public function destroy($id)
    {
        $product = product::find($id);
        $photo = public_path('images/products/' . $product->photopath);
        if (file_exists($photo)) {
            unlink($photo);
        }
        $product->delete();
        return redirect()->route('product.index')->with('success', 'product Deleted successfully');
    }

    // category
    public function showCategory($categorySlug)
    {
        // Fetch the category by its slug
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Get products related to this category
        $products = Product::where('category_id', $category->id)->get();

        // Return the view with category and products data
        return view('categoryproduct', compact('category', 'products'));
    }

}
