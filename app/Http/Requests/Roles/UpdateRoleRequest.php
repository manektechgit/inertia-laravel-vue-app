<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'role.name' => 'required|max:50|unique:roles,name,'.$this->id,
            'rolePermissions' => 'required'
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
            'role.name.required' => 'The role name field is required.',
            'role.name.unique' => 'The role name has already been taken.',
            'rolePermissions.required' => 'The permissions field is required.'
        ];
    }
}
