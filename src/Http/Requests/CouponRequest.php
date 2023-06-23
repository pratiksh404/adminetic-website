<?php

namespace Adminetic\Website\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->coupon->id ?? '';

        return [
            'name' => 'required|unique:coupons,name,'.$id,
            'image' => 'nullable|file|image|max:3000',
            'description' => 'nullable|max:5000',
        ];
    }
}
