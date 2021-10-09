<?php

namespace Adminetic\Website\Http\Requests;

use Adminetic\Website\Models\Admin\Post;
use Illuminate\Foundation\Http\FormRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostRequest extends FormRequest
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
            'code' => $this->post->code ?? rand(100000, 999999),
            'slug' => SlugService::createSlug(Post::class, 'slug', $this->name)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->post->id ?? '';
        return [
            'slug' => 'required|max:255|unique:posts,slug,' . $id,
            'code' => 'required|max:255|unique:posts,code,' . $id,
            'author_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'name' => 'required|max:255',
            'excerpt' => 'required|max:255',
            'body' => 'sometimes|max:65535',
            'image' => 'sometimes|file|image:max:3000',
            'status' => 'required',
            'featured' => 'required|boolean',
            'priority' => 'nullable|numeric',
            'type' => 'nullable|numeric',
            'video' => 'nullable|max:255',
            'audio' => 'nullable|max:255',
            'breaking_news' => 'nullable|boolean',
            'hot_news' => 'nullable|boolean',
            'seo_name' => 'sometimes|max:255',
            'meta_description' => 'sometimes|max:255',
            'meta_keywords' => 'sometimes',
        ];
    }
}
