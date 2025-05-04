@extends('layouts.app')
@section('content')
<h1 class="text-4xl font-extrabold text-blue-900">Orders</h1>
<hr class="h-1 bg-red-500">

<table class="w-full mt-5">
    <tr>
        <th class="border p-2 bg-purple-300">Order Date</th>
        <th class="border p-2 bg-purple-300">Product image</th>
        <th class="border p-2 bg-purple-300">Product Name</th>
        <th class="border p-2 bg-purple-300">Customer Name</th>
        <th class="border p-2 bg-purple-300">phone</th>
        <th class="border p-2 bg-purple-300">Address</th>
        <th class="border p-2 bg-purple-300">Rate</th>
        <th class="border p-2 bg-purple-300">Quantity</th>
        <th class="border p-2 bg-purple-300">Total</th>
        <th class="border p-2 bg-purple-300">Payment Mode</th>
        <th class="border p-2 bg-purple-300">Status</th>
        <th class="border p-2 bg-purple-300">Action</th>
    </tr>
    @foreach ($orders as $order)
    <tr class="text-center">
        <td class="border p-2">{{$order->created_at}}</td>
        <td class="border p-2">
            <img src="{{asset('images/products/'.$order->product->photopath)}}" alt="" class="h-24 mx-auto">

        </td>
        <td class="border p-2">{{$order->product->name}}</td>
        <td class="border p-2">{{$order->name}}</td>
        <td class="border p-2">{{$order->phone}}</td>
        <td class="border p-2">{{$order->address}}</td>
        <td class="border p-2">{{$order->price}}</td>
        <td class="border p-2">{{$order->qty}}</td>
        <td class="border p-2">{{$order->qty * $order->price}}</td>
        <td class="border p-2">{{$order->payment_method}}</td>
        <td class="border p-2">{{$order->status}}</td>
        <td class="border p-2 grid gap-2">
            <a href="{{route('order.status',[$order->id,'Pending'])}}" class="bg-blue-900 text-white px-2 py-1 rounded-lg">Pending</a>
            <a href="{{route('order.status',[$order->id,'Processing'])}}" class="bg-green-900 text-white px-2 py-1 rounded-lg">Processing</a>
            <a href="{{route('order.status',[$order->id,'Shipping'])}}" class="bg-amber-900 text-white px-2 py-1 rounded-lg">Shipping</a>
            <a href="{{route('order.status',[$order->id,'Delivered'])}}" class="bg-red-900 text-white px-2 py-1 rounded-lg">Delivered</a>
        </td>
    </tr>

    @endforeach
</table>

    @endsection
