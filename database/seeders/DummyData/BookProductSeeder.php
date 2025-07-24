<?php

namespace Database\Seeders\DummyData;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products = [
            // Products for Fiction
            ['name' => 'The Great Gatsby', 'category_slug' => 'fiction', 'price' => 12.99, 'short_description' => 'F. Scott Fitzgerald\'s classic novel about the American Dream.'],
            ['name' => 'To Kill a Mockingbird', 'category_slug' => 'fiction', 'price' => 14.99, 'short_description' => 'Harper Lee\'s Pulitzer Prize-winning novel about justice and racism.'],
            ['name' => '1984', 'category_slug' => 'fiction', 'price' => 11.99, 'short_description' => 'George Orwell\'s dystopian masterpiece about totalitarianism.'],
            ['name' => 'Pride and Prejudice', 'category_slug' => 'fiction', 'price' => 9.99, 'short_description' => 'Jane Austen\'s beloved romance novel.'],
            ['name' => 'The Catcher in the Rye', 'category_slug' => 'fiction', 'price' => 13.99, 'short_description' => 'J.D. Salinger\'s coming-of-age story.'],

            // Products for Non-Fiction
            ['name' => 'Sapiens: A Brief History of Humankind', 'category_slug' => 'non-fiction', 'price' => 24.99, 'short_description' => 'Yuval Noah Harari\'s exploration of human history.'],
            ['name' => 'The Power of Habit', 'category_slug' => 'non-fiction', 'price' => 16.99, 'short_description' => 'Charles Duhigg\'s guide to understanding and changing habits.'],
            ['name' => 'Atomic Habits', 'category_slug' => 'non-fiction', 'price' => 18.99, 'short_description' => 'James Clear\'s practical guide to building good habits.'],
            ['name' => 'Thinking, Fast and Slow', 'category_slug' => 'non-fiction', 'price' => 22.99, 'short_description' => 'Daniel Kahneman\'s exploration of human decision-making.'],
            ['name' => 'The Subtle Art of Not Giving a F*ck', 'category_slug' => 'non-fiction', 'price' => 15.99, 'short_description' => 'Mark Manson\'s counterintuitive approach to living a good life.'],

            // Products for Science Fiction
            ['name' => 'Dune', 'category_slug' => 'science-fiction', 'price' => 19.99, 'short_description' => 'Frank Herbert\'s epic science fiction masterpiece.'],
            ['name' => 'The Hitchhiker\'s Guide to the Galaxy', 'category_slug' => 'science-fiction', 'price' => 12.99, 'short_description' => 'Douglas Adams\' humorous space adventure.'],
            ['name' => 'Neuromancer', 'category_slug' => 'science-fiction', 'price' => 14.99, 'short_description' => 'William Gibson\'s cyberpunk classic.'],
            ['name' => 'The Martian', 'category_slug' => 'science-fiction', 'price' => 16.99, 'short_description' => 'Andy Weir\'s survival story on Mars.'],
            ['name' => 'Ready Player One', 'category_slug' => 'science-fiction', 'price' => 13.99, 'short_description' => 'Ernest Cline\'s virtual reality adventure.'],

            // Products for Mystery & Thriller
            ['name' => 'The Girl with the Dragon Tattoo', 'category_slug' => 'mystery-thriller', 'price' => 15.99, 'short_description' => 'Stieg Larsson\'s gripping crime thriller.'],
            ['name' => 'Gone Girl', 'category_slug' => 'mystery-thriller', 'price' => 14.99, 'short_description' => 'Gillian Flynn\'s psychological thriller.'],
            ['name' => 'The Silent Patient', 'category_slug' => 'mystery-thriller', 'price' => 16.99, 'short_description' => 'Alex Michaelides\' psychological mystery.'],
            ['name' => 'Big Little Lies', 'category_slug' => 'mystery-thriller', 'price' => 13.99, 'short_description' => 'Liane Moriarty\'s suburban thriller.'],
            ['name' => 'The Woman in the Window', 'category_slug' => 'mystery-thriller', 'price' => 15.99, 'short_description' => 'A.J. Finn\'s Hitchcockian thriller.'],

            // Products for Romance
            ['name' => 'The Notebook', 'category_slug' => 'romance', 'price' => 11.99, 'short_description' => 'Nicholas Sparks\' beloved love story.'],
            ['name' => 'Outlander', 'category_slug' => 'romance', 'price' => 17.99, 'short_description' => 'Diana Gabaldon\'s time-traveling romance.'],
            ['name' => 'The Hating Game', 'category_slug' => 'romance', 'price' => 12.99, 'short_description' => 'Sally Thorne\'s enemies-to-lovers romance.'],
            ['name' => 'Beach Read', 'category_slug' => 'romance', 'price' => 13.99, 'short_description' => 'Emily Henry\'s contemporary romance.'],
            ['name' => 'The Love Hypothesis', 'category_slug' => 'romance', 'price' => 14.99, 'short_description' => 'Ali Hazelwood\'s STEM romance novel.'],

            // Products for Biography & Memoir
            ['name' => 'Becoming', 'category_slug' => 'biography-memoir', 'price' => 24.99, 'short_description' => 'Michelle Obama\'s inspiring memoir.'],
            ['name' => 'Steve Jobs', 'category_slug' => 'biography-memoir', 'price' => 21.99, 'short_description' => 'Walter Isaacson\'s biography of the Apple co-founder.'],
            ['name' => 'Educated', 'category_slug' => 'biography-memoir', 'price' => 18.99, 'short_description' => 'Tara Westover\'s memoir about self-education.'],
            ['name' => 'The Glass Castle', 'category_slug' => 'biography-memoir', 'price' => 16.99, 'short_description' => 'Jeannette Walls\' memoir of resilience.'],
            ['name' => 'Born a Crime', 'category_slug' => 'biography-memoir', 'price' => 17.99, 'short_description' => 'Trevor Noah\'s memoir about growing up in South Africa.'],

            // Products for Children's Books
            ['name' => 'The Very Hungry Caterpillar', 'category_slug' => 'childrens-books', 'price' => 8.99, 'short_description' => 'Eric Carle\'s classic children\'s book.'],
            ['name' => 'Where the Wild Things Are', 'category_slug' => 'childrens-books', 'price' => 9.99, 'short_description' => 'Maurice Sendak\'s beloved picture book.'],
            ['name' => 'Goodnight Moon', 'category_slug' => 'childrens-books', 'price' => 7.99, 'short_description' => 'Margaret Wise Brown\'s bedtime classic.'],
            ['name' => 'The Gruffalo', 'category_slug' => 'childrens-books', 'price' => 10.99, 'short_description' => 'Julia Donaldson\'s rhyming children\'s story.'],
            ['name' => 'Harry Potter and the Sorcerer\'s Stone', 'category_slug' => 'childrens-books', 'price' => 19.99, 'short_description' => 'J.K. Rowling\'s magical first book in the series.'],

            // Products for Academic & Textbooks
            ['name' => 'Calculus: Early Transcendentals', 'category_slug' => 'academic-textbooks', 'price' => 89.99, 'short_description' => 'James Stewart\'s comprehensive calculus textbook.'],
            ['name' => 'Organic Chemistry', 'category_slug' => 'academic-textbooks', 'price' => 129.99, 'short_description' => 'David Klein\'s organic chemistry textbook.'],
            ['name' => 'Introduction to Psychology', 'category_slug' => 'academic-textbooks', 'price' => 79.99, 'short_description' => 'Hilgard\'s comprehensive psychology textbook.'],
            ['name' => 'Microeconomics: Principles and Policy', 'category_slug' => 'academic-textbooks', 'price' => 94.99, 'short_description' => 'William Baumol\'s economics textbook.'],
            ['name' => 'Campbell Biology', 'category_slug' => 'academic-textbooks', 'price' => 149.99, 'short_description' => 'Lisa Urry\'s comprehensive biology textbook.'],

        ];

        foreach ($products as $product) {
            $category = ProductCategory::where('slug', $product['category_slug'])->first();

            Product::factory()->create([
                'name' => $product['name'],
                'category_id' => $category->id,
                'price' => $product['price'],
                'short_description' => $product['short_description']
            ]);
        }
    }
} 