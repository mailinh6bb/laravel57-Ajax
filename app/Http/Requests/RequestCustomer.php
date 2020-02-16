<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCustomer extends FormRequest
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
        'email' => 'required|email',
        'phone' => 'required|numeric',
        'address' => 'required|min:6|max:255',
        'name' => 'required|min:6|max:255'
      ];
    }
    public function messages()
    {
      return [
       'email.required' => 'Vui lòng nhập email',
       'email.eamil' => 'Email không hợp lệ',
       'phone.required' => 'Vui lòng nhập số điện thoại',
       'phone.numeric' => 'Không phải là số điện thoại',
       'address.required' => 'Vui lòng nhập địa chỉ',
       'address.min' => 'Địa chỉ phải có từ 6-255 ký tự',
       'address.max' => 'Địa chỉ phải có từ 6-255 ký tự',
        'name.required' => 'Vui lòng nhập họ tên',
       'name.min' => 'Họ tên phải có từ 6-255 ký tự',
       'name.max' => 'Họ tên  phải có từ 6-255 ký tự',
     ];
   }
 }
