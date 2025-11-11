@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white p-4 rounded-lg shadow sticky top-4">
                    <h3 class="text-lg font-bold mb-4">📂 Categories</h3>
                    <div class="space-y-1">
                        <a href="{{ route('products.index') }}"
                            class="block px-3 py-2 rounded text-sm {{ !request('category') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            All Products
                        </a>
                        @foreach ($categories as $category)
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                                class="block px-3 py-2 rounded text-sm {{ request('category') == $category->slug ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                <span>{{ $category->name }}</span>
                                <span class="text-xs ml-1">({{ $category->products->count() }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-4">
                <!-- Sorting -->
                <div class="mb-6">
                    <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2">
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <label for="sort" class="text-sm font-medium">Sort:</label>
                        <select name="sort" id="sort" class="border border-gray-300 rounded-md p-2 text-sm"
                            onchange="this.form.submit()">
                            <option value="">Default</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price: Low to High
                            </option>
                            <option value="-price" {{ request('sort') == '-price' ? 'selected' : '' }}>Price: High to Low
                            </option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A-Z</option>
                            <option value="-created_at" {{ request('sort') == '-created_at' ? 'selected' : '' }}>Newest
                            </option>
                        </select>
                    </form>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <div class="bg-white rounded-lg border border-gray-200 shadow hover:shadow-lg transition">
                                <div class="relative">
                                    <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}"
                                        class="w-full h-48 object-cover rounded-t-lg">
                                </div>

                                <div class="p-3">
                                    <h3 class="font-semibold text-sm text-gray-800 line-clamp-2 h-10">
                                        <a href="{{ route('products.show', $product) }}" class="hover:text-blue-600">
                                            {{ $product->name }}
                                        </a>
                                    </h3>

                                    <div class="flex items-center gap-1 my-2">
                                        @for ($i = 0; $i < 5; $i++)
                                            <span class="text-yellow-400">★</span>
                                        @endfor
                                        <span class="text-xs text-gray-500 ml-1">(5)</span>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <span
                                            class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-2 py-1 rounded transition">
                                                Add
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500">No products found</p>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
