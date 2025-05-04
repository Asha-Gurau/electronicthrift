@extends('layouts.master')
@section('content')
    <h1 class="text-4xl font-extrabold text-blue-900">Your Order History</h1>
    <hr class="h-1 bg-red-500">

    @if($orders->isEmpty())
        <p class="mt-5">You have not placed any orders yet.</p>
    @else
        <table class="w-full mt-5">
            <thead>
                <tr>
                    <th class="border p-2 bg-purple-300">Order Date</th>
                    <th class="border p-2 bg-purple-300">Product Image</th>
                    <th class="border p-2 bg-purple-300">Product Name</th>
                    <th class="border p-2 bg-purple-300">Rate</th>
                    <th class="border p-2 bg-purple-300">Quantity</th>
                    <th class="border p-2 bg-purple-300">Total</th>
                    <th class="border p-2 bg-purple-300">Payment Mode</th>
                    <th class="border p-2 bg-purple-300">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="text-center">
                        <td class="border p-2">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        <td class="border p-2">
                            <img src="{{ asset('images/products/' . $order->product->photopath) }}" alt="{{ $order->product->name }}" class="h-16 mx-auto">
                        </td>
                        <td class="border p-2">{{ $order->product->name }}</td>
                        <td class="border p-2">{{ $order->price }}</td>
                        <td class="border p-2">{{ $order->qty }}</td>
                        <td class="border p-2">{{ $order->qty * $order->price }}</td>
                        <td class="border p-2">{{ $order->payment_method }}</td>
                        <td class="border p-2">{{ ucfirst($order->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
