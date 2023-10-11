<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PackageRequest extends FormRequest
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
            'slug' => ! is_null($this->name) ? Str::slug($this->name) : null,
            'meta_name' => $this->service->meta_name ?? $this->meta_name ?? $this->name ?? null,
            'meta_description' => $this->service->meta_description ?? $this->meta_description ?? $this->excerpt ?? null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->service->id ?? '';

        return [
            'slug' => 'required|max:100|unique:'.config('website.table_prefix', 'website').'_categories,slug,'.$id,
            'name' => 'required|max:100|unique:'.config('website.table_prefix', 'website').'_categories,name,'.$id,
            'excerpt' => 'nullable|max:5500',
            'description' => 'nullable|max:55000',
            'category_id' => 'nullable|exists:'.config('website.table_prefix', 'website').'_categories,id',
            'active' => 'sometimes|boolean',
            'featured' => 'sometimes|boolean',
            'position' => 'nullable|numeric',
            'icon' => 'nullable|max:255',
            'color' => 'nullable|max:255',
            'data' => 'nullable',
            'meta_name' => 'nullable|max:100',
            'meta_description' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:100',
        ];
    }
}
