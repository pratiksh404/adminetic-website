<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
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
            'sku' => ! is_null($this->name) ? Str::slug($this->name) : null,
            'meta_name' => $this->project->meta_name ?? $this->meta_name ?? $this->name ?? null,
            'meta_description' => $this->project->meta_description ?? $this->meta_description ?? $this->excerpt ?? null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->product->id ?? '';

        return [
            'sku' => 'required|unique:products,sku,'.$id,
            'name' => 'required|unique:products,name,'.$id,
            'generic_name' => 'nullable',
            'strength' => 'nullable',
            'dosage_form' => 'nullable',
            'slug' => 'required|unique:products,slug,'.$id,
            'category_id' => 'nullable|exists:categories,id',
            'selling_price' => 'required|numeric',
            'cost_price' => 'nullable|numeric',
            'quantity' => 'sometimes|numeric',
            'quantity_alert' => 'sometimes|numeric',
            'points' => 'nullable|numeric',
            'excerpt' => 'nullable|max:5500',
            'description' => 'nullable|max:55000',
            'position' => 'nullable|numeric',
            'active' => 'sometimes|boolean',
            'discount' => 'sometimes|numeric',
            'data' => 'nullable',
            'meta_name' => 'nullable|max:100',
            'meta_description' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:100',
        ];
    }
}
