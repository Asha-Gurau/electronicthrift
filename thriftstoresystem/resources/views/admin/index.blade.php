@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-extrabold text-blue-900">Pending Product Requests</h1>
    <hr class="h-1 bg-red-500">

    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <table class="w-full mt-5">
        <thead>
            <tr class="text-left">
                <th class="border p-2 bg-purple-300">Product Name</th>
                <th class="border p-2 bg-purple-300">Category</th>
                <th class="border p-2 bg-purple-300">Price</th>
                <th class="border p-2 bg-purple-300">Stock</th>
                <th class="border p-2 bg-purple-300">Status</th>
                <th class="border p-2 bg-purple-300">Actions</th>
                <th class="border p-2 bg-purple-300">Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $productRequest)
                <tr class="text-center">
                    <td class="border p-2">{{ $productRequest->name }}</td>
                    <td class="border p-2">{{ $productRequest->category->name ?? 'No Category' }}</td>
                    <td class="border p-2">{{ $productRequest->price }}</td>
                    <td class="border p-2">{{ $productRequest->stock }}</td>
                    <td class="border p-2">
                        <!-- Displaying the Status -->
                        <span class="font-bold {{ $productRequest->status == 'Approved' ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ ucfirst($productRequest->status) }}
                        </span>
                    </td>
                    <td class="border p-2">
                        @if($productRequest->status == 'pending')
                            <!-- Approve Form -->
                            <form action="{{ route('admin.request.approve', $productRequest->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Approve</button>
                            </form>
                            <!-- Reject Form -->
                            <form action="{{ route('admin.request.reject', $productRequest->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Reject</button>
                            </form>
                        @elseif($productRequest->status == 'Approved')
                            <!-- Display when the product is approved -->
                            <span class="bg-green-100 text-green-800 py-1 px-3 rounded">Approved</span>
                        @elseif($productRequest->status == 'Rejected')
                            <!-- Display when the product is rejected -->
                            <span class="bg-red-100 text-red-800 py-1 px-3 rounded">Rejected</span>
                        @endif
                    </td>
                    <td class="border p-2">
                        @if ($productRequest->photopath)
                            <img src="{{ asset('images/products/' . $productRequest->photopath) }}"
                                 alt="{{ $productRequest->name }}" width="100">
                        @else
                            No Image Available
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
