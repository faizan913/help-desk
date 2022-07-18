<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
            'priority' => 'required',
            'service' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'title cannot be blank',
            'content.required' => 'content cannot be blank',
            'priority.required' => 'Priority cannot be blank',
            'service.required' => 'Service cannot be blank',
        ];
    }
}
