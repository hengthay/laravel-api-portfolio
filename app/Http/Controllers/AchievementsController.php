<?php

namespace App\Http\Controllers;

use App\Http\Requests\AchievementRequest;
use App\Models\Achievements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementsController extends Controller
{
    public function index() {
        try {
            $achievements = Achievements::get();

            return $this->handleResponse($achievements, 'Achievements is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $achievements = Achievements::find($id);

            if(!$achievements) {
                return $this->handleErrorResponse(null, 'Achievements with id:' . $id. ' is not found', 404);
            }

            return $this->handleResponse($achievements, 'Achievements with id:' . $id .' successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function create(AchievementRequest $request) {
        try {
            $imagePath = null;

            if($request->hasFile('icon_url')) {
                $imagePath  = $request->file('icon_url')->store('achievements', 'public');
            }

            $achievements = Achievements::create([
                'title' => $request->title,
                'description' => $request->description,
                'icon_url' => $imagePath
            ]);

            if(!$achievements->exists) {
                return $this->handleErrorResponse(null, 'Failed to create achievements', 404);
            }

            return $this->handleResponse($achievements, 'Achievements is successfully created!', 201);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function update(AchievementRequest $request, $id) {
        try {
            $achievement = Achievements::find($id);

            if(!$achievement) {
                return $this->handleErrorResponse(null, 'Achievement is not found', 404);
            }

            $data = $request->validated();

            // Handle optional image upload
            if ($request->hasFile('icon_url')) {
                // Delete old image if exists
                if ($achievement->icon_url && Storage::disk('public')->exists($achievement->icon_url)) {
                    Storage::disk('public')->delete($achievement->icon_url);
                }

                // Store new image
                $data['icon_url'] = $request->file('icon_url')->store('achievements', 'public');
            }

            $achievement->update($data);

            return $this->handleResponse($achievement, 'Achievements is successfully updated!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function delete($id) {
        try {
            $achievement = Achievements::find($id);

            if(!$achievement) {
                return $this->handleErrorResponse(null, 'Achievement is not found', 404);
            }

            // Delete icon_url also if item removed
            if($achievement->icon_url && Storage::disk('public')->exists($achievement->icon_url)) {
                Storage::disk('public')->delete($achievement->icon_url);
            }
            
            $achievement->delete();

            return $this->handleResponse(null, 'Achievements is successfully deleted!', 204);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }
}
