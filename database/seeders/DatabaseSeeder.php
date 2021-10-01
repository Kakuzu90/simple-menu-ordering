<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\MenuCategory::create(['name' => 'Burgers']);
        \App\Models\MenuCategory::create(['name' => 'Beverages']);
        \App\Models\MenuCategory::create(['name' => 'Combo Meals']);

        \App\Models\MenuList::create([
            'name' => 'Hotdog',
            'tax' => 5.2,
            'price' => 19.50,
            'image_path' => 'hotdog.png',
            'category_id' => 1
        ]);
        \App\Models\MenuList::create([
            'name' => 'CheeseBurger',
            'tax' => 5.2,
            'price' => 35.25,
            'image_path' => 'cheeseburger.png',
            'category_id' => 1
        ]);
        \App\Models\MenuList::create([
            'name' => 'Fries',
            'tax' => 5.2,
            'price' => 20,
            'image_path' => 'fries.png',
            'category_id' => 1
        ]);

        \App\Models\MenuList::create([
            'name' => 'Coke',
            'tax' => 2.50,
            'price' => 15,
            'image_path' => 'coke.png',
            'category_id' => 2
        ]);
        \App\Models\MenuList::create([
            'name' => 'Sprite',
            'tax' => 2.50,
            'price' => 15,
            'image_path' => 'sprite.png',
            'category_id' => 2
        ]);
        \App\Models\MenuList::create([
            'name' => 'Tea',
            'tax' => 2.50,
            'price' => 25,
            'image_path' => 'tea.jpg',
            'category_id' => 2
        ]);

        \App\Models\MenuList::create([
            'name' => 'Chicken Combo Meal',
            'tax' => 17.50,
            'price' => 150,
            'image_path' => 'chicken-combo-meal.png',
            'category_id' => 3
        ]);
        \App\Models\MenuList::create([
            'name' => 'Pork Combo',
            'tax' => 17.50,
            'price' => 215.10,
            'image_path' => 'pork-combo-meal.png',
            'category_id' => 3
        ]);
        \App\Models\MenuList::create([
            'name' => 'Fish Combo',
            'tax' => 17.50,
            'price' => 125.95,
            'image_path' => 'fish-combo-meal.png',
            'category_id' => 3
        ]);
    }
}
