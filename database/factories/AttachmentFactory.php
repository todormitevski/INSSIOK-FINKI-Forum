<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    public function definition(): array
    {
        return [
            'file_name' => $this->faker->word . '.jpg',
            'file_path' => $this->faker->imageUrl(),
            'post_id' => Post::factory(),
            'comment_id' => Comment::factory(),
        ];
    }
}
