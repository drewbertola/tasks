<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // truncate users and tasks
        DB::table('users')->truncate();
        DB::table('tasks')->truncate();

        // for owner
        DB::table('users')->insert([
            'name' => 'Drew Bertola',
            'email' => 'drewbertola@gmail.com',
            'password' => config('app.owner_password'),
        ]);

        // for a guest
        DB::table('users')->insert([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'password' => Hash::make('secret_123'),
        ]);

        // add some random users
        User::factory()->count(5)->create();

        // add some tasks
        Task::factory()->count(68)->create();

    }
}
