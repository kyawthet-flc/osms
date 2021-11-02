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
            'variations.*.color' => 'required',
            'variations.*.size' => 'required',
            'variations.*.quantity_avaiable' => 'required|numeric',
            'variations.*.unit' => 'nullable',            
            'variations.*.price_bought' => 'required|numeric',            
            'variations.*.price_sold' => 'required|numeric',
            'variations.*.desc' => 'nullable'
        ];

        // foreach(request()->file('contactFiles')??[] as $key => $file) {
        //     $rules['contactFiles.'.$key] = 'nullable|mimes:pdf,png,jpeg,jpg';
        // }

        return $rules;

        // foreach(request()->file('files')??[] as $key => $file) {
        //     $rules['files.'.$key] = ['mimes:jpg,jpeg,png,gif,svg'];
        // }
        // return $rules;
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
