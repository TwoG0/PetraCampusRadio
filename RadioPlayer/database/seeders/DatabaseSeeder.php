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

        User::factory()->create([
            'username' => 'c14210208',
            'role' => 'Master',
            'email' => 'c14210208@john.petra.ac.id',
        ]);
        User::factory()->create([
            'username' => 'c241',
            'role' => 'Master',
            'email' => 'c241@john.petra.ac.id',
        ]);
    }
}
