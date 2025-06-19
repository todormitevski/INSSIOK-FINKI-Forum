<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        $posts = [
            [
                'title' => 'Best resources for learning Laravel?',
                'content' => 'Can anyone recommend good tutorials or books for mastering Laravel?',
                'user_id' => fake()->randomElement($userIds),
                'subject_id' => 5,
            ],
            [
                'title' => 'Tips for passing Algorithms exam',
                'content' => 'What are the most important topics to focus on for the Algorithms and Data Structures exam?',
                'user_id' => fake()->randomElement($userIds),
                'subject_id' => 1,
            ],
            [
                'title' => 'How to secure a web application?',
                'content' => 'What are the best practices for securing a PHP-based web application?',
                'user_id' => fake()->randomElement($userIds),
                'subject_id' => 9,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
