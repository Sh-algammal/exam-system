<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
return [
        'section_id'  => 'sometimes|exists:sections,id',
        'course_name' => 'sometimes|string|max:255',
        'course_code' => 'sometimes|string|unique:courses,course_code,' . $this->course->id,
        'day'         => 'sometimes|string',
        'date'        => 'sometimes|date',
        'doctor'      => 'sometimes|string',
        'location'    => 'sometimes|string',
    ];
    }
}
