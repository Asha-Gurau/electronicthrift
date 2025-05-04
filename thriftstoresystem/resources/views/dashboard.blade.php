@extends('layouts.app')
@section('content')
<h1 class="text-3xl font-bold text-blue-900">Dashboard</h1>
<hr class="h-1 bg-red-500">

<div class="mt-5 grid grid-cols-3 gap-8">
    <div class="bg-blue-300 p-5 shadow rounded-lg">
        <h2 class="text-2xl font-bold text-blue-500">Categories</h2>
        <p>Total categories: {{$categories}}</p>
    </div>
    <div class="bg-red-300 p-5 shadow rounded-lg">
        <h2 class="text-2xl font-bold text-blue-900"><i class="ri-store-line"></i>products</h2>
        <p>Total products: {{$products}}</p>
    </div>

    <div class="bg-green-300 p-5 shadow rounded-lg">
        <h2 class="text-2xl font-bold text-blue-900"><i class="ri-user-3-fill"></i>users</h2>
        <p>Total users: 15</p>
    </div>
    <div class="bg-yellow-300 p-5 shadow rounded-lg">
        <h2 class="text-2xl font-bold text-blue-900"><i class="ri-pass-pending-line"></i>pending orders</h2>
        <p>pending orders: 20</p>
    </div>
    <div class="bg-purple-300 p-5 shadow rounded-lg">
        <h2 class="text-2xl font-bold text-blue-900">processing order</h2>
        <p>processing order: 30</p>
    </div>
    <div class="bg-blue-300 p-5 shadow rounded-lg">
        <h2 class="text-2xl font-bold text-blue-900">completed order</h2>
        <p>completed order: 40</p>
    </div>
    <div class="bg-blue-300 p-5 shadow rounded-lg">
        <h2 class="text-2xl font-bold text-blue-900">completed order</h2>
        <p>Approval table</p>
    </div>
</div>
@endsection
