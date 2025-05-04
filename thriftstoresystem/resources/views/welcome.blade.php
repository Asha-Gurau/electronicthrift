@extends('layouts.master')
@section('content')
    {{-- Banner Section --}}
{{-- <div class="banner-swiper swiper mySwiper">
    <div class="swiper-wrapper">
        @foreach ($banners as $banner)
            <div class="swiper-slide"> --}}
                 {{-- <img src="{{ asset('images/banners/' . $banner->photopath) alt="{{$banner->title}}"}}"
                    class="banner-image"> --}}
                <!-- Overlay with Shadow Inside -->
                {{-- <div class="absolute top-16 left-32 right-32 bottom-16 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white text-center">
                    <h1 class="text-4xl font-bold mb-4">{{banner->title}}</h1>
                    <p class="mb-6">{{banner->description}}</p>
                    <a href="#"
                        class="bg-sky-600 text-white px-6 py-3 rounded-md no-underline hover:bg-sky-400 transition duration-300">Shop Now</a>
                 </div> --}}
            {{-- </div>
        @endforeach --}}

    {{-- </div> --}}

    <!-- Swiper pagination -->
    {{-- <div class="swiper-pagination"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.mySwiper', {
            loop: true,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    });
</script> --}}


<div class="banner-swiper swiper mySwiper">
    <div class="swiper-wrapper">
        <!-- First Slide -->
        <div class="swiper-slide">
            <div class="relative w-full max-w-5xl mx-auto overflow-hidden rounded-lg shadow-lg">
                <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
                    <img src="{{ asset('image/household.png') }}" alt="Banner Image"
                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700 ease-in-out">
                </div>

                <!-- Overlay with Shadow Inside -->
                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white text-center px-6">
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">"Sustainable Shopping Starts Here"</h1>
                    <p class="mb-6 text-lg">"Affordable | Eco-friendly | Top-quality secondhand electronics"</p>
                    <a href="#" class="bg-sky-600 text-white px-6 py-3 rounded-md no-underline hover:bg-sky-400 transition duration-300">Shop Now</a>
                </div>
            </div>
        </div>

        <!-- Second Slide -->
        <div class="swiper-slide">
            <div class="relative w-full max-w-5xl mx-auto overflow-hidden rounded-lg shadow-lg">
                <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden">
                    <img src="{{ asset('image/homeappliances.png') }}" alt="Banner Image"
                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700 ease-in-out">
                </div>

                <!-- Overlay with Shadow Inside -->
                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white text-center px-6">
                    <h1 class="text-3xl md:text-4xl font-bold mb-4">""Shop Smart, Save Big!""</h1>
                    <p class="mb-6 text-lg">(Discover eco-conscious deals on electronics.)</p>
                    <a href="#" class="bg-sky-600 text-white px-6 py-3 rounded-md no-underline hover:bg-sky-400 transition duration-300">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Swiper pagination -->
    <div class="swiper-pagination"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.mySwiper', {
            loop: true,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    });
</script>


<style>
    /* Styles scoped for the banner section */
    .banner-swiper {
        width: 100%;
        height: 100vh;
        /* Full height of the viewport */
        margin: 0 auto;
    }

    .banner-swiper .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
        /* Full height of the viewport */
    }

    .banner-image {
        object-fit: cover;
        /* Ensure the image maintains aspect ratio */
        width: 80%;
        /* Set the width to 70% of the viewport width */
        height: 80vh;
        /* Set height explicitly to 80% of the viewport height */
        max-height: 800px;
        /* Add a max-height for medium-sized devices */
        margin: 0 auto;
        /* Center the image horizontally */
        border-radius: 10px;
        /* Optional: Add rounded corners */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        /* Optional: Add a shadow for better visual impact */
    }

    /* Hiding swiper navigation arrows */
    .swiper-button-next, .swiper-button-prev {
        display: none !important;
    }

    /* Optional: Swiper Pagination Styling */
    .swiper-pagination {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
    }

    .swiper-pagination-bullet {
        background-color: white;
        opacity: 0.6;
    }

    .swiper-pagination-bullet-active {
        background-color: #1d4ed8;
    }
</style>

    <!-- Featured Products Section -->
    <div class="container px-3 px-lg-5 my-5">
        <!-- Section Title -->
        <div class="border-start border-primary pl-2 mb-4">
            <h1 class="text-2xl font-extrabold text-pink-900">Featured Products</h1>
            <p class="text-muted text-pink-400">Check out our featured products below!</p>
        </div>
        {{-- Product Section --}}
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('viewproduct', $product->id) }}" class="text-decoration-none">
                        <div class="card shadow-lg h-100 transition-transform hover:shadow-xl hover:scale-105 rounded-3"
                            style="background-color: #e9ecef; overflow: hidden;"> <!-- Gray Background -->

                            <!-- Product Image -->
                            <div class="position-relative" style="height: 200px; background-color: #f1f1f1;">
                                <img src="{{ asset('images/products/' . $product->photopath) }}"
                                    class="card-img-top img-fluid" alt="{{ $product->name }}" loading="lazy"
                                    style="max-height: 100%; max-width: 100%; margin: auto; object-fit: contain; display: block;">
                            </div>

                            <!-- Product Info -->
                            <div class="card-body">
                                <!-- Product Name -->
                                <h5 class="card-title fw-bold text-truncate mb-2"
                                    style="font-size: 1.1rem; color: #020502d0; text-align: left;">
                                    {{ $product->name }}
                                </h5>



                                <!-- Price -->
                                <p class="mb-0" style="text-align: left;">
                                    @if ($product->discounted_price)
                                        <span class="text-danger fw-bold">Rs.
                                            {{ number_format($product->discounted_price) }}</span>
                                        <span class="text-muted text-decoration-line-through ms-2">Rs.
                                            {{ number_format($product->price) }}</span>
                                    @else
                                        <span class="text-primary fw-bold">Rs. {{ number_format($product->price) }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</body>
@endsection
