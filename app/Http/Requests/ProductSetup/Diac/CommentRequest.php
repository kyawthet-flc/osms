<?php

namespace App\Http\Requests\ProductSetup\Diac;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'officer_id' => ['required'], 
            'body' => ['required']
        ];

        foreach(request()->file('commentFiles')??[] as $key => $file) {
            $rules['commentFiles.'.$key] = 'nullable|mimes:pdf';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [ ];

        foreach(request()->file('commentFiles')??[] as $key => $file) {
            $messages['commentFiles.'.$key.'.mimes'] = 'The file must PDF.';
        }
        return $messages;
    }


}