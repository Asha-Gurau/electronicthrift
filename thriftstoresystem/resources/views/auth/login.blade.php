@extends('layouts.master')
@section('content')
<div class="flex justify-center items-center mt-20">
    <div class="w-96 bg-white p-6 rounded-lg border">
        <h1 class="text-2xl font-bold text-center">Login</h1>
        <form action="{{ route('login') }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-600 font-bold">Email</label>
                <input type="email" name="email" id="email" class="w-full border-gray-300 border rounded-lg px-3 py-2 mt-1">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-600 font-bold">Password</label>
                <input type="password" name="password" id="password" class="w-full border-gray-300 border rounded-lg px-3 py-2 mt-1">
            </div>
            <div class="text-right mb-4">
                <a href="{{ route('password.request') }}" class="text-blue-900 text-sm">Forgot password?</a>
            </div>
            <button type="submit" class="w-full bg-blue-900 text-white rounded-lg px-4 py-2">Login</button>
        </form>
        <div class="mt-4 text-center">
            <span class="text-gray-600">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-blue-900 font-bold">Register</a>
        </div>
    </div>
</div>
@endsection

