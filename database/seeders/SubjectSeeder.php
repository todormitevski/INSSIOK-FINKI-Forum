<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'Algorithms and Data Structures', 'major_id' => 1],
            ['name' => 'Operating Systems', 'major_id' => 2],
            ['name' => 'Database Systems', 'major_id' => 3],
            ['name' => 'Computer Networks', 'major_id' => 4],
            ['name' => 'Web Programming', 'major_id' => 5],
            ['name' => 'Mobile Application Development', 'major_id' => 6],
            ['name' => 'Machine Learning', 'major_id' => 7],
            ['name' => 'Software Testing', 'major_id' => 1],
            ['name' => 'Cybersecurity Fundamentals', 'major_id' => 4],
            ['name' => 'Game Design', 'major_id' => 9],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
