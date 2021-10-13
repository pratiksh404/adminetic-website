<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class TeamRequest extends FormRequest
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
        $id = $this->team->id ?? '';

        return [
            'code' => 'required|max:255|unique:teams,code,' . $id,
            'name' => 'required|max:100',
            'slug' => 'required|max:255|unique:teams,code,' . $id,
            'designation' => 'required|max:100',
            'image' => 'sometimes|file|image|max:3000',
            'phone' => 'nullable',
            'phone.*' => 'nullable|numeric',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|max:255',
            'instagram' => 'nullable|max:255',
            'twitter' => 'nullable|max:255',
            'linkedin' => 'nullable|max:255',
            'github' => 'nullable|max:255',
            'messenger' => 'nullable|max:255',
            'whatsapp' => 'nullable|max:255',
            'message' => 'nullable|max:10000',
            'position' => 'sometimes|numeric|max:100',
            'group' => 'sometimes|numeric|max:100',
        ];
    }
}
