<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index() {
        try {
            $profiles = Profile::orderBy('id', 'asc')->get();

            if($profiles->isEmpty()) {
                return $this->handleErrorResponse(null, 'Failed to get all proflies!', 404);
            }

            return $this->handleResponse($profiles, 'All profiles is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $profiles = Profile::find($id);

            if(!$profiles) {
                return $this->handleErrorResponse(null, 'Profile with id:' . $id . ' not found!', 404);
            }

            return $this->handleResponse($profiles, 'Profile with id:'. $id . ' is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function create(ProfileRequest $request) {
        try {
            $imageAvatar = null;
            $imageResume = null;

            if($request->hasFile('avatar_url')) {
                $imageAvatar = $request->file('avatar_url')->store('profiles', 'public');
            }

            if($request->hasFile('resume_url')) {
                $imageResume = $request->file('resume_url')->store('resumes', 'public');
            }

            $profiles = Profile::create([
                'name' => $request->name,
                'email' => $request->email,
                'bio' => $request->bio,
                'avatar_url' => $imageAvatar,
                'resume_url' => $imageResume
            ]);          

            if(!$profiles) {
                return $this->handleErrorResponse(null, 'Failed to create profiles', 404);
            }

            return $this->handleResponse($profiles, 'Profile is successfully created!', 201);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function update(ProfileRequest $request, $id) {
        try {
            $profiles = Profile::find($id);

            if(!$profiles) {
                return $this->handleErrorResponse(null, 'Profiles ID is not found', 404);
            }

            $data = $request->validated();
            
            if($request->hasFile('avatar_url')) {
                if($profiles->avatar_url && Storage::disk('public')->exists($profiles->avatar_url)) {
                    Storage::disk('public')->delete($profiles->avatar_url);
                }

                $data['avatar_url'] = $request->file('avatar_url')->store('profiles', 'public');
            }
            if($request->hasFile('resume_url')) {
                if($profiles->resume_url && Storage::disk('public')->exists($profiles->resume_url)) {
                    Storage::disk('public')->delete($profiles->resume_url);
                }

                $data['resume_url'] = $request->file('resume_url')->store('resumes', 'public');
            }

            $profiles->update($data);

            return $this->handleResponse($profiles, 'Profile is successfully updated!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);
        }
    }

    public function delete($id) {
        try {
            $profiles = Profile::find($id);

            if(!$profiles) {
                return $this->handleResponse(null, 'Profile is not found!', 404);
            }

            $profiles->delete();

            return $this->handleResponse(null, 'Profile is successfully deleted!', 204);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }
    }
}
