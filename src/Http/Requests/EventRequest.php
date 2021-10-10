<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class EventRequest extends FormRequest
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
            'code' => $this->event->code ?? rand(100000, 999999),
            'slug' => Str::slug($this->name),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->event->id ?? '';

        return [
            'slug' => 'required|max:255|unique:events,slug,'.$id,
            'code' => 'required|max:255|unique:events,code,'.$id,
            'name' => 'required|max:255',
            'description' => 'required|max:55000',
            'single_day' => 'sometimes|boolean',
            'event_date' => 'required_if:single_day,1',
            'start_date' => 'required_if:single_day,0',
            'end_date' => 'required_if:single_day,0',
            'interval' => 'required_if:single_day,0',
            'notice' => 'nullable|max:255',
            'image' => 'nullable|file|image|max:3000',
            'gallery_id' => 'nullable|numeric',
            'meta_name' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'meta_keywords' => 'nullable',
        ];
    }
}
