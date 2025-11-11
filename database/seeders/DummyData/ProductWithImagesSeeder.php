<?php

namespace Database\Seeders\DummyData;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductWithImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories if they don't exist
        $categories = [
            'Electronics' => 'electronics',
            'Clothing' => 'clothing',
            'Books' => 'books',
            'Home & Kitchen' => 'home-kitchen',
            'Sports & Outdoors' => 'sports-outdoors',
            'Health & Beauty' => 'health-beauty',
            'Toys & Games' => 'toys-games',
        ];

        $categoryModels = [];
        foreach ($categories as $name => $slug) {
            $categoryModels[$name] = ProductCategory::firstOrCreate(
                ['name' => $name],
                ['slug' => $slug]
            );
        }

        // Products with images
        $products = [
            // Electronics
            [
                'name' => 'Smartphone Pro Max',
                'category' => 'Electronics',
                'price' => 999.99,
                'short_description' => 'Latest flagship smartphone with advanced camera',
                'long_description' => 'Experience premium photography with our advanced computational photography engine and stunning display.',
                'featured_image' => 'https://picsum.photos/640/480?random=1',
                'images_count' => 3
            ],
            [
                'name' => 'Wireless Headphones',
                'category' => 'Electronics',
                'price' => 199.99,
                'short_description' => 'Premium noise-cancelling headphones',
                'long_description' => 'Enjoy immersive sound with active noise cancellation and 40-hour battery life.',
                'featured_image' => 'https://picsum.photos/640/480?random=2',
                'images_count' => 3
            ],
            [
                'name' => 'Laptop Ultra',
                'category' => 'Electronics',
                'price' => 1299.99,
                'short_description' => 'Powerful thin laptop for professionals',
                'long_description' => 'Work faster with 16GB RAM, 512GB SSD, and professional-grade performance.',
                'featured_image' => 'https://picsum.photos/640/480?random=3',
                'images_count' => 4
            ],

            // Clothing
            [
                'name' => 'Classic Cotton T-Shirt',
                'category' => 'Clothing',
                'price' => 29.99,
                'short_description' => '100% organic cotton comfort',
                'long_description' => 'Available in multiple colors. Soft, breathable, and perfect for everyday wear.',
                'featured_image' => 'https://picsum.photos/640/480?random=4',
                'images_count' => 3
            ],
            [
                'name' => 'Denim Jeans Classic',
                'category' => 'Clothing',
                'price' => 79.99,
                'short_description' => 'Premium fit denim jeans',
                'long_description' => 'Timeless style with superior comfort. Perfect for any occasion.',
                'featured_image' => 'https://picsum.photos/640/480?random=5',
                'images_count' => 3
            ],
            [
                'name' => 'Winter Jacket Pro',
                'category' => 'Clothing',
                'price' => 149.99,
                'short_description' => 'Waterproof winter protection',
                'long_description' => 'Stay warm and dry with our insulated, water-resistant winter jacket.',
                'featured_image' => 'https://picsum.photos/640/480?random=6',
                'images_count' => 4
            ],

            // Books
            [
                'name' => 'The Future of Technology',
                'category' => 'Books',
                'price' => 34.99,
                'short_description' => 'Fascinating insights into tomorrow\'s world',
                'long_description' => 'Explore AI, quantum computing, and blockchain with expert analysis.',
                'featured_image' => 'https://picsum.photos/640/480?random=7',
                'images_count' => 2
            ],
            [
                'name' => 'Modern Cooking Recipes',
                'category' => 'Books',
                'price' => 44.99,
                'short_description' => '100+ international recipes',
                'long_description' => 'Discover world-class recipes with step-by-step instructions and photography.',
                'featured_image' => 'https://picsum.photos/640/480?random=8',
                'images_count' => 3
            ],

            // Home & Kitchen
            [
                'name' => 'Stainless Steel Blender',
                'category' => 'Home & Kitchen',
                'price' => 149.99,
                'short_description' => 'Powerful 2000W blender',
                'long_description' => '10 speed settings, 2L capacity, perfect for smoothies and soups.',
                'featured_image' => 'https://picsum.photos/640/480?random=9',
                'images_count' => 3
            ],
            [
                'name' => 'Non-stick Cookware Set',
                'category' => 'Home & Kitchen',
                'price' => 99.99,
                'short_description' => '8-piece premium cookware set',
                'long_description' => 'PFOA-free, oven safe up to 400°F, includes essential pieces.',
                'featured_image' => 'https://picsum.photos/640/480?random=10',
                'images_count' => 3
            ],

            // Sports & Outdoors
            [
                'name' => 'Premium Yoga Mat',
                'category' => 'Sports & Outdoors',
                'price' => 49.99,
                'short_description' => 'Non-slip eco-friendly mat',
                'long_description' => '6mm thick, TPE material, lightweight and portable for anywhere practice.',
                'featured_image' => 'https://picsum.photos/640/480?random=11',
                'images_count' => 2
            ],
            [
                'name' => 'Professional Tennis Racket',
                'category' => 'Sports & Outdoors',
                'price' => 189.99,
                'short_description' => 'Tournament grade racket',
                'long_description' => 'Advanced string technology, lightweight design for maximum control.',
                'featured_image' => 'https://picsum.photos/640/480?random=12',
                'images_count' => 3
            ],

            // Health & Beauty
            [
                'name' => 'Facial Skincare Set',
                'category' => 'Health & Beauty',
                'price' => 79.99,
                'short_description' => 'Complete 5-step skincare routine',
                'long_description' => 'Cleanser, toner, essence, serum, and moisturizer for glowing skin.',
                'featured_image' => 'https://picsum.photos/640/480?random=13',
                'images_count' => 3
            ],
            [
                'name' => 'Electric Toothbrush Deluxe',
                'category' => 'Health & Beauty',
                'price' => 99.99,
                'short_description' => 'Smart sonic toothbrush',
                'long_description' => 'AI-guided brushing, 14-day battery, 6 cleaning modes.',
                'featured_image' => 'https://picsum.photos/640/480?random=14',
                'images_count' => 3
            ],

            // Toys & Games
            [
                'name' => 'Advanced Building Blocks',
                'category' => 'Toys & Games',
                'price' => 79.99,
                'short_description' => '1000+ pieces construction set',
                'long_description' => 'Educational toy for ages 8+, develops creativity and problem-solving skills.',
                'featured_image' => 'https://picsum.photos/640/480?random=15',
                'images_count' => 3
            ],
        ];

        // Create products with images
        foreach ($products as $productData) {
            $category = $categoryModels[$productData['category']];

            // Create product
            $product = Product::create([
                'name' => $productData['name'],
                'category_id' => $category->id,
                'price' => $productData['price'],
                'short_description' => $productData['short_description'],
                'long_description' => $productData['long_description'],
                'featured_image' => $productData['featured_image'],
                'is_featured' => rand(0, 1),
            ]);

            // Create product images
            for ($i = 1; $i <= $productData['images_count']; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'https://picsum.photos/640/480?random=' . (15 + ($product->id * 10) + $i),
                    'order' => $i,
                ]);
            }

            $this->command->info("Created product: {$product->name} with {$productData['images_count']} images");
        }

        $this->command->info('Product seeding completed successfully!');
    }
}
