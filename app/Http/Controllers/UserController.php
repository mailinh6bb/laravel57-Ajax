<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{

    public function loginAdmin(Request $request){
        $this -> validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);
        $data = [
            'email' => $request -> email,
            'password' => $request -> password,
        ];
        if (Auth::attempt($data)) {
            if (Auth::user() -> role == 1) {
              return redirect()->route('admin.home') -> with('thongbao', 'Đăng nhập thành công');;
          }
          elseif (Auth::user() -> role == 2) {
            return redirect()->route('admin.get.list.category') -> with('thongbao', 'Đăng nhập thành công');;
        }
        elseif (Auth::user() -> role == 3) {
         return redirect()->route('product.index') -> with('thongbao', 'Đăng nhập thành công');;
     }
     elseif (Auth::user() -> role ==  4) {
        return redirect()->route('order.index') -> with('thongbao', 'Đăng nhập thành công');;
    }

}
return back() -> with('error', 'Tài Khoản Không Chính Xác');

}
public function logoutAdmin(){
    if (Auth::check()) {
        Auth::logout();
        return redirect()-> route('home') -> with(['thongbao' =>  'Đăng Xuất Thành Công']);
    }
}
}
