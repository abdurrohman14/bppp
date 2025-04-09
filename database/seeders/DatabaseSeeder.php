<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::insert([
            [
                'name' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'petugaskolam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'manajer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        User::create([
            'name' => 'Iwan Kurniawan',
            'role_id' => 1,
            'email' => 'iwan79546@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
