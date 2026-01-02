<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index() {
        try {
            $getAllSkills = Skills::all();

            return $this->handleResponse($getAllSkills, "Skill is successfully received!");
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 404);
        }
    }

    public function show($id) {

    }

    public function create(Request $request) {

    }

    public function update(Request $request, $id) {

    }

    public function delete($id) {
        
    }
}
