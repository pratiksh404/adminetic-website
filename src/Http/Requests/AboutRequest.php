<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class AboutRequest extends FormRequest
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
            'slug' => !is_null($this->title) ? Str::slug($this->title) : null,
            'meta_name' => $this->process->meta_name ?? $this->meta_name ?? $this->title ?? null,
            'meta_description' => $this->process->meta_description ?? $this->meta_description ?? $this->excerpt ?? null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->about->id ?? '';

        return [
            'slug' => 'required|max:100|unique:' . config('website.table_prefix', 'website') . '_abouts,slug,' . $id,
            'title' => 'required|max:100|unique:' . config('website.table_prefix', 'website') . '_abouts,title,' . $id,
            'excerpt' => 'nullable',
            'description' => 'nullable',
            'position' => 'nullable',
            'meta_name' => 'nullable|max:100',
            'meta_description' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:100',
        ];
    }
}
