@extends('layouts.app')
@section('content')
    <h1 class="text-4xl font-extrabold text-blue-900">Categories</h1>
    <hr class="h-1 bg-red-500">

    <div class="text-right my-5">
        <a href="{{ route('category.create') }}" class="bg-blue-900 text-white px-5 py-3 rounded-lg">Add Category</a>
    </div>

    <table class="w-full mt-5 border-collapse">
        <thead>
            <tr>
                <th class="border p-2 bg-purple-300">Order</th>
                <th class="border p-2 bg-purple-300">Category Name</th>
                <th class="border p-2 bg-purple-300">status</th>
                <th class="border p-2 bg-purple-300">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="text-center">
                    <td class="border p-2">{{ $category->priority }}</td>
                    <td class="border p-2">{{ $category->name }}</td>
                    <td class="border p-2  text-red-800">{{ $category->status }}</td>
                    <td class="border p-2">
                        <a href="{{ route('category.edit', $category->id) }}"
                            class="bg-blue-600 text-white px-3 py-1 rounded"> <i class="ri-edit-line"></i></a>
                        <a href="javascript:void(0);" class="bg-red-600 text-white px-3 py-1 rounded cursor-pointer"
                            onclick="showPopup({{ $category->id }})"> <i class="ri-delete-bin-line"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Popup Modal --}}
    <div class="fixed bg-gray-600 inset-0 bg-opacity-50 backdrop-blur-sm hidden items-center justify-center" id="popup">
        <form id="deleteForm" action="" method="POST" class="bg-white px-10 py-5 rounded-lg text-center">
            @csrf
            @method('DELETE')
            <p class="mb-4 text-lg font-semibold">Are you sure you want to delete this category?</p>
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Yes, Delete</button>
            <a href="javascript:void(0);" class="bg-red-600 text-white px-3 py-1 rounded cursor-pointer"
                onclick="hidePopup()">Cancel</a>
        </form>
    </div>
    {{-- End of Popup Modal --}}

    <script>
        function showPopup(categoryId) {
            console.log('Popup shown for category ID:', categoryId);
            document.getElementById('popup').classList.remove('hidden');
            document.getElementById('popup').classList.add('flex');

            // Update form action
            document.getElementById('deleteForm').action = `/category/${categoryId}`;
            document.getElementById('dataid').value = categoryId;
        }

        function hidePopup() {
            console.log('Popup hidden');
            document.getElementById('popup').classList.remove('flex');
            document.getElementById('popup').classList.add('hidden');
        }
    </script>
@endsection
