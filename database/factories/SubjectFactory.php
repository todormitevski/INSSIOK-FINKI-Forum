<?php

namespace Database\Factories;

use App\Models\Major;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'major_id' => Major::factory(),
        ];
    }
}
