<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'code' => $this->testimonial->code ?? rand(100000, 9999999),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->testimonial->id ?? '';

        return [
            'code' => 'required|unique:testimonials,code,'.$id,
            'name' => 'required|max:255',
            'email' => 'required|unique:testimonials,email,'.$id,
            'image' => 'nullable|file|image|max:3000',
            'contact' => 'nullable|numeric',
            'designation' => 'nullable|max:60',
            'company' => 'nullable|max:60',
            'body' => 'required|max:3000',
            'rating' => 'nullable|numeric|max:5',
            'position' => 'sometimes|numeric',
            'approve' => 'sometimes|boolean',
        ];
    }
}
