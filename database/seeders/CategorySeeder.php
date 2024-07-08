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
        //
        $data = ['Coffee Based', 'Non Coffee', 'Snack'];

        foreach ($data as $datum) {
            Category::create([
                'name' => $datum
            ]);
        }
    }
}
