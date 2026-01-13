<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificateRequest;
use App\Models\Certificates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index() {
        try {
            $certificates = Certificates::get();

            if($certificates->isEmpty()) {
                return $this->handleErrorResponse(null, 'Certificates is empty', 404);
            }

            return $this->handleResponse($certificates, 'All certificates is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }
    }

    public function show($id) {
        try {
            $certificates = Certificates::find($id);

            if(!$certificates) {
                return $this->handleErrorResponse(null, 'Certificate with id:' . $id . ' not found!' , 404);
            }

            return $this->handleResponse($certificates, 'Certificate with id: '. $id . ' is successfully received!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }   
    }

    public function create(CertificateRequest $request) {
        try {
            $imagePath = null;
            if($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('certificates', 'public');
            }

            $certificates = Certificates::create([
                'title' => $request->title,
                'issuer' => $request->issuer,
                'image' => $imagePath,
                'issue_date' => $request->issue_date,
            ]);

            if(!$certificates) {
                return $this->handleErrorResponse(null, 'Failed to create Certificates' , 404);
            }

            return $this->handleResponse($certificates, 'Certificate is successfully created!', 201);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }  
    }

    public function update(CertificateRequest $request, $id) {
        try {
            $certificates = Certificates::find($id);

            if(!$certificates) {
                return $this->handleErrorResponse(null, 'Certificate with id: ' . $id . ' not found!', 404);
            }

            $data = $request->validated();

            if($request->hasFile('image')) {
                if($certificates->image && Storage::disk('public')->path($certificates->image)) {
                    Storage::disk('public')->delete($certificates->image);
                }

                $data['image'] = $request->file('image')->store('certificates', 'public');
            }

            $certificates->update($data);

            return $this->handleResponse($certificates, 'Certificate is successfully updated!', 200);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }  
    }

    public function delete($id) {
         try {
            $certificates = Certificates::find($id);

            if(!$certificates) {
                return $this->handleErrorResponse(null, 'Certificate is not found!', 404);
            }

            $certificates->delete();

            return $this->handleResponse(null, 'Certificate is successfully deleted!', 204);
        } catch (\Throwable $e) {
            return $this->handleErrorResponse(null, $e->getMessage(), 500);   
        }   
    }
}
