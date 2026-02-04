<?php

namespace Database\Seeders;

use App\Models\Experiences;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experiences = [
            [
                "company" => "Smart Axiata Co, Ltd.",
                "position" => "Senior Contact Center",
                "description" => "Handling on serves Customers on social media platform such as Facebook, Instagram, Telegram and Web Chat and providing service to customer with responsibility.",
                "start_date" => Carbon::create(2023, 8, 1),
            ],
            [
                "company" => "Smart Axiata Co, Ltd.",
                "position" => "Contact Center Agent Intern",
                "description" => "Within this position I handling on serve Customer through voice record and provide service to customer based on inquiries.",
                "start_date" => Carbon::create(2023, 1, 1),
                "end_date" => Carbon::create(2023, 8, 1),
            ],
        ];

        foreach($experiences as $key => $value) {
            Experiences::create($value);
        }
    }
}
