<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'email' => 'nullable|email',
            'company' => 'nullable|max:255',
            'designation' => 'nullable|max:100',
            'message' => 'required|max:5500',
            'approved' => 'sometimes|boolean',
            'rating' => 'sometimes|numeric',
        ];
    }
}
