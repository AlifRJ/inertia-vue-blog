<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'is_admin' => true,
            // 'password' => Hash::make("password"),
        ]);
        User::factory(4)->create();
        PostCategory::factory(6)->create();
        Post::factory(36)->create();
    }
}
