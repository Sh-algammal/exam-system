<?php

namespace App\Http\Requests;

use App\Http\Resources\SectionResource;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'section_id'  => 'required|exists:sections,id',
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:255', // شلنا شرط عدم التكرار (unique) لمنع المشاكل
            'day'         => 'required|string',
            'date'        => 'required|date',
            'doctor'      => 'nullable|string', // خلينا الدكتور اختياري
            'location'    => 'nullable|string', // خلينا المكان اختياري
        ];
    }
}
