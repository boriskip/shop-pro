<div class="shopping-cart py-6">
    <div class="container mx-auto px-4 max-w-5xl">
        <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (count($items) > 0)
            <div class="flex gap-6">
                <!-- Cart Items - Takes 70% width -->
                <div class="flex-1">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-100 border-b">
                                    <tr>
                                        <th class="text-left px-4 py-3 font-semibold text-gray-700">Product</th>
                                        <th class="text-center px-4 py-3 font-semibold text-gray-700">Price</th>
                                        <th class="text-center px-4 py-3 font-semibold text-gray-700">Qty</th>
                                        <th class="text-center px-4 py-3 font-semibold text-gray-700">Total</th>
                                        <th class="text-center px-4 py-3 font-semibold text-gray-700">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $id => $item)
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center gap-3">
                                                    @if (isset($item['image']))
                                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                                            class="w-16 h-16 object-cover rounded border">
                                                    @else
                                                        <div
                                                            class="w-16 h-16 bg-gray-200 rounded border flex items-center justify-center text-gray-400">
                                                            <svg class="w-8 h-8" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div class="min-w-0">
                                                        <h6 class="font-semibold text-gray-800 truncate">
                                                            {{ $item['name'] }}</h6>
                                                        @if ($item['is_downloadable'])
                                                            <span
                                                                class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded">Digital</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-center text-gray-700 font-medium">
                                                ${{ number_format($item['price'], 2) }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <button
                                                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-2 py-1 rounded transition"
                                                        wire:click="updateQuantity('{{ $id }}', {{ max(1, $item['quantity'] - 1) }})">−</button>
                                                    <input type="number"
                                                        class="w-12 text-center border border-gray-300 rounded py-1"
                                                        wire:model.lazy="items.{{ $id }}.quantity"
                                                        wire:change="updateQuantity('{{ $id }}', $event.target.value)"
                                                        min="1">
                                                    <button
                                                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-2 py-1 rounded transition"
                                                        wire:click="updateQuantity('{{ $id }}', {{ $item['quantity'] + 1 }})">+</button>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-center font-semibold text-gray-800">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <button
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition"
                                                    wire:click="removeItem('{{ $id }}')">
                                                    Remove
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded transition"
                            wire:click="clearCart">
                            Clear Cart
                        </button>
                    </div>
                </div>

                <!-- Order Summary - Fixed width on the right -->
                <div class="w-80 flex-shrink-0">
                    <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                        <h3 class="text-xl font-bold mb-6 text-gray-800">Order Summary</h3>

                        <div class="space-y-3 mb-4 pb-4 border-b">
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal:</span>
                                <span class="font-semibold">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>Shipping:</span>
                                <span class="text-sm text-gray-500">Calculated at checkout</span>
                            </div>
                            <div class="flex justify-between text-gray-700">
                                <span>Tax:</span>
                                <span class="text-sm text-gray-500">Calculated at checkout</span>
                            </div>
                        </div>

                        <div class="flex justify-between mb-6 text-lg font-bold text-gray-900">
                            <span>Total:</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>

                        <a href="{{ route('checkout.initiate') }}"
                            class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded text-center transition">
                            Proceed to Checkout
                        </a>

                        <a href="{{ route('products.index') }}"
                            class="block w-full mt-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 rounded text-center transition">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <h3 class="text-xl font-bold mb-2 text-gray-800">Your cart is empty</h3>
                <p class="text-gray-600 mb-4 text-sm">No products added yet.</p>
                <a href="{{ route('products.index') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded text-sm transition">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
