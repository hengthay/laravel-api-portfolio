<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experiences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExperiencesController extends Controller
{
    public function index() {
        try {
            $experiences = Experiences::all();

            Log::debug('Get all experiences', ['experiences' => $experiences]);

            if(empty($experiences)) {
                return $this->handleErrorResponse(null, 'Experiences is empty', 404);
            }

            return $this->handleResponse($experiences, 'Experiences is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $experiences = Experiences::find($id);
            Log::debug('Get individual id: ', ['experiences' => $experiences]);
            if(!$experiences) {
                return $this->handleErrorResponse(null, 'Experiences with id:' . $id . ' not found', 404);
            }

            return $this->handleResponse($experiences, 'Experiences with id:' . $id . ' is successful received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function create(ExperienceRequest $request) {
        try {
            $data = $request->validated();

            $experiences = Experiences::create($data);

            Log::debug('Create new expericenes: ', ['experiences' => $experiences]);

            if(!$experiences->exists) {
                return $this->handleErrorResponse(null, 'Failed to create new experiences', 404);
            }

            return $this->handleResponse($experiences, 'Experiences created successfully!', 201);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function update(ExperienceRequest $request, $id) {
        try {
            $experiences = Experiences::find($id);

            $data = $request->validated();

            $experiences->update($data);

            Log::debug('Update new expericenes: ', ['experiences' => $experiences]);

            if(!$experiences) {
                return $this->handleErrorResponse(null, 'Failed to update experiences', 404);
            }

            return $this->handleResponse($experiences, 'Experiences updated successfully!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function delete($id) {
        try {
            $experiences = Experiences::find($id);

            if(!$experiences) {
                $this->handleErrorResponse(null, 'Unable to delete experience with id: ' . $id, 404);
            }

            $experiences->delete();

            return $this->handleResponse(null, 'Experiences with id: ' . $id . ' successfully deleted!', 204);

        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }
}
