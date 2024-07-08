<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $data = [
            [
                'name'     => 'Nama Admin',
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('adminadmin'),
                'role'     => 'admin',
            ],
        ];

        foreach ($data as $value) {
            User::create($value);
        }

        $this->call([
            CategorySeeder::class
        ]);
    }
}
