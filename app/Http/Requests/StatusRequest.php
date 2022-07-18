<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
                        'name' => ['required', 'unique:statuses,name'],
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => ['required', 'unique:statuses,name,' . $this->route()->status->id],
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
        ];
    }
}
