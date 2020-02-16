<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduct extends FormRequest
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
          'name' => 'required|min:6|max:100',
          'price' => 'required',
          'qty' => 'required',
          'description' => 'required|max:300',
          'content' => 'required'
      ];
  }
  public function messages()
  {
    return [
        'name.required' => 'Bạn chưa nhập tên sản phẩm.',
        'name.min' => 'Tên phải có đọ dài từ 6-100 ký tự.',
        'name.max' => 'Tên phải có đọ dài từ 6-100 ký tự.',
        'price.required' => 'Bạn chưa nhập giá.',
        'qty.required' => 'Bạn chưa nhập số lượng.',
        'description.required' => 'Bạn chưa nhập mô tả.',
        'content.required' => 'Bạn chưa nhập nội dung.'
    ];
}
}