<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CareerRequest extends FormRequest
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
            'slug' => Str::slug($this->title),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->career->id ?? '';

        return [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:' . config('website.table_prefix', 'website') . '_careers,slug,' . $id,
            'designation' => 'required|max:255',
            'group' => 'nullable|numeric',
            'location' => 'nullable|max:255',
            'salary' => 'required|max:255',
            'deadline' => 'required',
            'excerpt' => 'required|max:5500',
            'description' => 'nullable|max:55000',
            'summary' => 'nullable',
            'application_description' => 'nullable|file',
            'application_syllabus' => 'nullable|file',
            'application_sort_list' => 'nullable|file',
            'application_result' => 'nullable|file',
            'add_apply_button' => 'nullable',
            'active' => 'sometimes|boolean',
        ];
    }
}
