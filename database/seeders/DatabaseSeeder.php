<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
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
            'name' => 'Ashutosh',
            'email' => 'ashutosh@example.com',
            'password' => bcrypt('Ashu@123'),
            'email_verified_at' => time()
        ]);


        Project::factory()
        ->count(30)
        ->hasTasks(30)
        ->create();
    }
}
