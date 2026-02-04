<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            "title" => "required|string|max:255",
            "description" => "nullable|string",
            "category" => "nullable|string",
            "image_url" => "nullable|image|mimes:jpg,jpeg,png,svg|max:2048",
            "demo_url" => "nullable|url",
            "github_url" => "nullable|url",
            "technologies" => "required|array",
        ];
    }
}
