@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-cyan-600 text-white p-6 text-center">
                <h3 class="text-2xl font-semibold">Edit Profile</h3>
            </div>

            <div class="bg-stone-50 p-8">

                <!-- Success Message -->
                @if (session('status') == 'profile-updated')
                    <div class="alert alert-success bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                        <strong>Success!</strong> Your profile has been updated.
                    </div>
                @endif

                <!-- Profile Picture Section -->
                <div class="flex justify-center mb-6">
                    <div class="relative">
                        <!-- Displaying the Profile Picture (Circle) -->
                        <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Profile Picture" class="h-32 w-32 rounded-full border-4 border-cyan-600 object-cover">
                        <!-- Change Picture Icon -->
                        <label for="profile_picture" class="absolute bottom-0 right-0 bg-cyan-600 text-white rounded-full p-2 cursor-pointer hover:bg-cyan-700">
                            <i class="ri-camera-line text-lg"></i>
                        </label>
                    </div>
                </div>

                <!-- Profile Form -->
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Name -->
                    <div class="mb-4 flex flex-col">
                        <label for="name" class="text-stone-700 text-sm font-medium mb-2 flex items-center">
                            <i class="ri-user-line mr-2"></i> Full Name
                        </label>
                        <input type="text" id="name" name="name" class="mt-1 px-4 py-2 border border-stone-300 rounded-md shadow-sm focus:ring-2 focus:ring-cyan-500 text-sm" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4 flex flex-col">
                        <label for="email" class="text-stone-700 text-sm font-medium mb-2 flex items-center">
                            <i class="ri-mail-line mr-2"></i> Email Address
                        </label>
                        <input type="email" id="email" name="email" class="mt-1 px-4 py-2 border border-stone-300 rounded-md shadow-sm focus:ring-2 focus:ring-cyan-500 text-sm" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-4 flex flex-col">
                        <label for="phone" class="text-stone-700 text-sm font-medium mb-2 flex items-center">
                            <i class="ri-phone-line mr-2"></i> Phone Number
                        </label>
                        <input type="text" id="phone" name="phone" class="mt-1 px-4 py-2 border border-stone-300 rounded-md shadow-sm focus:ring-2 focus:ring-cyan-500 text-sm" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <!-- Address -->
                    <div class="mb-6 flex flex-col">
                        <label for="address" class="text-stone-700 text-sm font-medium mb-2 flex items-center">
                            <i class="ri-map-pin-line mr-2"></i> Address
                        </label>
                        <input type="text" id="address" name="address" class="mt-1 px-4 py-2 border border-stone-300 rounded-md shadow-sm focus:ring-2 focus:ring-cyan-500 text-sm" value="{{ old('address', $user->address) }}">
                    </div>

                    <button type="submit" class="w-full bg-cyan-600 text-white py-2 rounded-md shadow-lg hover:bg-cyan-700 focus:outline-none focus:ring-4 focus:ring-cyan-300 text-sm">
                        Update Profile
                    </button>
                </form>

                <hr class="my-8">

                <!-- Delete Account Form -->
                <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4">
                    @csrf
                    @method('DELETE')

                    <div class="mb-4 flex flex-col">
                        <label for="password" class="text-stone-700 text-sm font-medium mb-2 flex items-center">
                            <i class="ri-lock-line mr-2"></i> Confirm Password
                        </label>
                        <input type="password" id="password" name="password" class="mt-1 px-4 py-2 border border-stone-300 rounded-md shadow-sm focus:ring-2 focus:ring-cyan-500 text-sm" required>
                    </div>

                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-md shadow-lg hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 text-sm">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
