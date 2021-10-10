<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'shop_id' => 'required',
            'product_type_id' => 'required',
            'name' => 'required',
            'desc' => 'nullable',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => 'The shop name is required.',
            'product_type_id.required' => 'The product category is required.',
            'name.required' => 'The Product Name is required.'
        ];
    }
}
