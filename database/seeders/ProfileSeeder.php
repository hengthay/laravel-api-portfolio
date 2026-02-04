<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profile = [
            'name' => "Heng Thay",
            "email" => "laovkimhengthai@gmail.com",
            "introduce" => "Full-Stack web developer, Software developer.",
            "bio" => "I'm a Full-stack developer who willing to handle all the project flow from the beggining to the end. I love coding and listening to music. Building something interesting and useful is my passion.",
            "hobbies" => [
                "I love coding. I learned programming when I in college. I wrote my first program in portfolio when I was 19.",
                "I have a lot of hobbies, such as travelling, photography, watching movies, music and so on.",
                "I'm working as a software devloper and full-stack developer, Phnom Penh now. And I'm building a lot of side projects in my spare time."
            ],
            "avatar_url" => "profiles/profile.png",
            "resume_url" => "resumes/LAOV Kimhengthay.pdf",
        ];

        Profile::create($profile);
    }
}
