<?php

namespace App\Http\Requests;

use App\Models\Admin\Page;
use Illuminate\Foundation\Http\FormRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PageRequest extends FormRequest
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
            'slug' => SlugService::createSlug(Page::class, 'slug', $this->title)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->page->id ?? '';
        return [
            'slug' => 'required|max:255|unique:pages,slug,' . $id,
            'code' => 'required|max:255|unique:pages,slug,' . $id,
            'title' => 'required|max:255',
            'seo_title' => 'nullable|max:255',
            'body' => 'nullable|max:65535',
            'image' => 'sometimes|file|image|max:3000',
            'meta_description' => 'nullable|max:160',
            'meta_keywords' => 'nullable',
            'active' => 'required|boolean',
            'video' => 'sometimes|max:255',
            'type' => 'required|numeric'
        ];
    }
}
