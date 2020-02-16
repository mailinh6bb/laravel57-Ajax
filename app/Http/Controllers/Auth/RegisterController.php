<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $this -> validate($request, [
            'name' => 'required|min:6|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:50',
            're_password' => 'required|same:password',
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'name.min' => 'Tên phải có độ dài từ 6-50 ký tự',
            'name.max' => 'Tên phải có độ dài từ 6-50 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có 6-50 ký tự',
            'password.max' => 'Mật khẩu phải có 6-50 ký tự',
            're_password.required' => 'Vui lòng nhập lại mật khẩu',
            're_password.same' => 'Mật khẩu không trùng nhau'
        ]);
        $user= new User();
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> password = bcrypt($request -> password);
        $user -> save();
        return redirect('/');
    }
}
