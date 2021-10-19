<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            "shop_id" => 'required',
            "name" => 'required',
            "email" => 'nullable',
            "phone" => 'required',
            "ts_id" => 'nullable',
            "address" => "required",
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
