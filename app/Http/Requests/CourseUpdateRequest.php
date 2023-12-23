<?php

namespace App\Http\Requests;

use App\Rules\CheckFile;
use App\Rules\CheckUserIsMentor;
use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:courses,name,' . $this->course->id,
            'description' => 'nullable|string',
            'type' => 'required|string|in:free,premium',
            'certificate' => 'required|boolean',
            'level' => 'required|string|in:all-level,beginner,intermediate,advance',
            'status' => 'required|string|in:draft,published',
            'price' => 'required|integer',
            'thumbnail_file_id' => ['required', 'integer', new CheckFile],
            'mentor_user_id' => ['required', 'integer', new CheckUserIsMentor]
        ];
    }
}
