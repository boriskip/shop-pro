@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden"
        style="background: linear-gradient(135deg, rgba(79, 39, 245, 0.8) 0%, rgba(168, 85, 247, 0.8) 50%, rgba(236, 72, 153, 0.8) 100%), url('https://images.unsplash.com/photo-1557821552-17105176677c?w=1200&h=600&fit=crop') center/cover no-repeat;
                 background-attachment: fixed;">

        <!-- Content -->
        <div class="relative z-20 w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-32 pb-40">
            <div class="text-center space-y-10 animate-fade-in flex flex-col items-center">
                <!-- Badge -->
                <div class="inline-block">
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium bg-white/10 text-white border border-white/20 backdrop-blur-sm hover:bg-white/20 transition-all">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        Welcome to the future of shopping
                    </span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight drop-shadow-lg max-w-3xl">
                    Discover Amazing Products Today
                </h1>

                <!-- Subheading -->
                <p class="text-base md:text-lg text-gray-100 max-w-2xl leading-relaxed drop-shadow-md">
                    Explore our innovative and dynamic shopping platform with the best products at competitive prices.
                    Premium quality, fast delivery, and exceptional service.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center pt-6 mb-8">
                    <a href="{{ route('products.index') }}"
                        class="inline-flex justify-center items-center gap-2 px-8 py-4 rounded-lg text-base font-semibold text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Shop Now
                    </a>
                    <a href="{{ route('products.index') }}"
                        class="inline-flex justify-center items-center gap-2 px-8 py-4 rounded-lg text-base font-semibold text-white bg-white/20 border-2 border-white hover:bg-white/30 backdrop-blur-sm transition-all duration-300 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        Explore
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 pt-8 w-full max-w-2xl">
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/20">
                        <p class="text-2xl md:text-3xl font-bold text-white">10K+</p>
                        <p class="text-gray-100 text-xs md:text-sm mt-1">Products</p>
                    </div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/20">
                        <p class="text-2xl md:text-3xl font-bold text-white">50K+</p>
                        <p class="text-gray-100 text-xs md:text-sm mt-1">Customers</p>
                    </div>
                    <div class="text-center bg-white/10 backdrop-blur-sm rounded-lg p-3 border border-white/20">
                        <p class="text-2xl md:text-3xl font-bold text-white">24/7</p>
                        <p class="text-gray-100 text-xs md:text-sm mt-1">Support</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
            <div class="flex flex-col items-center gap-2 animate-bounce">
                <span class="text-white text-sm font-medium">Scroll to explore</span>
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }
    </style>

    <!-- Featured Categories -->
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-8 text-center">Shop by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug ?? strtolower($category->name)]) }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                        <div class="h-40 overflow-hidden bg-gray-100">
                            @php
                                // Массив дефолтных изображений для категорий
                                $defaultImages = [
                                    'https://images.unsplash.com/photo-1510557880182-3a5352b18b59?w=1200&h=600&auto=format&fit=crop&q=80',
                                    'https://images.unsplash.com/photo-1520975914100-8b1d1f9f444f?w=1200&h=600&auto=format&fit=crop&q=80',
                                    'https://images.unsplash.com/photo-1505691723518-36a62f3b6f1f?w=1200&h=600&auto=format&fit=crop&q=80',
                                    'https://images.unsplash.com/photo-1519681393784-d120267933ba?w=1200&h=600&auto=format&fit=crop&q=80'
                                ];
                                
                                // Используем изображение категории, если есть, иначе дефолтное по индексу
                                $imageUrl = $category->image_url;
                                if (empty($imageUrl)) {
                                    $imageUrl = $defaultImages[($loop->index) % count($defaultImages)] ?? 'https://picsum.photos/600/400?random=' . $category->id;
                                }
                            @endphp
                            <img src="{{ $imageUrl }}"
                                alt="{{ $category->name }}" class="w-full h-full object-cover" loading="lazy"
                                onerror="this.onerror=null;this.src='https://picsum.photos/600/400?random={{ $category->id }}'">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-medium">{{ $category->name }}</h3>
                        </div>
                    </div>
                </a>
            @empty
                <!-- Fallback categories if no categories in database -->
                <a href="{{ route('products.index', ['category' => 'electronics']) }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                        <div class="h-40 overflow-hidden bg-gray-100">
                            <img src="https://images.unsplash.com/photo-1510557880182-3a5352b18b59?w=1200&h=600&auto=format&fit=crop&q=80"
                                alt="Electronics" class="w-full h-full object-cover" loading="lazy"
                                onerror="this.onerror=null;this.src='https://via.placeholder.com/600x400?text=Electronics'">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-medium">Electronics</h3>
                        </div>
                    </div>
                </a>
                <a href="{{ route('products.index', ['category' => 'clothing']) }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                        <div class="h-40 overflow-hidden bg-gray-100">
                            <img src="https://images.unsplash.com/photo-1520975914100-8b1d1f9f444f?w=1200&h=600&auto=format&fit=crop&q=80"
                                alt="Clothing" class="w-full h-full object-cover" loading="lazy"
                                onerror="this.onerror=null;this.src='https://via.placeholder.com/600x400?text=Clothing'">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-medium">Clothing</h3>
                        </div>
                    </div>
                </a>
                <a href="{{ route('products.index', ['category' => 'home']) }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                        <div class="h-40 overflow-hidden bg-gray-100">
                            <img src="https://images.unsplash.com/photo-1505691723518-36a62f3b6f1f?w=1200&h=600&auto=format&fit=crop&q=80"
                                alt="Home & Living" class="w-full h-full object-cover" loading="lazy"
                                onerror="this.onerror=null;this.src='https://via.placeholder.com/600x400?text=Home'">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-medium">Home & Living</h3>
                        </div>
                    </div>
                </a>
                <a href="{{ route('products.index', ['category' => 'books']) }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                        <div class="h-40 overflow-hidden bg-gray-100">
                            <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?w=1200&h=600&auto=format&fit=crop&q=80"
                                alt="Books" class="w-full h-full object-cover" loading="lazy"
                                onerror="this.onerror=null;this.src='https://via.placeholder.com/600x400?text=Books'">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-medium">Books</h3>
                        </div>
                    </div>
                </a>
            @endforelse
        </div>
    </div>

    <!-- Latest Products -->
    <div class="container mx-auto px-4 py-12 bg-gray-50">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold">Latest Products</h2>
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">View All</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($latestProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/600x400?text=No+Image' }}"
                            alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <a href="{{ route('products.show', $product->id) }}"
                            class="text-lg font-medium text-gray-900 hover:text-blue-600">{{ $product->name }}</a>
                        <p class="text-gray-500 mt-1">{{ Str::limit($product->description, 60) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-900 font-bold">${{ number_format($product->price, 2) }}</span>
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700">Add to
                                    Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Special Offers -->
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Special Offers</h2>
            <p class="text-gray-600">Limited time deals you don't want to miss</p>
        </div>
        <div class="bg-gradient-to-br from-purple-600 via-blue-600 to-pink-600 shadow-2xl overflow-hidden relative" style="background: linear-gradient(135deg, #9333ea 0%, #2563eb 50%, #db2777 100%); border-radius: 24px 18px 28px 22px;">
            <!-- Decorative background elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>
            
            <div class="md:flex relative z-10">
                <!-- Left side - Banner content -->
                <div class="md:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center relative" style="background: linear-gradient(135deg, rgba(147, 51, 234, 0.95) 0%, rgba(37, 99, 235, 0.95) 50%, rgba(219, 39, 119, 0.95) 100%);">
                    <!-- Badge -->
                    <div class="mb-6" style="padding-left: 5px;">
                        <span class="inline-block bg-white/30 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold border-2 border-white/50 shadow-lg">
                            ⚡ Limited Time Offer
                        </span>
                    </div>
                    
                    <!-- Heading -->
                    <h3 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight text-white drop-shadow-lg" style="padding-left: 5px;">
                        Summer Sale
                        <span class="block text-3xl md:text-4xl lg:text-5xl mt-2 text-yellow-300 drop-shadow-md">Up to 50% OFF</span>
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-lg md:text-xl mb-8 text-white leading-relaxed max-w-md drop-shadow-md" style="color: #ffffff; text-shadow: 0 2px 4px rgba(0,0,0,0.2); padding-left: 5px;">
                        Get incredible discounts on selected items. Premium quality products at unbeatable prices. Don't wait - this offer won't last long!
                    </p>
                    
                    <!-- CTA Button -->
                    <div style="padding-left: 5px;">
                        <a href="{{ route('products.index', ['sale' => 'true']) }}"
                            class="inline-block bg-white text-purple-600 font-bold py-4 px-8 rounded-full hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl text-lg w-fit group">
                            <span class="flex items-center gap-2">
                                Shop Now
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                    
                    <!-- Additional info -->
                    <div class="mt-8 flex items-center gap-6" style="padding-left: 5px;">
                        <div class="flex items-center gap-2 text-white" style="text-shadow: 0 1px 2px rgba(0,0,0,0.3);">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="filter: drop-shadow(0 1px 2px rgba(0,0,0,0.3));">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-sm font-medium">Free Shipping</span>
                        </div>
                        <div class="flex items-center gap-2 text-white" style="text-shadow: 0 1px 2px rgba(0,0,0,0.3);">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="filter: drop-shadow(0 1px 2px rgba(0,0,0,0.3));">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm font-medium">Fast Delivery</span>
                        </div>
                    </div>
                </div>
                
                <!-- Right side - Image -->
                <div class="md:w-1/2 bg-gradient-to-br from-white to-gray-50 flex items-center justify-center p-8 md:p-12 relative overflow-hidden">
                    <!-- Image container with elegant frame -->
                    <div class="relative w-full max-w-lg">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-200/50 to-blue-200/50 blur-2xl transform rotate-6" style="border-radius: 32px 20px 28px 24px;"></div>
                        <div class="relative overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-500" style="border-radius: 20px 28px 24px 18px;">
                            <img src="https://images.unsplash.com/photo-1607082349566-187342175e2f?w=1200&h=800&auto=format&fit=crop&q=80"
                                alt="Summer Sale Collection" 
                                class="w-full h-full object-cover">
                            <!-- Image overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                        </div>
                        <!-- Decorative corner elements -->
                        <div class="absolute -top-4 -right-4 w-24 h-24 bg-yellow-400 rounded-full opacity-20 blur-xl"></div>
                        <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-pink-400 rounded-full opacity-20 blur-xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="container mx-auto px-4 py-12 bg-gray-50">
        <h2 class="text-2xl font-bold mb-8 text-center">What Our Customers Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div
                        class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 font-bold text-xl">
                        J</div>
                    <div class="ml-4">
                        <h3 class="font-medium">John Doe</h3>
                        <div class="flex text-yellow-400">
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"Great products and fast shipping. I'm very satisfied with my purchase and will
                    definitely shop here again!"</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div
                        class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-500 font-bold text-xl">
                        S</div>
                    <div class="ml-4">
                        <h3 class="font-medium">Sarah Smith</h3>
                        <div class="flex text-yellow-400">
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"The customer service is exceptional. They helped me resolve an issue with my
                    order quickly and efficiently."</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div
                        class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center text-red-500 font-bold text-xl">
                        M</div>
                    <div class="ml-4">
                        <h3 class="font-medium">Michael Johnson</h3>
                        <div class="flex text-yellow-400">
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600">"The quality of the products exceeded my expectations. Will definitely recommend
                    to friends and family!"</p>
            </div>
        </div>
    </div>
@endsection
