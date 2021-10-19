<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        /*
         "customer_id" => "2"
  "code" => "ODR-000000001"

  "ordered_at" => null
  "delivered_at" => null
  "received_at" => null
  "paid_at" => null

  "total_amount" => "0"
  "total_discount" => "0"
  "paid_status" => "unpaid"

  "payment_type_id" => null
  "deli_fee" => null
        */
        return [
            "customer_id" => 'required',
            "code" => 'required',

            "ordered_at" => 'required|date_format:d-m-Y',
            "delivered_at" => 'nullable|date_format:d-m-Y',
            "received_at" => 'nullable|date_format:d-m-Y',
            "paid_at" => 'nullable|date_format:d-m-Y',

            "total_amount" => 'required',
            "total_discount" => 'nullable',
            "paid_status" => 'required',

            "payment_type_id" => 'required',
            "deli_fee" => 'required',

            "status" => 'required',
            "paid_status" => 'required'
        ];
    }

    public function messages()
    {
        return [
            "ts_id.required" => 'The township field  is required.'
        ];
    }
}
