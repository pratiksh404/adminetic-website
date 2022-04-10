<?php

namespace Adminetic\Website\Http\Requests;

use Adminetic\Website\Models\Admin\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'code' => $this->category->code ?? rand(100000, 999999),
            'slug' => Str::slug($this->name),
            'main_category_id' => $this->getMainCategory($this->category->parent_id ?? null),
            'model' => $this->model ?? $this->category->model ?? 'All',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->category->id ?? '';

        return [
            'model' => 'required|max:255',
            'code' => 'required|unique:categories,code,'.$id,
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories,slug,'.$id,
            'parent_id' => 'nullable|numeric',
            'main_category_id' => 'nullable|numeric',
            'active' => 'sometimes|boolean',
            'color' => 'nullable|max:12',
            'icon' => 'nullable|max:20',
            'image' => 'nullable|file|image|max:3000',
            'description' => 'nullable|max:3000',
            'meta_name' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'meta_name' => 'nullable',
        ];
    }

    // Get Main Category
    public function getMainCategory($given_category_id = null)
    {
        $parent_id = $given_category_id ?? $this->parent_id ?? null;
        $category = Category::find($parent_id);
        if (isset($category)) {
            while (true) {
                if (isset($category->parent_id)) {
                    $category = Category::find($category->parent_id);
                } else {
                    break;
                }
            }

            return $category->id;
        }

        return null;
    }
}
