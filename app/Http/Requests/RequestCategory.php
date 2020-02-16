<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCategory extends FormRequest
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
            'name' => 'required|min:6|max:20',
        ];
    }
    public function messages()
    {
        return [
         'name.required' => 'Bạn chưa nhập tên.',
         'name.min' => 'Tên phải có đọ dài từ 6-20 ký tự.',
         'name.max' => 'Tên phải có đọ dài từ 6-20 ký tự.'
     ];
 }
}
