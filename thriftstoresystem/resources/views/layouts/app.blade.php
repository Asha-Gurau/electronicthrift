<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-slate-800">
    @include('layouts.alert')
    <div class="flex">
        <nav class="w-56 h-screen shadow-lg bg-gray-100">
            <img src="{{ asset('image/thriftsecond1.jpg') }}" alt="" class="w-32 mx-auto mt-4">
            <ul class="mt-8">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl @if (Route::is('dashboard')) bg-blue-900 text-white hover:bg-blue-700 @endif"><i
                            class="ri-dashboard-fill"></i>Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('category.index') }}"
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl @if (Route::is('category.*')) bg-blue-900 text-white hover:bg-blue-700 @endif">Categories</a>
                </li>
                <li>
                    <a href="{{ route('product.index') }}"
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl"><i
                            class="ri-store-line"></i>Products</a>
                </li>
                <li>
                    <a href="{{ route('order.index') }}"
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl"><i
                            class="ri-order-play-line"></i>Orders</a>
                </li>

                <li>

                    <a href="{{ route('user.index') }}"
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl"><i
                            class="ri-user-3-fill"></i>Users</a>
                </li>

                <li>
                    <a href="{{ route('admin.index') }}"
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl"><i
                            class="ri-user-3-fill"></i>Approval table</a>
                </li>


                {{-- <li>
                    <a href="{{ route('banner.index') }}"
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl"><i
                            class="ri-user-3-fill"></i>Banner</a>
                </li> --}}

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="hover:bg-gray-200 p-4 rounded-lg font-bold text-xl w-full text-left"><i
                                class="ri-logout-box-fill"></i>Logout</button>

                    </form>
                </li>
            </ul>
        </nav>
        <div class="p-4 flex-1">
            @yield('content')
        </div>
    </div>


</body>

</html>
