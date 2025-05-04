@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-extrabold text-blue-900">Banners</h1>
        <hr class="h-1 bg-red-500 my-4">
        <div class="text-right my-5">
            <a href="{{ route('banner.create') }}" class="bg-blue-900 text-white px-5 py-3 rounded-lg">Add Banner</a>
        </div>

        <!-- Table with responsiveness -->
        <div class="overflow-x-auto">
            <table class="w-full mt-5 table-auto text-sm sm:text-base">
                <thead>
                    <tr>
                        <th class="border p-2 bg-purple-300">SN</th>
                        <th class="border p-2 bg-purple-300">Title</th>
                        <th class="border p-2 bg-purple-300">Priority</th>
                        <th class="border p-2 bg-purple-300">description</th>
                        <th class="border p-2 bg-purple-300">Image</th>
                        <th class="border p-2 bg-purple-300">status</th>
                        <th class="border p-2 bg-purple-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                        <tr>
                            <td class="border p-2">{{ $loop->iteration }}</td>
                            <td class="border p-2">{{ $banner->title }}</td>
                            <td class="border p-2">{{ $banner->priority }}</td>
                            <td class="border p-2">{{ $banner->description }}</td>

                            <td class="border p-2">
                                <img src="{{ asset('images/banners/' . $banner->photopath) }}" alt="Banner Image" class="w-16 h-16 sm:w-24 sm:h-24 mx-auto">
                            </td>
                            <td class="border p-2">{{ $banner->status }}</td>
                            <td class="border p-2 flex justify-center gap-2">
                                <a href="{{ route('banner.edit', $banner->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('banner.destroy', $banner->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
