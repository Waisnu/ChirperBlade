<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // create a seeder for user admin and editor

        User::create([
            'name' => 'Admin',
            'email' => 'admin@chirper.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
]);
        User::create([
            'name' => 'Editor',
            'email' => 'editor@chirper.com',
            'password' => bcrypt('editor'),
            'role' => 'editor',
]);
        User::create([
            'name' => 'User',
            'email' => 'user@chirper.com',
            'password' => bcrypt('user'),
            'role' => 'user',
]);


    }
}
