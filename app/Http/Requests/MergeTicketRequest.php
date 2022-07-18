<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MergeTicketRequest extends FormRequest
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
                        'ticket_id' => ['required'],
                    ];
                }
            default:
                break;
        }
    }
    public function messages()
    {
        return [
            'ticket_id.required' => 'Ticket id cannot be blank',
        ];
    }
}
