<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:60',
            'package_time' => 'required|numeric',
            'package_cost' => 'required|numeric',
            'color' => 'nullable|max:255',
            'features' => 'required',
            'active' => 'required|boolean',
            'link' => 'nullable|max:255',
        ];
    }
}
