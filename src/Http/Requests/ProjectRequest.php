<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProjectRequest extends FormRequest
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
        $id = $this->project->id ?? '';

        return [
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:projects,slug,'.$id,
            'client' => 'required|max:255',
            'duration' => 'required|max:60',
            'category' => 'required|max:80',
            'image' => 'sometimes|file|image|max:3000',
            'link' => 'nullable|max:255',
            'description' => 'required|max:10000',
            'position' => 'sometimes|numeric',
            'meta_name' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'meta_keywords' => 'nullable',
        ];
    }
}
