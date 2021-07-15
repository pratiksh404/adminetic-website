<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'gallery_id' => 'sometimes|numeric',
            'image' => 'sometimes|file|image|max:4000',
            'type' => 'required|numeric',
            'url' => 'nullable|max:255',
            'title' => 'required_if:type,4|max:255',
            'excerpt' => 'nullable|max:1000'
        ];
    }
}
