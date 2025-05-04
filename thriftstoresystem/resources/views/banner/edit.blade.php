@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-extrabold text-blue-900">Edit Banner</h1>
    <hr class="h-1 bg-red-500 my-4">

    <form action="{{ route('banner.update', $banner->id) }}" method="POST" class="max-w-4xl mx-auto mt-5 space-y-4">
        @csrf
        @method('PUT')
        <!-- Priority Input -->
        <div>
            <input type="text" placeholder="Enter priority" name="priority"
                class="w-full rounded-lg p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ $banner->priority }}">
            @error('priority')
                <p class="text-red-500 -mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Banner Title Input -->
        <div>
            <input type="text" placeholder="Enter banner title" name="title"
                class="w-full rounded-lg p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ $banner->title }}">
            @error('tittle')
                <p class="text-red-500 -mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Banner Description Input -->
        <div>
            <input type="text" placeholder="Enter banner description" name="description"
                class="w-full rounded-lg p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ $banner->description }}">
            @error('description')
                <p class="text-red-500 -mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status Select -->
        <div>
            <select name="status"
                class="w-full rounded-lg p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="active" @if ($banner->status == 'active') selected @endif>Active</option>
                <option value="inactive" @if ($banner->status == 'inactive') selected @endif>Inactive</option>
            </select>
        </div>

        {{-- file image --}}
        <div>
            <input type="file" name="photopath"
                class="w-full rounded-lg p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('photopath')
                <p class="text-red-500 -mt-2">{{ $message }}</p> <!-- Corrected here -->
            @enderror
        </div>

        <!-- Current Image Display -->
        <div class="text-center">
            <p>Current picture:</p>
            <img src="{{ asset('images/banners/' . $banner->photopath) }}" alt="Current Banner Image"
                class="w-44 mx-auto my-2">
        </div>




        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <input type="submit" value="Update Banner"
                class="bg-blue-600 text-white px-5 py-3 rounded-lg cursor-pointer w-full md:w-auto hover:bg-blue-500">
            <a href="{{ route('banner.index') }}"
                class="bg-red-600 text-white px-5 py-3 rounded-lg w-full md:w-auto hover:bg-red-500">Exit</a>
        </div>
    </form>
@endsection
