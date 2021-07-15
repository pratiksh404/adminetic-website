<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        $validate_image = in_array($this->method(), ['PUT', 'PATCH']) ? "sometimes" : "sometimes|file|image|max:3000";
        return [
            'name' => 'required|max:255',
            'image' => $validate_image,
            'url' => 'nullable|max:255'
        ];
    }
}
