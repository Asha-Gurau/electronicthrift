@extends('layouts.master')
@section('content')
    <div class="px-16">
        <div class="border-l-4 border-blue-900 pl-2">
            <h1 class="text-2xl font-bold">search Results</h1>
            <p>search Results</p>
        </div>
        <div class="grid grid-cols-4 gap-10 mt-5">
            @forelse ($products as $product)
                <a href="{{ route('viewproduct', $product->id) }}">
                    <div class="border rounded-lg bg-gray-100 hover:-translate-y-2 duration-300 shadow hover:shadow-lg">
                        <img src="{{ asset('images/products/' . $product->photopath) }}" alt=""
                            class="h-64 w-full object-cover rounded-t-lg">
                        <div class="p-4">
                            <h1 class="text-lg font-bold">{{ $product->Name }}</h1>
                            @if ($product->discounted_price != '')
                                <p class="text-blue-900 font-bold text-lg">
                                    Rs.1500
                                    <span class="line-through font-thin tetx-sm text-red-600">Rs.2000</span>
                                </p>
                            @else
                                <p class="text-blue-900 font-bold text-lg">
                                    Rs. {{ $product->price }}
                                </p>
                            @endif
                        </div>

                    </div>
                </a>
            @empty
                <p>NO Products Found</p>
            @endforelse
        </div>

    </div>
@endsection
