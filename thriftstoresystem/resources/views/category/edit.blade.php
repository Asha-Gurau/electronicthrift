@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-extrabold text-blue-900">Edit Categories</h1>
    <hr class="h-1 bg-red-500">

    <form action="{{ route('category.update', $category->id) }}" method="POST" class="mt-5">
        @csrf
        <input type="text" placeholder="Enter priority" name="priority" class="w-full rounded-lg my-2"
            value="{{ $category->priority }}">
        @error('priority')
            <p class="text-red-500 -mt-2">{{ $message }}</p>
        @enderror

        <input type="text" placeholder=" Enter Category name" name="name" class="w-full rounded-lg my-2"
            value="{{ $category->name }}">
        @error('name')
            <p class="text-red-500 -mt-2">{{ $message }}</p>
        @enderror




        <select name="status" id="" class="w-full rounded-lg my-2">
            <option value="active" @if ($category->status == 'active') selected @endif>active</option>
            <option value="inactive" @if ($category->status == 'inactive') selected @endif>inactive</option>
        </select>



        <div class="flex mt-4 justify-center gap-4">
            <button type="Submit" value="update Category"
                class="bg-blue-600 text-white px-5 py-3 rounded-lg cursor-pointer">update category</button>

        </div>

    </form>
@endsection
