@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-extrabold text-blue-900">Create Categories</h1>
    <hr class="h-1 bg-red-500">
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="mt-5">
        @csrf

        <!-- Priority Input -->
        <input type="text" placeholder="Enter priority" name="priority" class="w-full rounded-lg my-2"
            value="{{ old('priority') }}">
        @error('priority')
            <p class="text-red-500 -mt-2">{{ $message }}</p>
        @enderror

        <!-- Category Name Input -->
        <input type="text" placeholder="Enter Category name" name="name" class="w-full rounded-lg my-2"
            value="{{ old('name') }}">
        @error('name')
            <p class="text-red-500 -mt-2">{{ $message }}</p>
        @enderror

        <!-- Status Selection -->
        <select name="status" class="w-full rounded-lg my-2">
            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
            <p class="text-red-500 -mt-2">{{ $message }}</p>
        @enderror

        <!-- Action Buttons -->
        <div class="flex mt-4 justify-center gap-4">
            <input type="submit" value="Add Category" class="bg-blue-600 text-white px-5 py-3 rounded-lg cursor-pointer">
            <a href="{{ route('category.index') }}" class="bg-red-600 text-white px-10 py-3 rounded-lg">Exit</a>
        </div>
    </form>
@endsection
