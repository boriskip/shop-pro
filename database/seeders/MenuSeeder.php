<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                'name' => 'Home',
                'url' => '/',
                'order' => 1
            ],
            [
                'name' => 'Books',
                'url' => '/books',
                'order' => 2,
                'children' => [
                    ['name' => 'All Books', 'url' => '/books', 'order' => 1],
                    ['name' => 'Fiction', 'url' => '/books/fiction', 'order' => 2],
                    ['name' => 'Non-Fiction', 'url' => '/books/non-fiction', 'order' => 3],
                    ['name' => 'Science Fiction', 'url' => '/books/science-fiction', 'order' => 4],
                    ['name' => 'Mystery & Thriller', 'url' => '/books/mystery-thriller', 'order' => 5],
                    ['name' => 'Romance', 'url' => '/books/romance', 'order' => 6],
                    ['name' => 'Biography & Memoir', 'url' => '/books/biography-memoir', 'order' => 7],
                    ['name' => 'Children\'s Books', 'url' => '/books/childrens-books', 'order' => 8],
                    ['name' => 'Academic & Textbooks', 'url' => '/books/academic-textbooks', 'order' => 9],
                ]
            ],
            [
                'name' => 'Categories',
                'url' => '/categories',
                'order' => 3,
                'children' => [
                    ['name' => 'Best Sellers', 'url' => '/categories/best-sellers', 'order' => 1],
                    ['name' => 'New Releases', 'url' => '/categories/new-releases', 'order' => 2],
                    ['name' => 'Coming Soon', 'url' => '/categories/coming-soon', 'order' => 3],
                    ['name' => 'Sale Books', 'url' => '/categories/sale', 'order' => 4],
                ]
            ],
            [
                'name' => 'Book Reviews',
                'url' => '/reviews',
                'order' => 4
            ],
            [
                'name' => 'My Account',
                'url' => '/account',
                'order' => 5,
                'children' => [
                    ['name' => 'Profile', 'url' => '/account/profile', 'order' => 1],
                    ['name' => 'Orders', 'url' => '/account/orders', 'order' => 2],
                    ['name' => 'Wishlist', 'url' => '/wishlist', 'order' => 3],
                ]
            ],
            [
                'name' => 'About Us',
                'url' => '/about',
                'order' => 6
            ],
            [
                'name' => 'Contact',
                'url' => '/contact',
                'order' => 7
            ],
            [
                'name' => 'Cart',
                'url' => '/cart',
                'order' => 8
            ],
        ];

        foreach ($menus as $menuData) {
            $this->createMenu($menuData);
        }
    }

    private function createMenu($menuData, $parentId = null)
    {
        $children = $menuData['children'] ?? [];
        unset($menuData['children']);

        $menuData['parent_id'] = $parentId;
        $menu = Menu::create($menuData);

        foreach ($children as $childData) {
            $this->createMenu($childData, $menu->id);
        }
    }
}