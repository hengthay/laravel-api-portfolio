<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    public function index() {
        try {
            $projects = Projects::all();

            if($projects->isEmpty()) {
                return $this->handleErrorResponse(null, 'Failed to get all projects', 404);
            }

            return $this->handleResponse($projects, 'All project is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $projects = Projects::find($id);

            if(!$projects) {
                return $this->handleErrorResponse(null, 'Project with id:' . $id . ' not found!', 404);
            }

            return $this->handleResponse($projects, 'Project with id:' .$id . ' is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function create(ProjectRequest $request) {
        try {
            $imageUrl = null;

            if($request->hasFile('image_url')) {
                $imageUrl = $request->file('image_url')->store('projects', 'public');
            }

            $projects = Projects::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => $imageUrl,
                'demo_url' => $request->demo_url,
                'github_url' => $request->github_url,
                'technologies' => $request->technologies
            ]);

            if(!$projects) {
                return $this->handleErrorResponse(null, 'Failed to create project', 404);
            }

            return $this->handleResponse($projects, 'Project is successfully created!', 201);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function update(ProjectRequest $request, $id) {
        try {
            $projects = Projects::find($id);

            if(!$projects) {
                return $this->handleErrorResponse(null, 'Project is not found!', 404);
            }

            $data = $request->validated();
            // Check if file exists image_url
            if($request->hasFile('image_url')) {
                // Remove existings image
                if($projects->image_url && Storage::disk('public')->exists($projects->image_url)) {
                    Storage::disk('public')->delete($projects->image_url);
                }

                // Store new image
                $data['image_url'] = $request->file('image_url')->store('projects', 'public');
            }
            
            $projects->update($data);

            return $this->handleResponse($projects, 'Project is successfully updated!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function delete($id) {
        try {
            $projects = Projects::find($id);
            
            if(!$projects) {
                return $this->handleErrorResponse(null, 'Project is not found', 404);
            };

            if($projects->image_url && Storage::disk('public')->exists($projects->image_url)) {
                Storage::disk('public')->delete($projects->image_url);
            }
            
            $projects->delete();

            return $this->handleResponse(null, 'Project is successfully deleted!', 204);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }
}
