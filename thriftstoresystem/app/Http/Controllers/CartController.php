<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
//use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'product_id' => 'required',
    //         'qty' => 'required'
    //     ]);
    //     $data['user_id'] = Auth::id();

    //     $cart = cart::where('user_id', Auth::id())->where('product_id', $data['product_id'])->first();
    //     if ($cart) {
    //         $cart->qty = $data['qty'];
    //         $cart->save();
    //         return back()->with('success', 'cart update successfully');
    //     }

    //     Cart::create($data);
    //     return back()->with('success', 'product added to cart successfully');
    // }

    public function store(Request $request)
{
    $data = $request->validate([
        'product_id' => 'required|exists:products,id',  // Make sure the product exists in the database
        'qty' => 'required|integer|min:1',  // Ensure qty is a positive integer
    ]);
    $data['user_id'] = Auth::id();  // Add the user ID to the data

    // Get the product from the database
    $product = Product::find($data['product_id']);
    $quantity = $data['qty'];

    // Check if the product has enough stock
    if ($product->stock >= $quantity) {
        // Decrease the product stock
        $product->stock -= $quantity;
        $product->save();  // Save the updated stock value

        // Check if the product is already in the user's cart
        $cart = Cart::where('user_id', Auth::id())->where('product_id', $data['product_id'])->first();

        if ($cart) {
            // If the product is already in the cart, update the quantity
            $cart->qty = $data['qty'];
            $cart->save();
            return back()->with('success', 'Cart updated successfully');
        }

        // If the product is not in the cart, add it
        Cart::create($data);
        return back()->with('success', 'Product added to cart successfully');
    } else {
        // If not enough stock, return an error
        return back()->withErrors('Not enough stock available.');
    }
}


    public function mycart()
    {
        $carts = cart::where('user_id', Auth::id())->get();
        foreach ($carts as $cart) {
            if ($cart->product->discounted_price == '') {
                $cart->total = $cart->product->price * $cart->qty;
            } else {
                $cart->total = $cart->product->discounted_price * $cart->qty;
            }
        }

        return view('mycart', compact('carts'));
    }
    public function destroy($id)
    {
        Cart::find($id)->delete();
        return back()->with('success', 'product removed from cart successfully');
    }
}
