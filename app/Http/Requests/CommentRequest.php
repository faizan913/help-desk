<?php

namespace App\Http\Requests;

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
        return [
            'author_name' => 'required',
            'author_email' => 'required',
            'comment' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'author_name.required' => 'Author name cannot be blank',
            'author_email.required' => 'Email cannot be blank',
            'comment.required' => 'Comment cannot be blank',

        ];
    }
}
