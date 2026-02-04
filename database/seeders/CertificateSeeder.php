<?php

namespace Database\Seeders;

use App\Models\Certificates;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certificates = [
            [
                "title" => "React JS",
                "issuer" => "Codecademy",
                "image" => "certificates/1.png",
                "issue_date" => Carbon::create(2025, 7, 26),
            ],
            [
                "title" => "React Advanced",
                "issuer" => "Codecademy",
                "image" => "certificates/2.png",
                "issue_date" => Carbon::create(2025, 8, 10),
            ],
            [
                "title" => "Redux",
                "issuer" => "Codecademy",
                "image" => "certificates/3.png",
                "issue_date" => Carbon::create(2025, 8, 23),
            ],
            [
                "title" => "PHP",
                "issuer" => "Codecademy",
                "image" => "certificates/4.png",
                "issue_date" => Carbon::create(2025, 7, 1),
            ],
            [
                "title" => "PHP Intermedia",
                "issuer" => "Codecademy",
                "image" => "certificates/5.png",
                "issue_date" => Carbon::create(2025, 7, 5),
            ],
            [
                "title" => "Full-Stack Engineer",
                "issuer" => "Codecademy",
                "image" => "certificates/6.png",
                "issue_date" => Carbon::create(2025, 12, 7),
            ],
            [
                "title" => "SQL",
                "issuer" => "Codecademy",
                "image" => "certificates/7.png",
                "issue_date" => Carbon::create(2025, 7, 12),
            ],
            [
                "title" => "CSS, Boostrap, JavaScript And PHP",
                "issuer" => "Udemy",
                "image" => "certificates/8.jpg",
                "issue_date" => Carbon::create(2025, 6, 22),
            ],
            [
                "title" => "PHP Dynamic",
                "issuer" => "Udemy",
                "image" => "certificates/9.png",
                "issue_date" => Carbon::create(2025, 7, 15),
            ],
        ];

        foreach($certificates as $key => $value) {
            Certificates::create($value);
        }
    }
}
