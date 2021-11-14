<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PopupRequest extends FormRequest
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
            'code' => $this->popup->code ?? rand(100000, 9999998)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->popup->id ?? '';
        return [
            'code' => 'required|unique:popups,code,' . $id,
            'name' => 'nullable|max:255',
            'image' => 'nullable|file|image|max:3000',
            'body' => 'nullable|max:5500',
            'url' => 'nullable|max:255',
            'position' => 'sometimes|numeric'
        ];
    }
}
