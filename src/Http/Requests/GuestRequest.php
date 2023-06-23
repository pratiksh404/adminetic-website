<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'image' => 'nullable|file|image|max:3000',
            'description' => 'nullable|max:5500'
        ];
    }
}
