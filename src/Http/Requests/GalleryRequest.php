<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class GalleryRequest extends FormRequest
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
        $id = $this->gallery->id ?? '';

        return [
            'code' => 'required|max:255|unique:galleries,code,'.$id,
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:galleries,slug,'.$id,
            'excerpt' => 'sometimes|max:1000',
            'description' => 'sometimes|max:4000',
            'image' => 'sometimes|file|image|max:5000',
            'type' => 'required|numeric',
            'url' => 'required_if:type,2',
        ];
    }
}
