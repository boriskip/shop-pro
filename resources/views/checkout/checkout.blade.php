@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Checkout</h1>
                <p class="text-gray-600">Complete your purchase securely</p>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <h3 class="font-semibold text-red-800 mb-2">Please fix these errors:</h3>
                    <ul class="list-disc list-inside text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Form -->
                <div class="lg:col-span-2">
                    <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form" class="space-y-6">
                        @csrf

                        <!-- Contact Information -->
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h2>
                            <div class="space-y-4">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address
                                        *</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="you@example.com" required>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Information -->
                        @if ($hasPhysicalProducts)
                            <div class="bg-white rounded-lg shadow p-6">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">Shipping Information</h2>
                                <div class="space-y-4">
                                    <div>
                                        <label for="shipping_address"
                                            class="block text-sm font-medium text-gray-700 mb-2">Shipping Address *</label>
                                        <textarea id="shipping_address" name="shipping_address" rows="3"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="123 Main St, City, State ZIP" required>{{ old('shipping_address') }}</textarea>
                                        @error('shipping_address')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="shipping_method"
                                            class="block text-sm font-medium text-gray-700 mb-2">Shipping Method *</label>
                                        <select id="shipping_method" name="shipping_method_id"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            required>
                                            <option value="">Select a shipping method</option>
                                            @foreach ($shippingMethods as $method)
                                                <option value="{{ $method->id }}"
                                                    data-base-rate="{{ $method->base_rate }}">
                                                    {{ $method->name }} - ${{ number_format($method->base_rate, 2) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('shipping_method_id')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Payment Information -->
                        @if ($total > 0)
                            <div class="bg-white rounded-lg shadow p-6">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">Payment Method</h2>
                                <div class="space-y-4">
                                    <div>
                                        <label for="payment_method"
                                            class="block text-sm font-medium text-gray-700 mb-3">Choose Payment Method
                                            *</label>
                                        <select id="payment_method" name="payment_method"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            required>
                                            <option value="stripe">💳 Credit Card (Stripe)</option>
                                            <option value="paypal">🅿️ PayPal</option>
                                        </select>
                                        @error('payment_method')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Stripe Payment -->
                                    <div id="stripe-payment" class="mt-4">
                                        <div id="card-element" class="p-3 border border-gray-300 rounded-lg bg-white"></div>
                                        <div id="card-errors" class="text-red-500 text-sm mt-2" role="alert"></div>
                                    </div>

                                    <!-- PayPal Payment -->
                                    <div id="paypal-payment" class="hidden mt-4">
                                        <div id="paypal-button-container"></div>
                                        <input type="hidden" name="paypal_payment_id" id="paypal_payment_id">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <button type="submit" id="submit-button"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            {{ $total > 0 ? '💳 Complete Purchase - $' . number_format($total, 2) : '✓ Complete Order' }}
                        </button>

                        <!-- Back to Cart -->
                        <a href="{{ route('cart.index') }}"
                            class="block text-center text-gray-600 hover:text-gray-900 transition">
                            ← Back to Cart
                        </a>
                    </form>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow sticky top-6">
                        <!-- Header -->
                        <div class="bg-gray-50 border-b p-6 rounded-t-lg">
                            <h3 class="text-2xl font-bold text-gray-900">Order Summary</h3>
                        </div>

                        <!-- Items -->
                        <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                            @foreach ($cart as $productId => $item)
                                <div class="flex items-start justify-between pb-4 border-b last:border-b-0">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900">{{ $item['name'] }}</p>
                                        <p class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</p>
                                    </div>
                                    <p class="font-semibold text-gray-900 ml-4">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Totals -->
                        <div class="p-6 border-t space-y-3 bg-gray-50">
                            <div class="flex justify-between text-gray-700">
                                <span>Subtotal:</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>

                            @if ($hasPhysicalProducts)
                                <div class="flex justify-between text-gray-700">
                                    <span>Shipping:</span>
                                    <span id="shipping-cost-amount">$0.00</span>
                                </div>
                            @endif

                            <div class="flex justify-between text-lg font-bold text-gray-900 pt-3 border-t">
                                <span>Total:</span>
                                <span id="total-amount">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <!-- Security Badge -->
                        <div class="p-6 border-t text-center">
                            <p class="text-xs text-gray-600 flex items-center justify-center gap-2">
                                <span>🔒</span>
                                <span>Secure checkout powered by Stripe & PayPal</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle payment methods
                const paymentMethodSelect = document.getElementById('payment_method');
                const stripePayment = document.getElementById('stripe-payment');
                const paypalPayment = document.getElementById('paypal-payment');

                if (paymentMethodSelect) {
                    paymentMethodSelect.addEventListener('change', function() {
                        if (this.value === 'stripe') {
                            stripePayment.classList.remove('hidden');
                            paypalPayment.classList.add('hidden');
                        } else if (this.value === 'paypal') {
                            stripePayment.classList.add('hidden');
                            paypalPayment.classList.remove('hidden');
                        }
                    });

                    // Trigger initial state
                    paymentMethodSelect.dispatchEvent(new Event('change'));
                }

                // Update shipping cost when shipping method changes
                const shippingMethodSelect = document.getElementById('shipping_method');
                const shippingCostAmount = document.getElementById('shipping-cost-amount');
                const totalAmountElement = document.getElementById('total-amount');
                let subtotal = {{ $total }};

                if (shippingMethodSelect && shippingCostAmount) {
                    shippingMethodSelect.addEventListener('change', function() {
                        const selectedOption = this.options[this.selectedIndex];
                        const shippingRate = parseFloat(selectedOption.dataset.baseRate) || 0;

                        shippingCostAmount.textContent = '$' + shippingRate.toFixed(2);
                        const total = subtotal + shippingRate;
                        totalAmountElement.textContent = '$' + total.toFixed(2);
                    });
                }
            });
        </script>

        @if ($total > 0)
            <script src="https://js.stripe.com/v3/"></script>
            <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>
            <script>
                // Stripe integration
                @if (config('services.stripe.key'))
                    const stripe = Stripe('{{ config('services.stripe.key') }}');
                    const elements = stripe.elements();
                    const card = elements.create('card', {
                        style: {
                            base: {
                                fontSize: '16px',
                                color: '#424770',
                                '::placeholder': {
                                    color: '#aab7c4',
                                },
                            },
                            invalid: {
                                color: '#fa755a',
                            },
                        }
                    });
                    card.mount('#card-element');

                    const form = document.getElementById('checkout-form');
                    const paymentMethodSelect = document.getElementById('payment_method');

                    card.addEventListener('change', function(event) {
                        const displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });

                    form.addEventListener('submit', async (event) => {
                        if (paymentMethodSelect.value === 'stripe') {
                            event.preventDefault();

                            const {
                                token,
                                error
                            } = await stripe.createToken(card);

                            if (error) {
                                const errorElement = document.getElementById('card-errors');
                                errorElement.textContent = error.message;
                            } else {
                                const hiddenInput = document.createElement('input');
                                hiddenInput.setAttribute('type', 'hidden');
                                hiddenInput.setAttribute('name', 'stripeToken');
                                hiddenInput.setAttribute('value', token.id);
                                form.appendChild(hiddenInput);
                                form.submit();
                            }
                        }
                    });
                @endif

                // PayPal integration
                @if (config('services.paypal.client_id'))
                    if (document.getElementById('paypal-button-container')) {
                        paypal.Buttons({
                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: document.getElementById('total-amount').textContent
                                                .replace('$', '')
                                        }
                                    }]
                                });
                            },
                            onApprove: function(data, actions) {
                                return actions.order.capture().then(function(details) {
                                    document.getElementById('paypal_payment_id').value = details.id;
                                    document.getElementById('checkout-form').submit();
                                });
                            }
                        }).render('#paypal-button-container');
                    }
                @endif
            </script>
        @endif
    @endpush
@endsection
