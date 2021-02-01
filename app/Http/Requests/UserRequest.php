<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'          => 'required',
            'username'      => 'required|max:20|unique:users,username,'.$this->id,
            'email'         => 'required|email|max:255|unique:users,email,'.$this->id,
            'mobile'        => 'required|numeric|unique:users,mobile,'.$this->id,
            'status'        => 'required',
            'password'      => 'required_without:id|unique:users,password,'.$this->id,


        ];
    }


    public function messages()
    {

        return [
            'required' => 'This field is required',
            'min' => 'This field is short',
            'max' => 'This field is long',
            'mobile.numeric' => 'The field must be assigned numbers',
            'unique' => 'The field is already registered,

'


        ];
    }

}
