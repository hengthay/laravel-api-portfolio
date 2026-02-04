<?php

namespace Database\Seeders;

use App\Models\Blogs;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'laovkimhengthai@gmail.com',
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'role' => "admin",
            "permission" => "all",
        ]);

        $this->call([
            BlogSeeder::class,
            CertificateSeeder::class,
            EducationSeeder::class,
            ExperienceSeeder::class,
            ProfileSeeder::class,
            ProjectSeeder::class,
            SkillSeeder::class,
        ]);
    }
}
