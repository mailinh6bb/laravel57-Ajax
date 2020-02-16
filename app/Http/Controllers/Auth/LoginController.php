<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function getLogin(Request $request){
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
            return redirect('') -> with('thongbao', 'Đăng nhập thành công');;
        }
        return back() -> with('thongbao', 'Tài Khoản Không Chính Xác');

    }
    public function getLogout(){
        if (Auth::check()) {
            Auth::logout();
            return back() -> with('thongbao', 'Đăng Xuất Thành Công');
        }
    }
}
