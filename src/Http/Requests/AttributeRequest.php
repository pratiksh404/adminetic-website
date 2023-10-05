<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
        $id = $this->attribute->id ?? '';

        return [
            'code' => 'required|unique:'.config('website.table_prefix', 'website').'_attributes,code,'.$id,
            'name' => 'required|max:60',
            'values' => 'required',
            'is_searchable' => 'sometimes|boolean',
        ];
    }
}
