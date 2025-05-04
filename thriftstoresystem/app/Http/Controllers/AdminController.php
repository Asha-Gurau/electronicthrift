<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function index()
    {
        $products = ProductRequest::where('status', 'pending')->latest()->get();
        return view('admin.index', compact('products'));
    }
    public function approve($id)
    {
        // Find the product request by ID
        $productRequest = ProductRequest::findOrFail($id);

        // Copy product details to the main product table
        Product::create([
            'name' => $productRequest->name,
            'category_id' => $productRequest->category_id, // Ensure this is set correctly
            'price' => $productRequest->price,
            'stock' => $productRequest->stock,
            'description' => $productRequest->description,
           'photopath' => $productRequest->photopath,
            'user_id' => $productRequest->user_id,
            'status' => 'approved',  // Explicitly set the status as 'approved'
            'created_at' => now(),
        ]);

        // Mark the product request as approved
        $productRequest->status = 'Approved';
        $productRequest->save();

        return redirect()->route('product.index')->with('success', 'Product approved and added to the catalog');
    }

    // public function reject($id)
    // {
    //     // Fetch the product request using the provided ID
    //     $productRequest = ProductRequest::findOrFail($id);

    //     // Update the status to 'Rejected'
    //     $productRequest->status = 'Rejected';
    //     $productRequest->save();

    //     // Redirect back to the previous page with a success message
    //     return redirect()->back()->with('status', 'Product request rejected successfully!');
    // }



    public function reject($id)
    {
        // Fetch the product request using the provided ID
        $productRequest = ProductRequest::findOrFail($id);

        // Create a rejected product in the 'products' table
        Product::create([
            'name' => $productRequest->name,
            'category_id' => $productRequest->category_id, // Ensure this is set correctly
            'price' => $productRequest->price,
            'stock' => $productRequest->stock,
            'description' => $productRequest->description,
            'photopath' => $productRequest->photopath,
            'user_id' => $productRequest->user_id,
            'status' => 'Rejected',  // Explicitly set the status as 'Rejected'
            'created_at' => now(),
        ]);

        // Update the status of the product request to 'Rejected'
        $productRequest->status = 'Rejected';
        $productRequest->save();

        // Redirect back with a success message
        return redirect()->route('product.index')->with('success', 'Product request rejected successfully');
    }



//pending request

public function pendingRequests()
{
    // Fetch pending product requests
    $pendingProducts = ProductRequest::with('category')->where('status', 'pending')->latest()->get();

    return view('admin.products.pending', compact('pendingProducts'));
}

}






