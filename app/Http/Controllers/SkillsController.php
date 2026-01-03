<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\Skills;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index() {
        try {
            $getAllSkills = Skills::all();

            return $this->handleResponse($getAllSkills, "Skill is successfully received!");
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $skill = Skills::findOrFail($id);

            if(!$skill) {
                return $this->handleErrorResponse(null, 'Skill is not found', 404);
            }

            return $this->handleResponse($skill, 'Skill with id: ' . $id . ' received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function create(SkillRequest $request) {
        try {
            $data = $request->validated();
            
            $skill = Skills::create($data);

            if(!$skill) {
                return $this->handleErrorResponse(null, 'Failed to create skill', 404);
            }

            return $this->handleResponse($skill, 'Skill is successfully created!', 201);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function update(SkillRequest $request, $id) {
        try {
            $skill = Skills::findOrFail($id);
            
            $data = $request->validated();

            $skill->update($data);
            
            if(!$skill) {
                return $this->handleErrorResponse(null, 'Failed to update skill', 404);
            }

            return $this->handleResponse($skill, 'Skill is successfully updated!', 201);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function delete($id) {
        try {
            $skill = Skills::findOrFail($id);
            
            if(!$skill) {
                return $this->handleErrorResponse(null, 'Skill is not found for deleted', 404);
            }

            $skill->delete();

            return $this->handleResponse(null, 'Skill is successfully deleted!', 204);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }
}
