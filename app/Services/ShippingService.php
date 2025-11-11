<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShippingService
{
    public function getAvailableShippingMethods($cart = null, $address = null)
    {
        // Return default shipping methods (without database)
        return collect([
            (object)[
                'id' => 1,
                'name' => 'Standard Shipping',
                'base_rate' => 9.99,
                'max_weight' => 50,
                'weight_rate' => 0.5,
            ],
            (object)[
                'id' => 2,
                'name' => 'Express Shipping',
                'base_rate' => 19.99,
                'max_weight' => 100,
                'weight_rate' => 0.75,
            ],
            (object)[
                'id' => 3,
                'name' => 'Overnight Shipping',
                'base_rate' => 39.99,
                'max_weight' => 100,
                'weight_rate' => 1.0,
            ],
        ]);
    }

    public function calculateShippingCost($method, $cart, $address = null)
    {
        // Calculate shipping cost based on method and cart weight
        if (is_object($method)) {
            $baseRate = $method->base_rate;
            $weightRate = $method->weight_rate ?? 0.5;
        } else {
            // If method is ID or array, use defaults
            $baseRate = 9.99;
            $weightRate = 0.5;
        }

        $totalWeight = $this->calculateTotalWeight($cart);
        return round($baseRate + ($totalWeight * $weightRate), 2);
    }

    public function verifyAddress($address)
    {
        // Simple address verification - just check if it's not empty
        return !empty($address);
    }

    private function calculateTotalWeight($cart)
    {
        $totalWeight = 0;
        foreach ($cart as $item) {
            $weight = $item['weight'] ?? 1; // Default weight 1kg if not set
            $totalWeight += $weight * $item['quantity'];
        }
        return $totalWeight;
    }

    public function calculateDropShippingCost($method, $cart, $address = null)
    {
        // Add a small premium for drop shipping
        $standardCost = $this->calculateShippingCost($method, $cart, $address);
        $dropShippingPremium = config('shipping.drop_shipping_premium', 2.00);

        return round($standardCost + $dropShippingPremium, 2);
    }
}
