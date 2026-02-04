<?php

namespace Database\Seeders;

use App\Models\Blogs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                "title" => "Learn React JS",
                "content" => "In this online course on Codecademy, I learned the fundamentals of React JS and how it works. The course includes real projects and hands-on practice assessments, providing practical experience.",
                "slug" => "learn-react-js",
                "cover_image" => "blogs/blog_cover.png",
                "tags" => [
                    "React JS"
                ],
            ],
            [
                "title" => "React Advanced",
                "content" => "In this online course on Codecademy, I learned advanced concepts of React JS. The course includes real projects and hands-on practice assessments, providing practical experience.",
                "slug" => "react-advanced",
                "cover_image" => "blogs/blog_cover.png",
                "tags" => [
                    "React JS",
                    "React Advanced"
                ],
            ],
            [
                "title" => "Learn Redux",
                "content" => "In this online course on Codecademy, I learned the concepts of Redux and Redux Toolkit and how they work. The course includes real projects and hands-on practice assessments, providing practical experience.",
                "slug" => "learn-redux",
                "cover_image" => "blogs/blog_cover.png",
                "tags" => [
                    "Redux",
                    "Redux Toolkit"
                ],
            ],
            [
                "title" => "Learn PHP",
                "content" => "In this online course on Codecademy, I learned the fundamentals of PHP and how it works. The course includes real projects and hands-on practice assessments, providing practical experience.",
                "slug" => "learn-php",
                "cover_image" => "blogs/blog_cover.png",
                "tags" => [
                    "PHP"
                ],
            ],
            [
                "title" => "Learn PHP Intermediate",
                "content" => "In this online course on Codecademy, I learned intermediate PHP concepts and how they work. The course includes real projects and hands-on practice assessments, providing practical experience.",
                "slug" => "learn-php-intermediate",
                "cover_image" => "blogs/blog_cover.png",
                "tags" => [
                    "PHP",
                    "PHP Intermediate"
                ],
            ],
            [
                "title" => "Learn Full-Stack Engineering",
                "content" => "In this online course on Codecademy, I learned the full-stack development process from start to finish. The course covers multiple technologies, including HTML, CSS, JavaScript, React, SQL, PostgreSQL, Node.js, Express.js, and testing with Jest. It also teaches project structuring, database design, workflow, and best practices. The course includes real projects and hands-on assessments, providing practical experience.",
                "slug" => "learn-full-stack-engineering",
                "cover_image" => "blogs/blog_cover.png",
                "tags" => [
                    "HTML",
                    "CSS",
                    "JavaScript",
                    "React",
                    "SQL",
                    "PostgreSQL",
                    "Node JS",
                    "Express JS",
                    "Jest"
                ],
            ],
            [
                "title" => "Learn SQL",
                "content" => "In this online course on Codecademy, I learned SQL query language and how it works with tables and databases. The course includes real projects and hands-on practice assessments, providing practical experience.",
                "slug" => "learn-sql",
                "cover_image" => "blogs/blog_cover.png",
                "tags" => [
                    "SQL",
                    "SQLite"
                ],
            ],
            [
                "title" => "Learn CSS, Bootstrap, JavaScript, and PHP",
                "content" => "In this online course on Codecademy, I learned the basics of CSS, Bootstrap, JavaScript, and PHP. The course is delivered via video tutorials, providing practical guidance and examples.",
                "slug" => "learn-css-bootstrap-javascript-php",
                "cover_image" => "blogs/blog_cover.png",
                "tags" => [
                    "CSS",
                    "Bootstrap",
                    "JavaScript",
                    "PHP"
                ],
            ],
            [
                "title" => "Learn PHP Dynamic",
                "content" => "In this online course on Codecademy, I learned dynamic PHP programming, including working with databases, forms, and server-side logic. The course is delivered via video tutorials and includes practical exercises.",
                "slug" => "learn-php-dynamic",
                "cover_image" => "blogs/blog_cover.png",
                "tags" => [
                    "PHP Dynamic"
                ],
            ],
        ];

        foreach ($blogs as $key => $value) {
            Blogs::create($value);
        }
    }
}
