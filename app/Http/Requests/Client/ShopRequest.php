<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
        return [
            "name" => 'required',
            "name_mm" => 'nullable',
            "website" => 'nullable',
            "phone" => 'nullable',
            "facebook" => 'nullable',
            "logo" => 'nullable',
            "ts_id" => 'required',
            "status" => "required",
            "address" => "nullable",
            "desc" => "nullable"
        ];
    }

    public function messages()
    {
        return [
            "ts_id.required" => 'The township field  is required.'
        ];
    }
}
