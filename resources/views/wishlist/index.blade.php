@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">❤️ My Wishlist</h1>
                <p class="text-gray-600">Save your favorite products for later</p>
            </div>

            <!-- Success Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-center gap-3">
                    <span class="text-green-600 text-xl">✓</span>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('share_url'))
                <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="font-semibold text-blue-900 mb-2">✓ Wishlist Shared!</h3>
                    <p class="text-blue-700 mb-3">Share this link with friends:</p>
                    <div class="flex items-center gap-2">
                        <input type="text" value="{{ session('share_url') }}"
                            class="flex-1 px-4 py-2 border border-blue-300 rounded-lg bg-white text-sm" readonly>
                        <button onclick="navigator.clipboard.writeText('{{ session('share_url') }}')"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                            Copy
                        </button>
                    </div>
                </div>
            @endif

            <!-- Share Button -->
            @if (!$wishlist->isEmpty())
                <div class="mb-6">
                    <form action="{{ route('wishlist.share') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg transition flex items-center gap-2">
                            <span>📤</span>
                            <span>Share Wishlist</span>
                        </button>
                    </form>
                </div>
            @endif

            <!-- Empty State -->
            @if ($wishlist->isEmpty())
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <div class="text-6xl mb-4">❤️</div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Your wishlist is empty</h2>
                    <p class="text-gray-600 mb-6">Start adding your favorite products to your wishlist!</p>
                    <a href="{{ route('products.index') }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition">
                        🛍️ Browse Products
                    </a>
                </div>
            @else
                <!-- Wishlist Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($wishlist as $item)
                        <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden group">
                            <!-- Product Image -->
                            <div class="relative h-48 bg-gray-200 overflow-hidden">
                                @if (isset($item->product->image_url))
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                                        </svg>
                                    </div>
                                @endif

                                <!-- Remove Button -->
                                <form action="{{ route('wishlist.remove', $item->product) }}" method="POST"
                                    class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition"
                                        title="Remove from wishlist">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>

                                <!-- Add to Cart Button on Hover -->
                                <form action="{{ route('cart.add', $item->product) }}" method="POST"
                                    class="absolute bottom-2 left-2 right-2 opacity-0 group-hover:opacity-100 transition">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                                        🛒 Add to Cart
                                    </button>
                                </form>
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 h-14">
                                    {{ $item->product->name }}
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $item->product->description ?? 'No description' }}
                                </p>

                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-gray-900">
                                        ${{ number_format($item->product->price, 2) }}
                                    </span>

                                    <!-- Rating -->
                                    @if (isset($item->product->rating))
                                        <div class="flex items-center gap-1">
                                            <span class="text-yellow-400">★</span>
                                            <span class="text-sm text-gray-600">
                                                {{ number_format($item->product->rating, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- View Product Link -->
                                <a href="{{ route('products.show', $item->product) }}"
                                    class="block mt-4 text-center text-blue-600 hover:text-blue-700 font-semibold text-sm transition">
                                    View Details →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Continue Shopping -->
                <div class="mt-12 text-center">
                    <a href="{{ route('products.index') }}"
                        class="inline-block text-gray-600 hover:text-gray-900 transition">
                        ← Back to Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        <style>
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    @endpush
@endsection
