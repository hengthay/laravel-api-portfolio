<?php

namespace Database\Seeders;

use App\Models\Educations;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educations = [
            [
                "institution" => "Royal University of Law and Economic",
                "degree" => "Bachelor Degree",
                "field" => "Information Technology",
                "status" => "Studying",
                "start_date" => Carbon::create(2023, 1, 1)
            ],
            [
                "institution" => "Boueng Trobek High School",
                "degree" => "Diploma",
                "status" => "Graduated",
                "start_date" => Carbon::create(2022, 1, 1),
                "end_date" => Carbon::create(2016, 1, 1)
            ],
            [
                "institution" => "Hun Neang Beong Trabek Khan Kert",
                "degree" => "Associate",
                "status" => "Graduated",
                "start_date" => Carbon::create(2010, 1, 1),
                "end_date" => Carbon::create(2016, 1, 1)
            ],
        ];

        foreach($educations as $key => $value) {
            Educations::create($value);
        }
    }
}
