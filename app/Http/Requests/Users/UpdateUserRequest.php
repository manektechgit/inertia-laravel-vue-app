<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'user.name' => 'required|max:50',
            'user.email' => 'required|email|max:50|unique:users,email,'.$this->id,
            'userRole' => 'required'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'user.name.required' => 'The name field is required.',
            'user.email.required' => 'The email field is required.',
            'user.email.unique' => 'The email has already been taken.',
            'userRole.required' => 'The role field is required.'
        ];
    }
}
