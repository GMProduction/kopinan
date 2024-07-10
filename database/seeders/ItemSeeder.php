<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'category_id' => 1,
                'name' => 'Espresso',
                'image' => null,
                'price' => 15000,
                'price_point' => 10
            ],
            [
                'category_id' => 1,
                'name' => 'Cappucino',
                'image' => null,
                'price' => 25000,
                'price_point' => 25
            ],
            [
                'category_id' => 1,
                'name' => 'Americano',
                'image' => null,
                'price' => 22000,
                'price_point' => 20
            ],
            [
                'category_id' => 2,
                'name' => 'Lychee Tea',
                'image' => null,
                'price' => 20000,
                'price_point' => 18
            ],
            [
                'category_id' => 2,
                'name' => 'Chocolate',
                'image' => null,
                'price' => 25000,
                'price_point' => 25
            ],
            [
                'category_id' => 3,
                'name' => 'French Fries',
                'image' => null,
                'price' => 10000,
                'price_point' => 15
            ],
            [
                'category_id' => 3,
                'name' => 'Croissant',
                'image' => null,
                'price' => 12000,
                'price_point' => 16
            ],
        ];

        foreach ($data as $datum) {
            Item::create($datum);
        }
    }
}
