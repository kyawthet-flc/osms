<?php

namespace App\Http\Requests\AccountSetup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUserRequest extends FormRequest
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
        // return [
        //     'name' => ['required', 'string', 'max:255'],
        //     'login_id' => ['required', 'string', 'unique:users'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'status' => ['required']
        // ];
        $data['password'] = 'required|confirmed';
        if(isset($this->adminUser->id)){
            $data['password'] = 'nullable|confirmed';
        }

        return [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore(optional($this->adminUser)->id)],
            // 'login_id' => ['required', Rule::unique('users')->ignore(optional($this->adminUser)->id) ],
            'role' => ['required'],
            'sub_role' => [ Rule::requiredIf(function () {
                return \App\Model\AccountSetup\Role::whereParentId($this->role)->count() > 0;
            })],
            'status' =>  ['required']
        ] + $data;
    }
}

