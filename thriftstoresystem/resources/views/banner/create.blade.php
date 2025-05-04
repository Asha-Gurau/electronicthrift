@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-extrabold text-blue-900">Create Banner</h1>
    <hr class="h-1 bg-red-500">
    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="Enter priority" name="priority" class="w-full rounded-lg my-2"
            value="{{ old('priority') }}">
        @error('priority')
            <p class="text-red-500 -mt-2">{{ $message }}</p>
        @enderror

        <input type="text" placeholder=" Enter banner tittle" name="title" class="w-full rounded-lg my-2"
            value="{{ old('title') }}">
        @error('name')
            <p class="text-red-500 -mt-2">{{ $message }}</p>
        @enderror

        <input type="text" placeholder=" Enter banner description" name="description" class="w-full rounded-lg my-2"
            value="{{ old('description') }}">
        @error('name')
            <p class="text-red-500 -mt-2">{{ $message }}</p>
        @enderror

        <input type="file" name="photopath" class="w-full rounded-lg my-2">
        @error('photopath')
            <p class="text-red-500 -mt-2">{{ $message }}</p>
        @enderror

        <select name="status" id="" class="w-full rounded-lg my-2">
            <option value="active">active</option>
            <option value="inactive">inactive</option>
        </select>

        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Create banner</button>
            <a href="{{ route('banner.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg ml-2">Cancel</a>
        </div>


    </form>
@endsection
