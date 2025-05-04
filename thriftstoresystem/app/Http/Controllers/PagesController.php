<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $banners = Banner::all();
        $categories = Category::orderBy('priority')->get();
        return view('welcome',compact('products','banners', 'categories'));
    }


    public function contactUs()
    {
        return view('contact-us');
    }


    public function viewproduct($id)
    {
            $product = Product::find($id);  // Retrieve a single product, not a collection

            if ($product) {
                $categoryId = $product->category_id;  // Now this will work as you have a single model instance
            } else {
                // Handle the case where the product is not found
            }
        $relatedproducts = Product::where('category_id',$product->category_id)->where('id','!=',$id)->take(4)->get();
        return view('viewproduct',compact('product','relatedproducts'));
    }

    public function categoryproduct($id)
    {
        $category = Category::find($id);
        $category = Category::where('name', $category->name)->first();
// Check if category exists
    if (!$category) {
        abort(404, 'Category not found');
    }
        $products = Product::where('status','show')->where('category_id',$id)->get();
        return view('categoryproduct',compact('products','category'));
    }
    public function checkout($cartid)
    {
$cart = Cart::find($cartid);
if($cart->product->discounted_price == '')
{
    $cart->total =$cart->product->price * $cart->qty;
}
else
{
    $cart->total =$cart->product->discounted_price * $cart->qty;
}
return view('checkout',compact('cart'));
    }
    public function search (Request $request)
    {
$qry = $request->search;
$products = Product::where('name','like','%'.$qry.'%')->orWhere('description','like','%'.$qry.'%')->get();
return view('search',compact('products'));
    }

}
