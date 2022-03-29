<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tripRequest extends FormRequest
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
            'contents'=>'required|max:1000',
            'title'=>'required|max:50',
           
        ];
    }

    public function messages()
    {
        return [
            'contents.required'=>'ブログが書かれていません。',
            'contents.max'=>'ブログは1000字以内で入力してください。',
            'title.required'=>'タイトルを入力してください',
            'title.max'=>'タイトルは50字以内で入力してください。',
        ];
    }
}
