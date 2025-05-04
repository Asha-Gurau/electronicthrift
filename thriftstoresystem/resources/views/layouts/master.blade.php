<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thrift Store</title>
    <link rel="icon" href="{{ asset('image/thriftsecond1.jpg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

{{-- payment
<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
 --}}




    <!--scripts--->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.alert')

    <nav class="bg-pink-900 p-2">
        <div class="container mx-auto flex flex-wrap justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('image/thriftsecond1.jpg') }}" alt="Logo" class="h-12">
            </div>

            <!-- Toggle Button for Mobile -->
            <button id="menu-toggle" class="block lg:hidden text-white text-2xl focus:outline-none"
                aria-label="Toggle navigation">
                <i class="ri-menu-line"></i>
            </button>

            <!-- Menu Items -->
            <div id="menu-items" class="hidden lg:flex lg:items-center lg:gap-6 w-full lg:w-auto">
                <!-- Search Bar -->
                <div class="w-full lg:w-auto mb-4 lg:mb-0">
                    <form action="{{ route('search') }}" method="GET" class="flex items-center space-x-2 mt-4">
                        <input type="search" name="search"
                            class="w-full lg:w-64 border border-gray-300 rounded-lg px-3 py-1" placeholder="Search"
                            value="{{ request()->query('search') }}">
                        <button type="submit" class="bg-blue-900 text-white rounded-lg px-4 py-2 ml-4">
                            <i class="ri-find-replace-line text-lg"></i>
                        </button>
                    </form>
                </div>

                <!-- Navigation Links -->
                <div class="flex flex-col lg:flex-row lg:gap-4 text-white">
                    <a href="{{ route('home') }}" class="hover:text-yellow-200">Home</a>
                    <a href="#about" class="hover:text-yellow-200">About Us</a>
                    <a href="#contact" class="hover:text-yellow-200">Contact Us</a>
                    @php
                        $categories = App\Models\Category::orderBy('priority')->get();
                    @endphp
                    @foreach ($categories->take(1) as $category)
                        <a href="{{ route('categoryproduct', $category->id) }}"
                            class="hover:text-yellow-200">{{ $category->name }}</a>
                    @endforeach


                    <!-- User Authentication Links -->
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 text-white">
                                <i class="ri-user-3-line text-xl bg-gray-200 p-2 rounded-full"></i>
                            </button>
                            <div
                                class="absolute hidden group-hover:block bg-white text-black rounded-md shadow-lg mt-2 w-40 right-0 z-50">
                                <a href="{{ route('mycart') }}" class="block py-2 px-4 hover:bg-gray-200">My Cart</a>

                                <a href="{{ route('user.orders') }}" class="block py-2 px-4 hover:bg-gray-200">My Orders</a>

                                <a href="{{ route('productrequest.create') }}" class="block py-2 px-4 hover:bg-gray-200">Add
                                    Product</a>
                                <a href="{{ route('profile.edit') }}" class="block py-2 px-4 hover:bg-gray-200">My
                                    Profile</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left py-2 px-4 hover:bg-gray-200">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-blue-900">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>


    <main>
        @yield('content')
    </main>

    <footer class="bg-pink-900 text-white px-16 py-4 mt-10">
        <div id="about">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <h1 class="text-2xl">Information</h1>
                    <p>About us</p>
                    <p>delivery information</p>
                    <p>privacy Policy</p>
                    <p>Terms $ Conditions</p>
                </div>
                <div>
                    <h1 class="text-2xl">Quick Link</h1>
                    <ul>
                        <li>my account</li>
                        <li>Order History</li>
                        <li>Find a wish list</li>
                        <li>Gift Certificates</li>
                    </ul>
                </div>
                <div id="contact">
                    <div>
                        <h1 class="text-2xl">Customer Services</h1>
                        <p>Contact Us</p>
                        <p>Returns</p>
                        <p>Blog</p>
                        <p>Email:info@info.com</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>


<script>
    // Toggle Menu for Mobile View
    const menuToggle = document.getElementById('menu-toggle');
    const menuItems = document.getElementById('menu-items');
    menuToggle.addEventListener('click', () => {
        menuItems.classList.toggle('hidden');
    });
</script>
