@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-extrabold text-blue-900">Products</h1>
    <hr class="h-1 bg-red-500">

    <form action="{{ route('product.update', $product->id) }}" method="POST" class="mt-5" enctype="multipart/form-data">
        @csrf
        <select name="category_id" id="" class="w-full rounded-lg my-2">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>{{ $category->name }}
                </option>
            @endforeach
        </select>
        <input type="text" placeholder="Enter product Name" name="name" class="w-full rounded-lg my-2"
            value="{{ $product->name }}">
        @error('name')
            <p class="text-red-500 -mt-2">{{ message }}</p>
        @enderror
        <textarea name="description" id="" cols="30" rows="5" placeholder="Enter product description"
            class="w-full rounded-lg my-2">{{ $product->description }}</textarea>
        @error('description')
            <p class="text-red-500 -mt-2">{{ message }}</p>
        @enderror
        <input type="text" placeholder="Enter price" name="price" class="w-full rounded-lg my-2"
            value="{{ $product->price }}">
        @error('price')
            <p class="text-red-500 -mt-2">{{ message }}</p>
        @enderror
        <input type="text" placeholder="Enter stock" name="stock" class="w-full rounded-lg my-2"
            value="{{ $product->stock }}">
        @error('stock')
            <p class="text-red-500 -mt-2">{{ message }}</p>
        @enderror
        <input type="text" placeholder="Enter Discounted price" name="discounted_price" class="w-full rounded-lg my-2"
            value="{{ $product->discounted_price }}">
        @error('discounted_price')
            <p class="text-red-500 -mt-2">{{ message }}</p>
        @enderror

        <select name="status" id="" class="w-full rounded-lg my-2 ">
            <option value="Show" @if ($product->status == 'show') selected @endif>Show</option>
            <option value="Hide">
                @if ($product->status == 'hide')
                    selected
                @endif>Hide
            </option>
        </select>

        <input type="file" name="photopath" class="w-full rounded-lg my-2">
        @error('photopath')
            <p class="text-red-500 -mt-2">{{ message }}</p>
        @enderror
        <p>current picture:</p>
        <img src="{{ asset('images/products/' . $product->photopath) }}" alt="" class="w-44">

        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">update product</button>
            <a href="{{ route('product.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg ml-2">Cancel</a>
        </div>

    </form>
@endsection
