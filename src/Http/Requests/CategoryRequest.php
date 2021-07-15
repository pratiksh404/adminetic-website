<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Adminetic\Website\Models\Admin\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryRequest extends FormRequest
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
            'slug' => SlugService::createSlug(Category::class, 'slug', $this->name)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->categpry->id ?? '';
        return [
            'model' => 'required|max:255',
            'code' => 'required|unique:categories,code,' . $id,
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories,slug,' . $id,
            'parent_id' => 'nullable|numeric',
            'active' => 'sometimes|boolean',
            'color' => 'nullable|max:12',
            'icon' => 'nullable|max:20',
            'image' => 'nullable|file|image|max:3000',
            'description' => 'nullable|max:3000'
        ];
    }
}
