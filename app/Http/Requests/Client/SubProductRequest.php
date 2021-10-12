<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class SubProductRequest extends FormRequest
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
        $rules = [
            'color' => 'required',
            'size' => 'required',

            'quantity_bought' => 'required|numeric',
            'quantity_avaiable' => 'required|numeric',
            // 'quantity_left' => 'required',
            'unit' => 'required',
            
            'price_bought' => 'required|numeric',            
            'price_sold' => 'required|numeric',

            'desc' => 'nullable'
        ];

        foreach(request()->file('files')??[] as $key => $file) {
            $rules['files.'.$key] = ['required', 'mimes:jpg,jpeg,png,gif,svg'];
        }
        return $rules;
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
