<?php

namespace Database\Seeders\DummyData;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Gadgets, devices, and home appliances.',
                'image' => 'https://images.unsplash.com/photo-1510557880182-3a5352b18b59?w=1200&h=600&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'Men's, women's, and kids' fashion.',
                'image' => 'https://images.unsplash.com/photo-1520975914100-8b1d1f9f444f?w=1200&h=600&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
                'description' => 'Fiction, non-fiction, and educational books.',
                'image' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?w=1200&h=600&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Home & Kitchen',
                'slug' => 'home',
                'description' => 'Furniture, kitchen appliances, and decor.',
                'image' => 'https://images.unsplash.com/photo-1505691723518-36a62f3b6f1f?w=1200&h=600&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Sports & Outdoors',
                'slug' => 'sports',
                'description' => 'Sporting goods and outdoor equipment.',
                'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1200&h=600&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Health & Beauty',
                'slug' => 'beauty',
                'description' => 'Skincare, fitness equipment, and more.',
                'image' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=1200&h=600&auto=format&fit=crop&q=80',
            ],
            [
                'name' => 'Toys & Games',
                'slug' => 'toys',
                'description' => 'Kids toys, video games, and board games.',
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&h=600&auto=format&fit=crop&q=80',
            ],
        ];

        foreach ($categories as $categoryData) {
            ProductCategory::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }
    }
}
