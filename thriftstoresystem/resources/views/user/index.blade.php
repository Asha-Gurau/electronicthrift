@extends('layouts.app')

@section('content')
<h1 class="text-4xl font-extrabold text-blue-900">User Details</h1>
<hr class="h-1 bg-red-500">
<div class="overflow-x-auto">
    <table class="w-full border-collapse mt-5">
        <thead>
            <tr>
                <th class="border p-2 bg-gray-200">ID</th>
                <th class="border p-2 bg-gray-200">Name</th>
                <th class="border p-2 bg-gray-200">Email</th>
                <th class="border p-2 bg-gray-200">Created At</th>
                <th class="border p-2 bg-gray-200">Last Updated</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="border p-2">{{ $user->id }}</td>
                <td class="border p-2">{{ $user->name }}</td>
                <td class="border p-2">{{ $user->email }}</td>
                <td class="border p-2">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                <td class="border p-2">{{ $user->updated_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
