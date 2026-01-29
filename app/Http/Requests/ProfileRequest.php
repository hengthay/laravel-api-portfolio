<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {   
        
        return [
            "name" => "required|string|max:255",
            "email" =>  "nullable|string",
            'introduce' => 'nullable|string',
            "bio" => "nullable|string",
            "hobbies" => "nullable|array",
            "avatar_url" => "sometimes|nullable|image|mimes:jpg,jpeg,png,svg|max:2048",
            "resume_url" => "sometimes|nullable|file|mimes:pdf,doc,docx|max:5120"
        ];
    }
}
