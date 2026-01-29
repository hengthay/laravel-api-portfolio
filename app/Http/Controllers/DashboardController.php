<?php

namespace App\Http\Controllers;

use App\Models\Achievements;
use App\Models\Blogs;
use App\Models\Certificates;
use App\Models\Educations;
use App\Models\Experiences;
use App\Models\Projects;
use App\Models\Skills;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function stats() {
        return $this->handleResponse([
            'projects' => Projects::count(),
            'blogs' => Blogs::count(),
            'skills' => Skills::count(),
            'certificates' => Certificates::count(),
            'educations' => Educations::count(),
            'experiences' => Experiences::count(),
            'achievements' => Achievements::count(),
        ], "Successfully fetched stats", 200);
    }
}
