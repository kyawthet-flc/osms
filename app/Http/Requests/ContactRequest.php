<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'priority_level' => ['required'], 
            'subject' => ['required'],
            'body' => ['required'], 
        ];

        foreach(request()->file('contactFiles')??[] as $key => $file) {
            $rules['contactFiles.'.$key] = 'nullable|mimes:pdf,png,jpeg,jpg';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [ ];

        foreach(request()->file('contactfiles')??[] as $key => $file) {
            $messages['contactfiles.'.$key.'.mimes'] = 'The file must PDF or PNG JPEG, JPG.';
        }
        return $messages;
    }

}