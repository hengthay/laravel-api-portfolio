<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
        $id = $this->route('id'); // route is /blogs/{id}

        return [
            "title" => "required|string|max:255",
            "content" => "nullable|string",
            "slug" => [
                "required",
                "string",
                Rule::unique('blogs', 'slug')->ignore($id),
            ],
            "cover_image" => "nullable|image|max:2048",
            "published" => "boolean",
            "tags" => "required|array",
            "join_date" => "nullable|date"
        ];
    }
}
