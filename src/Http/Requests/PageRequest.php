<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PageRequest extends FormRequest
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
        $id = $this->page->id ?? '';

        return [
            'slug' => 'required|max:255|unique:pages,slug,'.$id,
            'code' => 'required|max:255|unique:pages,slug,'.$id,
            'name' => 'required|max:255',
            'meta_name' => 'nullable|max:255',
            'body' => 'nullable|max:65535',
            'image' => 'sometimes|file|image|max:3000',
            'meta_description' => 'nullable|max:160',
            'meta_keywords' => 'nullable',
            'active' => 'required|boolean',
            'video' => 'sometimes|max:255',
            'type' => 'required|numeric',
        ];
    }
}
