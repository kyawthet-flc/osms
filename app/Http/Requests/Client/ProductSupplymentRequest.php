<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ProductSupplymentRequest extends FormRequest
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
            "product_id" => 'required',
            "supplier_id" => 'required',
            "remaining_amount" => 'required',
            "paid_amount" => 'required',
            "total_amount" => 'required',
            "remark" => "nullable"
        ];
    } 
}
