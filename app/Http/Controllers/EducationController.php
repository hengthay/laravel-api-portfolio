<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationRequest;
use App\Models\Educations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EducationController extends Controller
{
    public function index() {
        try {
            $educations = Educations::all();
            Log::debug('Get all educations', ['educations' => $educations]);

            if(empty($educations)) {
                return $this->handleErrorResponse(null, 'Education is empty', 404);
            }

            return $this->handleResponse($educations, 'Education is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $educations = Educations::find($id);
            Log::debug('Get individual educations', ['educations' => $educations]);

            if(!$educations) {
                return $this->handleErrorResponse(null, 'Education with id:' . $id . ' is not found', 404);
            }

            return $this->handleResponse($educations, 'Education with id:' . $id . ' successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function create(EducationRequest $request) {
        try {
            $data = $request->validated();

            $educations = Educations::create($data);

            Log::debug('Create new educations', ['educations' => $educations]);

            if(!$educations) {
                return $this->handleErrorResponse(null, 'Failed to create education', 404);
            }

            return $this->handleResponse($educations, 'Education is created successfully!', 201);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function update(EducationRequest $request, $id) {
        try {
            $educations = Educations::find($id);

            if(!$educations) {
                return $this->handleErrorResponse(null, 'Education with id: ' . $id . ' not found', 404);
            }

            $data = $request->validated();

            $educations->update($data);

            Log::debug('update educations', ['educations' => $educations]);

            return $this->handleResponse($educations, 'Education is updated successfully!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function delete($id) {
        try {
            $educations = Educations::find($id);

            if(!$educations) {
                return $this->handleErrorResponse(null, 'Education with id: ' . $id . ' not found', 404);
            }
            
            $educations->delete();

            return $this->handleResponse(null, 'Education is deleted successfully!', 204);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }
}
