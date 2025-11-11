@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Back Button -->
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center text-indigo-600 hover:text-indigo-700 mb-6 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Products
            </a>

            <!-- Main Product Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Product Image -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="aspect-square bg-gray-200 flex items-center justify-center">
                            <img src="{{ $product->image_url ?? 'https://picsum.photos/500/500?random=' . $product->id }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <p class="text-gray-600">Category</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $product->category->name ?? 'Uncategorized' }}</p>
                            </div>
                            <div>
                                @if ($product->inventory_count > 0)
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        In Stock ({{ $product->inventory_count }})
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="prose prose-sm max-w-none">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ $product->long_description ?? $product->description }}</p>
                        </div>
                    </div>

                    <!-- Inventory Logs -->
                    @isset($product->inventoryLogs)
                        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Inventory History</h3>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b-2 border-gray-200">
                                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date</th>
                                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Change</th>
                                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->inventoryLogs as $log)
                                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                                <td class="px-4 py-3 text-sm text-gray-900">
                                                    {{ $log->created_at->format('M d, Y H:i') }}</td>
                                                <td class="px-4 py-3 text-sm">
                                                    @if ($log->quantity_change > 0)
                                                        <span
                                                            class="text-green-600 font-semibold">+{{ $log->quantity_change }}</span>
                                                    @else
                                                        <span
                                                            class="text-red-600 font-semibold">{{ $log->quantity_change }}</span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-600">{{ $log->reason }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endisset
                </div>

                <!-- Sidebar - Price & Actions -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                        <!-- Price Section -->
                        @if ($product->isFree())
                            <div class="mb-6">
                                <p class="text-gray-600 text-sm">Price</p>
                                <p class="text-4xl font-bold text-indigo-600 mb-4">Free</p>
                                <a href="{{ route('download.generate-link', $product->id) }}"
                                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors text-center block">
                                    Download Now
                                </a>
                            </div>
                        @elseif($product->isDonationBased())
                            <div class="mb-6">
                                <p class="text-gray-600 text-sm">Support this product</p>
                                <p class="text-3xl font-bold text-indigo-600 mb-4">
                                    ${{ number_format($product->suggested_price, 2) }}</p>
                                <p class="text-xs text-gray-500 mb-4">Suggested price (minimum:
                                    ${{ number_format($product->minimum_price, 2) }})</p>
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="donation_amount"
                                            class="block text-sm font-medium text-gray-700 mb-2">Your amount:</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-3 text-gray-500">$</span>
                                            <input type="number" name="price" id="donation_amount"
                                                class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                                value="{{ $product->suggested_price }}"
                                                min="{{ $product->minimum_price }}" step="0.01">
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                                        Support & Download
                                    </button>
                                </form>
                                @if ($product->minimum_price <= 0)
                                    <a href="{{ route('download.generate-link', $product->id) }}"
                                        class="block text-center text-indigo-600 text-sm font-medium mt-3 hover:text-indigo-700">
                                        Download without donating
                                    </a>
                                @endif
                            </div>
                        @else
                            <div class="mb-6">
                                <p class="text-gray-600 text-sm">Price</p>
                                <p class="text-4xl font-bold text-indigo-600 mb-6">${{ number_format($product->price, 2) }}
                                </p>

                                @if ($product->inventory_count > 0)
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="quantity"
                                                class="block text-sm font-medium text-gray-700 mb-2">Quantity:</label>
                                            <input type="number" name="quantity" id="quantity"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                                value="1" min="1" max="{{ $product->inventory_count }}">
                                        </div>
                                        <button type="submit"
                                            class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button disabled
                                        class="w-full bg-gray-400 text-white py-3 rounded-lg font-semibold cursor-not-allowed">
                                        Out of Stock
                                    </button>
                                @endif
                            </div>
                        @endif

                        <!-- Wishlist Button -->
                        @auth
                            <div class="border-t pt-6">
                                @if (auth()->user()->wishlist()->where('product_id', $product->id)->exists())
                                    <form action="{{ route('wishlist.remove', $product) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full border-2 border-red-600 text-red-600 py-2 rounded-lg font-semibold hover:bg-red-50 transition-colors flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 00-5.656-5.656l-1.172 1.171-1.172-1.171a4 4 0 00-5.656 5.656l1.172 1.171L3.172 5.172z">
                                                </path>
                                            </svg>
                                            Remove from Wishlist
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('wishlist.add', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full border-2 border-indigo-600 text-indigo-600 py-2 rounded-lg font-semibold hover:bg-indigo-50 transition-colors flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>
                                            Add to Wishlist
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <div class="border-t pt-6">
                                <p class="text-sm text-gray-600 text-center">
                                    <a href="{{ route('login') }}"
                                        class="text-indigo-600 hover:text-indigo-700 font-medium">Sign in</a> to add to
                                    wishlist
                                </p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Recommended Products -->
            @if (isset($recommendations) && count($recommendations) > 0)
                <div class="mt-16">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">Recommended Products</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($recommendations as $recommendedProduct)
                            <div
                                class="group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">
                                <div class="aspect-square bg-gray-200 overflow-hidden">
                                    <img src="{{ $recommendedProduct->image_url ?? 'https://picsum.photos/300/300?random=' . $recommendedProduct->id }}"
                                        alt="{{ $recommendedProduct->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">
                                        {{ $recommendedProduct->name }}</h3>
                                    <p class="text-lg font-bold text-indigo-600 mb-3">
                                        ${{ number_format($recommendedProduct->price, 2) }}</p>
                                    <a href="{{ route('products.show', $recommendedProduct->id) }}"
                                        class="block w-full bg-indigo-600 text-white py-2 rounded-lg text-center font-semibold hover:bg-indigo-700 transition-colors text-sm">
                                        View Product
                                    </a>
                                    @if ($recommendedProduct->inventory_count == 0)
                                        <p class="text-red-600 text-xs font-medium mt-2 text-center">Out of Stock</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if (isset($product->downloadable) &&
            $product->downloadable->count() > 0 &&
            auth()->check() &&
            auth()->user()->hasPurchased($product))
        <div class="fixed bottom-8 right-8">
            <a href="{{ route('download.generate-link', $product->id) }}"
                class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition-colors shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download
            </a>
        </div>
    @endif

    <script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ $product->description }}",
    "image": "{{ $product->image_url ?? 'https://via.placeholder.com/600x400?text=No+Image' }}",
    "sku": "{{ $product->id }}",
    "mpn": "{{ $product->id }}",
    "brand": {
        "@type": "Brand",
        "name": "{{ config('app.name') }}"
    },
    "offers": {
        "@type": "Offer",
        "url": "{{ route('products.show', $product->id) }}",
        "priceCurrency": "USD",
        "price": "{{ $product->price }}",
        "availability": "{{ $product->inventory_count > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
        "seller": {
            "@type": "Organization",
            "name": "{{ config('app.name') }}"
        }
    }
}
</script>
@endsection

@section('meta')
    <meta name="description" content="{{ $product->meta_description ?? $product->short_description }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}">
    <meta property="og:title" content="{{ $product->meta_title ?? $product->name }}">
    <meta property="og:description" content="{{ $product->meta_description ?? $product->short_description }}">
    <meta property="og:image" content="{{ $product->image_url ?? 'https://via.placeholder.com/600x400?text=No+Image' }}">
    <meta property="og:url" content="{{ route('products.show', $product->id) }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection
