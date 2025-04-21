<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Message;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //This means:
        // Create 10 users
        // Each user has 5 posts
        // Each post has 3 comments
        // Each post belongs to 1 unique category

        User::factory(10)
        ->has(
            Post::factory(5)
                ->has(Comment::factory(3))
                ->for(Category::factory())
        )
        ->create();

        // Message::factory(20)->create();

        //Uncomment this to create a new user 
        // User::factory()->create([
        //         'name' => 'Test User',
        //         'email' => 'test@example.com',
        //         'password' => bcrypt('password'),
        //         'remember_token' => null,
        //         'email_verified_at' => now(),
        //         'role' => 'admin',
        // ]);

        // User::factory(10)->create();
    }
}
