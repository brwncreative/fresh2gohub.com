<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Prices;
use App\Models\Options;
use App\Models\Product;
use App\Models\Tags;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123'
        ]);
        User::factory()->create([
            'role' => 'admin',
            'name' => 'Root',
            'email' => 'root@example.com',
            'password' => '123'
        ]);
        User::factory()->create([
            'role' => 'admin',
            'name' => 'Tajah',
            'email' => 'tajah.lawrence@fresh2gohub.com',
            'password' => 'Bigmoney$2024'
        ]);
        Product::factory(3)->create();
        Options::factory(3)->create();
        Prices::factory(3)->create();
        Tags::factory(3)->create(['tag' => 'popular']);
    }
}
