@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-extrabold text-blue-900">Products</h1>
    <hr class="h-1 bg-red-500">

    <div class="text-right my-5">
        <a href="{{ route('product.create') }}" class="bg-green-900 text-white px-5 py-3 rounded-lg">Add Product</a>
    </div>

    <table class="w-full mt-5">
        <tr>
            <th class="border p-2 bg-purple-300">S.N.</th>
            <th class="border p-2 bg-purple-300">Image</th>
            <th class="border p-2 bg-purple-300"> Name</th>
            <th class="border p-2 bg-purple-300">Description</th>
            <th class="border p-2 bg-purple-300">Price</th>
            <th class="border p-2 bg-purple-300">Discounted Price</th>
            <th class="border p-2 bg-purple-300">Stock</th>
            <th class="border p-2 bg-purple-300">Status</th>
            <th class="border p-2 bg-purple-300">category</th>
            <th class="border p-2 bg-purple-300">Action</th>
        </tr>
        @foreach ($products as $product)
            <tr>
            <tr class="text-center">
                <td class="border p-2">{{ $loop->iteration }}</td>
                <td class="border p-2">
                    <img src="{{ asset('images/products/' . $product->photopath) }}" alt="" class="w-16 h-16">
                </td>
                <td class="border p-2">{{ $product->name }}</td>
                <td class="border p-2">{{ $product->description }}</td>
                <td class="border p-2">{{ $product->price }}</td>
                <td class="border p-2">{{ $product->discounted_price }}</td>
                <td class="border p-2">{{ $product->stock }}</td>
                <td class="border p-2 text-red-400">{{ $product->status }}</td>
                <td class="border p-2">{{ $product->category->name }}</td>
                <td class="border p-2">
                    <a href="{{ route('product.edit', $product->id) }}"
                        class="bg-green-600 text-white px-3 py-1 rounded"><i class="ri-edit-fill"></i></a>
                    <a href="{{ route('product.destroy', $product->id) }}" class="bg-red-600 text-white px-3 py-1 rounded"
                        onclick="return confirm('Are you sure to delete?')"><i
                        class="ri-delete-bin-line"></i></a>

                </td>

            </tr>
        @endforeach
    </table>
@endsection
