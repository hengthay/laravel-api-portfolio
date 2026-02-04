<?php

namespace Database\Seeders;

use App\Models\Skills;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            [
                "name" => "JavaScript",
                "category" => "Frontend",
                "level" => 80,
            ],
            [
                "name" => "HTML",
                "category" => "Frontend",
                "level" => 95,
            ],
            [
                "name" => "CSS",
                "category" => "Frontend",
                "level" => 90,
            ],
            [
                "name" => "React JS",
                "category" => "Frontend",
                "level" => 85,
            ],
            [
                "name" => "PHP",
                "category" => "Frontend",
                "level" => 80,
            ],
            [
                "name" => "Laravel",
                "category" => "Frontend",
                "level" => 80,
            ],
            [
                "name" => "Express JS",
                "category" => "Frontend",
                "level" => 75,
            ],
            [
                "name" => "Tailwind CSS",
                "category" => "Frontend",
                "level" => 90,
            ],
            [
                "name" => "MySQL",
                "category" => "Frontend",
                "level" => 80,
            ],
            [
                "name" => "Postgres SQL",
                "category" => "Frontend",
                "level" => 75,
            ],
        ];

        foreach($skills as $key => $value) {
            Skills::create($value);
        }
    }
}
