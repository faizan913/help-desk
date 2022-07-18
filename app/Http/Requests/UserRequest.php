<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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

        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name' => ['required'],
                        'email' => [
                            'required',
                            Rule::unique('users')->whereNull('deleted_at'),
                        ],
                        'role' => ['required'],
                        'department' => ['required'],
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => ['required'],
                        'email' => ['required', 'unique:users,email,' . $this->route()->user->id],
                        'role' => ['required'],
                        'department' => ['required'],
                    ];
                }
            default:
                break;
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank',
            'email.required' => 'Email cannot be blank',
            'role.required' => 'Role cannot be blank',
            'department.required' => 'Department cannot be blank',
        ];
    }
}
