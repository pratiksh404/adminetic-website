<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockRequest extends FormRequest
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
            'code' => $this->block->code ?? rand(100000, 999999),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->block->id ?? '';

        return [
            'code' => 'required|max:255|unique:blocks,code,'.$id,
            'name' => 'required|max:255|unique:blocks,name,'.$id,
            'image' => 'nullable|file|image|max:3000',
            'page' => 'nullable|max:255',
            'location' => 'required|max:255',
            'position' => 'sometimes|numeric',
            'body' => 'nullable|max:55000',
            'active' => 'sometimes|boolean',
        ];
    }
}
