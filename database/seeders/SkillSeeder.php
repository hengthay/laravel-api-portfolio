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
                "category" => "Frontend Development",
                "level" => 80,
            ],
            [
                "name" => "HTML",
                "category" => "Frontend Development",
                "level" => 95,
            ],
            [
                "name" => "CSS",
                "category" => "Frontend Development",
                "level" => 90,
            ],
            [
                "name" => "React JS",
                "category" => "Frontend Development",
                "level" => 85,
            ],
            [
                "name" => "PHP",
                "category" => "Frontend Development",
                "level" => 80,
            ],
            [
                "name" => "Laravel",
                "category" => "Full-Stack Development",
                "level" => 80,
            ],
            [
                "name" => "Express JS",
                "category" => "Backend Development",
                "level" => 75,
            ],
            [
                "name" => "Tailwind CSS",
                "category" => "Frontend Development",
                "level" => 90,
            ],
            [
                "name" => "MySQL",
                "category" => "Database Management",
                "level" => 80,
            ],
            [
                "name" => "Postgres SQL",
                "category" => "Database Management",
                "level" => 75,
            ],
            [
                "name" => "Docker",
                "category" => "DevOps & Tools",
                "level" => 75
            ],
            [
                "name" => "Oracel",
                "category" => "Database Management",
                "level" => 75
            ],
            [
                "name" => "Git & Github",
                "category" => "DevOps & Tools",
                "level" => 80
            ],
        ];

        foreach($skills as $key => $value) {
            Skills::create($value);
        }
    }
}
