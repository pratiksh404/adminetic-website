<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ClientRequest extends FormRequest
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
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->client->id ?? '';

        return [
            'name' => 'required|max:100|unique:'.config('website.table_prefix', 'website').'_clients,name,'.$id,
            'slug' => 'required|max:100|unique:'.config('website.table_prefix', 'website').'_clients,slug,'.$id,
            'description' => 'nullable|max:5500',
            'group' => 'nullable|numeric',
            'position' => 'nullable|numeric',
            'featured' => 'nullable|boolean',
        ];
    }
}
