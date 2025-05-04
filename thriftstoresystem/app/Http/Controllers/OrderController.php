<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request, $cartid)
    {
        $request->validate(['data' => 'required']);

        $data = json_decode(base64_decode($request->data));

        if ($data->status === 'COMPLETE') {
            $cart = Cart::findOrFail($cartid);

            $orderData = [
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'price' => $cart->product->price,
                'payment_method' => 'Esewa',
                'name' => $cart->user->name,
                'phone' => $cart->user->phone ?? $request->phone ?? 'N/A',
                'address' => $cart->user->address ?? $request->address ?? 'N/A',
            ];

            Order::create($orderData);
            $cart->delete();

            return redirect(route('home'))->with('success', 'Order placed successfully.');
        }

        return back()->with('error', 'Payment was not completed. Please try again.');
    }

    public function storecod(Request $request)
    {
        $request->validate(['cart_id' => 'required|exists:carts,id']);

        $cart = Cart::findOrFail($request->cart_id);

        $orderData = [
            'user_id' => $cart->user_id,
            'product_id' => $cart->product_id,
            'qty' => $cart->qty,
            'price' => $cart->product->price,
            'payment_method' => 'Cash on Delivery',
            'name' => $cart->user->name,
            'phone' => $cart->user->phone ?? $request->phone ?? 'N/A',
            'address' => $cart->user->address ?? $request->address ?? 'N/A',
        ];

        Order::create($orderData);
        $cart->delete();

        return redirect(route('home'))->with('success', 'Order placed successfully.');
    }

    public function status($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        $data = ['name' => $order->name, 'status' => $status];

        if (!empty($order->user->email)) {
            try {
                Mail::send('mail.order', $data, function ($message) use ($order) {
                    $message->to($order->user->email, $order->name)->subject('Order Status');
                });
            } catch (\Exception $e) {
                \Log::error('Mail sending failed: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Order status updated to ' . $status);
    }

    public function userOrders()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized access.');
        }

        $orders = $user->orders()
            ->with('product')
            ->latest()
            ->get();

        return view('orders.user', compact('orders'));
    }
}
