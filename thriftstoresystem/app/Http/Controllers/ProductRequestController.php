<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product; // Assuming you have a Product model
use Illuminate\Support\Facades\Auth;
use App\Models\ProductRequest;

class ProductRequestController extends Controller
{

    public function create()
    {
        $categories = Category::all();
        return view('productrequest.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
           // 'discounted_price' => 'nullable|numeric|lt:price',
           'stock' => 'required|numeric',
            'photopath' => 'required|image',

        ]);

        $photo = $request->file('photopath');
        $photoname = time() . '.' . $photo->extension();
        $photo->move(public_path('images/products'), $photoname);
        $data['photopath'] = $photoname;
        $data['status'] = 'Pending';
        $data['user_id'] = Auth::id();

        ProductRequest::create($data);

        return redirect(route('home'))->with('success', 'Product submitted for approval');
    }
}
