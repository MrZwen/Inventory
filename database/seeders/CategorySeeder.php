<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Makanan'],
            ['name' => 'Minuman'],
            ['name' => 'Elektronik'],
            ['name' => 'Pakaian'],
            ['name' => 'Kesehatan'],
            ['name' => 'Hobi'],
            ['name' => 'Olahraga'],
            ['name' => 'Lainnya'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
