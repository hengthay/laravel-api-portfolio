<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function index() {
        try {
            $blogs = Blogs::where('published', 1)->get();
            if($blogs->isEmpty()) {
                return $this->handleErrorResponse(null, 'Blogs is empty', 404);
            }

            return $this->handleResponse($blogs, 'All blogs is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }
    }

    public function show($id) {
        try {
            $blogs = Blogs::find($id);

            if(!$blogs) {
                return $this->handleErrorResponse(null, 'Blogs with id:' . $id . ' not found!' , 404);
            }

            return $this->handleResponse($blogs, 'blogs with id: '. $id . ' is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }   
    }

    public function create(BlogRequest $request) {
        try {
            $imagePath = null;

            if($request->hasFile('cover_image')){
                $imagePath = $request->file('cover_image')->store('blogs', 'public');
            }

            $blogs = Blogs::create([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => $request->slug,
                'cover_image' => $imagePath,
                'published' => $request->published,
                'tags' => $request->tags
            ]);

            Log::debug('blogs', ['blogs' => $blogs]);
            
            if(!$blogs) {
                return $this->handleErrorResponse(null, 'Failed to create Blogs' , 404);
            }

            return $this->handleResponse($blogs, 'Blogs is successfully created!', 201);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }  
    }

    public function update(BlogRequest $request, $id) {
        try {
            $blogs = Blogs::find($id);

            if(!$blogs) {
                return $this->handleErrorResponse(null, 'Blog with id:' . $id . ' not found!' , 404);
            }   

            $data = $request->validated();

            if($request->hasFile('cover_image')) {
                if($blogs->cover_image && Storage::disk('public')->exists($blogs->cover_image)) {
                    Storage::disk('public')->delete($blogs->cover_image);
                }

                $data['cover_image'] = $request->file('cover_image')->store('blogs', 'public');
            }

            $blogs->update($data);

            return $this->handleResponse($blogs, 'Blogs is successfully updated!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }  
    }

    public function delete($id) {
         try {
            $blogs = Blogs::find($id);

            if(!$blogs) {
                return $this->handleErrorResponse(null, 'Blog with id:' . $id . ' not found!' , 404);
            }   

            if($blogs->cover_image && Storage::disk('public')->exists($blogs->cover_image)) {
                Storage::disk('public')->delete($blogs->cover_image);
            }

            $blogs->delete();

            return $this->handleResponse(null, 'Blogs is successfully deleted!', 204);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }   
    }
}
