<?php

namespace Adminetic\Website\Http\Requests;

use Adminetic\Website\Models\Admin\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'root_parent_id' => $this->getMainCategory($this->category->parent_id ?? null),
            'slug' => ! is_null($this->name) ? Str::slug($this->name) : null,
            'meta_name' => $this->category->meta_name ?? $this->meta_name ?? $this->name ?? null,
            'meta_description' => $this->category->meta_description ?? $this->meta_description ?? $this->excerpt ?? null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->category->id ?? '';

        return [
            'slug' => 'required|max:100|unique:'.config('website.table_prefix', 'website').'_categories,slug,'.$id,
            'name' => 'required|max:100|unique:'.config('website.table_prefix', 'website').'_categories,name,'.$id,
            'excerpt' => 'nullable|max:5500',
            'parent_id' => 'nullable|exists:'.config('website.table_prefix', 'website').'_categories,id',
            'root_parent_id' => 'nullable|exists:'.config('website.table_prefix', 'website').'_categories,id',
            'model' => 'nullable|max:50',
            'active' => 'sometimes|boolean',
            'featured' => 'sometimes|boolean',
            'position' => 'nullable|numeric',
            'icon' => 'nullable|max:255',
            'color' => 'nullable|max:255',
            'meta_name' => 'nullable|max:100',
            'meta_description' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:100',
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
