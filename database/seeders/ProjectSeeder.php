<?php

namespace Database\Seeders;

use App\Models\Projects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                "title" => "Confession Love",
                "description" => "This is a very small project that I built it just for fun, that project will confession a love to someone.",
                "category" => "Frontend",
                "image_url" => "projects/3.png",
                "github_url" => "https://hengthay.github.io/confesstion/",
                "technologies" => [
                    "HTML",
                    "CSS",
                    "JavaScript",
                ],
            ],
            [
                "title" => "My Portfolio Website v1",
                "description" => "This is the first portfolio website that I have spent my time to built it from sratch with only frontend language and this website also responsive on mobile and have animation on the whole page.",
                "category" => "Frontend",
                "image_url" => "projects/v1.png",
                "github_url" => "https://hengthay.github.io/update_portfolio/",
                "technologies" => [
                    "HTML",
                    "CSS",
                    "JavaScript",
                    "Axios"
                ],
            ],
            [
                "title" => "My Portfolio Website v2",
                "description" => "This is the second portfolio website that enchance on my previous v1 portfolio that has been built with modern language such as React JS, Tailwind and Axios animation, morething this website also responsive on mobile.",
                "category" => "Frontend",
                "image_url" => "projects/v2.png",
                "demo_url" => "https://hengthay-portfolio-website.vercel.app/",
                "github_url" => "https://hengthay.github.io/hengthay-portfolio/",
                "technologies" => [
                    "React JS",
                    "Tailwind CSS",
                    "Axios",
                ],
            ],
            [
                "title" => "My Portfolio Website v3",
                "description" => "Developed a scalable full-stack portfolio showcase web application using React.js and Laravel, featuring dynamic content management through RESTful APIs, responsive UI design, and centralized backend-driven data architecture.",
                "category" => "Full-Stack",
                "image_url" => "projects/v3.png",
                "demo_url" => "https://laov-kimhengthay.vercel.app/",
                "technologies" => [
                    "React JS",
                    "Tailwind CSS",
                    "Laravel",
                    "MySQL",
                    "Motion Framer",
                    "Redux Toolkit",
                    "Axios",
                    "Git & Github",
                    "JWT Authentication"
                ],
            ],
            [
                "title" => "Leslas VPN Clone",
                "description" => "This is the clone statis website that I had built to improvement my design skill and responsive design and this also have animation.",
                "category" => "Frontend",
                "image_url" => "projects/1.png",
                "github_url" => "https://hengthay.github.io/leslasvpnclone/",
                "technologies" => [
                    "React JS",
                    "Tailwind CSS",
                ],
            ],
            [
                "title" => "Todo List App",
                "description" => "This is a small Todo list project that built for manages daily task in a day likely a notes that remain you what to do today or tomorrow.",
                "category" => "Frontend",
                "image_url" => "projects/2.png",
                "github_url" => "https://hengthay.github.io/redux-todo-app-and-react/",
                "technologies" => [
                    "React JS",
                    "Tailwind CSS",
                    "Redux Toolkit",
                ],
            ],
            [
                "title" => "Assembly Game",
                "description" => "This is a Guess word game project that allow user to guess the english word and user only have 8 lives to guess, if it reach out the game will be ended.",
                "category" => "Frontend",
                "image_url" => "projects/4.png",
                "github_url" => "https://hengthay.github.io/assembly_game/",
                "technologies" => [
                    "React JS",
                    "Tailwind CSS",
                ],
            ],
            [
                "title" => "Ecommerce Website",
                "description" => "This project is an e-commerce website that allows users to browse products, add them to a cart, and make secure online purchases. It includes user registration, order tracking, and an admin panel to manage products and orders. The website is responsive, user-friendly, and designed to provide a smooth online shopping experience.",
                "category" => "Full-Stack",
                "image_url" => "projects/5.png",
                "technologies" => [
                    "React JS",
                    "Node JS",
                    "Express JS",
                    "Postgres SQL",
                    "Tailwind CSS",
                    "Redux Toolkit",
                    "JWT Authentication",
                    "Git & Github",
                    "RESTful API",
                    "Axios"
                ],
            ],
            [
                "title" => "Job Board Seeker",
                "description" => "I developed a full-stack Job Board Seeker (KhmerJob) web application that connects job seekers with employers through an interactive and user-friendly recruitment platform. The system allows users to search and apply for jobs, while employers can post job listings, manage applications, and track candidates efficiently.",
                "category" => "Full-Stack",
                "image_url" => "projects/5.png",
                "technologies" => [
                    "Laravel",
                    "MySQL",
                    "Redux Toolkit",
                    "RESTful API",
                    "JWT Authentication",
                    "Git & GitHub",
                    "React JS",
                    "Axios",
                    "Tailwind CSS"
                ],
            ],
        ];

        foreach($projects as $key => $value) {
            Projects::create($value);
        }
    }
}
