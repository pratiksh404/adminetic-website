<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'slug' => !is_null($this->name) ? Str::slug($this->name) : null,
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->team->id ?? '';
        return [
            'name' => 'required|max:100|unique:teams,name,' . $id,
            'slug' => 'required|max:100|unique:teams,slug,' . $id,
            'short_message' => 'nullable|max:255',
            'description' => 'nullable|max:55000',
            'social_medias' => 'nullable',
            'phone' => 'nullable|max:100',
            'group' => 'nullable|numeric',
            'position' => 'nullable|numeric',
        ];
    }
}
