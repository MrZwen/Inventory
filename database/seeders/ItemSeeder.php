<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Items;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryId = Category::inRandomOrder()->first()->id;
        $userId = User::inRandomOrder()->first()->id;
        $items = [
            [
                'category_id' => $categoryId,
                'users_id' => $userId,
                'name' => 'Item 1',
                'description' => 'Description 1',
                'price' => 10000,
                'stock' => 10,
                'status' => 'available',
                'image' => 'images/image.jpg'
            ],
            [
                'category_id' => $categoryId,
                'users_id' => $userId,
                'name' => 'Item 2',
                'description' => 'Description 2',
                'price' => 20000,
                'stock' => 20,
                'status' => 'available',
                'image' => 'images/image.jpg'
            ]
        ];

        foreach ($items as $item) {
            Items::create($item);
        }
    }
}
