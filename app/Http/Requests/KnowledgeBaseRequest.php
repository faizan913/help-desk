<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class KnowledgeBaseRequest extends FormRequest
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
                        'question' => [
                            'required',
                            Rule::unique('knowledge_bases')->where('service_id', $this->service),
                        ],
                        'service' => ['required'],
                        'answer' => ['required'],
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'service' => ['required'],
                        'question' => [
                            'required',
                            Rule::unique('knowledge_bases')->where('service_id', $this->service)->ignore($this->route()->knowledge->id),
                        ],
                        //'question' => ['required:knowledge_bases,question,' . $this->route()->knowledge->id],
                        'answer' => ['required'],
                    ];
                }
            default:
                break;
        }
    }
    public function messages()
    {
        return [
            'service.required' => 'Service cannot be blank',
            'question.required' => 'Question cannot be blank',
            'question.unique' => 'The question has already been taken for seletd category',
            'answer.required' => 'Answer cannot be blank',
        ];
    }
}
