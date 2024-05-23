<?php

namespace Database\Seeders;

use App\Models\User;

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

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('pass1234'),
        ]);

        $this->call([
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            // DepartmentSeeder::class,
        ]);
    }
}
