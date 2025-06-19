<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    public function run(): void
    {

        $majors = [
            'Софтверско инженерство и информациски системи (4 годишни)',
            'Software engineering and information systems (4 years)',
            'Интернет, мрежи и безбедност (4 годишни)',
            'Примена на информациски технологии (4 годишни)',
            'Информатичка едукација (4 годишни)',
            'Компјутерско инженерство (4 годишни)',
            'Компјутерски науки (4 годишни)',
            'Софтверско инженерство и информациски системи (3 годишни)',
            'Software engineering and information systems (3 years)',
            'Интернет, мрежи и безбедност (3 годишни)',
            'Примена на информациски технологии (3 годишни)',
        ];

        foreach ($majors as $major) {
            Major::create(['name' => $major]);
        }
    }
}
