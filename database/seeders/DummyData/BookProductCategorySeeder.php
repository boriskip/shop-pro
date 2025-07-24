<?php

namespace Database\Seeders\DummyData;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            ['name' => 'Fiction', 'description' => 'Imaginative stories and novels.', 'slug' => 'fiction'],
            ['name' => 'Non-Fiction', 'description' => 'Factual books and educational content.', 'slug' => 'non-fiction'],
            ['name' => 'Science Fiction', 'description' => 'Futuristic and speculative fiction.', 'slug' => 'science-fiction'],
            ['name' => 'Mystery & Thriller', 'description' => 'Suspenseful and detective stories.', 'slug' => 'mystery-thriller'],
            ['name' => 'Romance', 'description' => 'Love stories and romantic novels.', 'slug' => 'romance'],
            ['name' => 'Biography & Memoir', 'description' => 'Life stories and personal accounts.', 'slug' => 'biography-memoir'],
            ['name' => 'Children\'s Books', 'description' => 'Books for young readers of all ages.', 'slug' => 'childrens-books'],
            ['name' => 'Academic & Textbooks', 'description' => 'Educational materials and course books.', 'slug' => 'academic-textbooks']
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
} 