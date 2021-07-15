<?php

namespace Adminetic\Website\Http\Requests;

use Adminetic\Website\Models\Admin\Gallery;
use Illuminate\Foundation\Http\FormRequest;

class GalleryImageRequest extends FormRequest
{
    protected $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

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
            'type' => $this->gallery->type == 1 ? 1 : 2
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'images' => 'required',
            'images.*' => 'file|image|max:3000'
        ];
    }
}
