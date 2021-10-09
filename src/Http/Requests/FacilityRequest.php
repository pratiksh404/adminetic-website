<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class FacilityRequest extends FormRequest
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
            'slug' => Str::slug($this->name),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->facility->id ?? '';

        return [
            'code' => 'required|max:255|unique:facilities,code,'.$id,
            'name' => 'required|max:60',
            'slug' => 'required|max:255|unique:facilities,slug,'.$id,
            'excerpt' => 'required|max:255',
            'description' => 'nullable|max:10000',
            'category_id' => 'nullable|numeric',
            'icon' => 'nullable|max:255',
            'icon_image' => 'sometimes|file|image|mimes:png|max:1000',
            'image' => 'sometimes|file|image|max:5000',
            'active' => 'sometimes|boolean',
            'meta_name' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'meta_keywords' => 'nullable',
        ];
    }
}
