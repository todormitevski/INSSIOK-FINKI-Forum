<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        $comments = [
            [
                'content' => 'Check out the official Laravel documentation, it\'s very helpful!',
                'user_id' => fake()->randomElement($userIds),
                'post_id' => 1,
            ],
            [
                'content' => 'Focus on sorting algorithms and dynamic programming.',
                'user_id' => fake()->randomElement($userIds),
                'post_id' => 2,
            ],
            [
                'content' => 'Always validate user input and use prepared statements.',
                'user_id' => fake()->randomElement($userIds),
                'post_id' => 3,
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
