<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\VerifyAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function login()
    {
        return view('client.auth.login');
    }

    public function register()
    {
        return view('client.auth.register');
    }
    public function postRegister(Request $request)
    {
       $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'password-confirm' => 'required|same:password',
        // 'terms' => 'accepted',
       ], [
        'name.required' => 'Vui lòng nhập họ & tên',
        'email.required' => 'Vui lòng nhập email',
        'email.email' => 'Email không đúng định dạng',
        'email.unique' => 'Email đã tồn tại trong hệ thống',
        'password.required' => 'Vui lòng nhập mật khẩu',
        'password.min' => 'Mật khẩu phải lớn hơn 6 kí tự',
        'password-confirm.required' => 'Vui lòng nhập mật khẩu xác nhận',
        'password-confirm.same' => 'Mật khẩu xác nhận không trùng khớp',
        // 'terms.accepted' => 'Bạn cần đồng ý với các điều khoản'
       ]);
        $data = $request->only('name', 'email');
        $data['password'] = bcrypt($request->password);
        // $data['confirmation_token'] = Str::random(60);
       if ($account = User::create($data)){
            Mail::to($account->email)->send(new VerifyAccount($account));
            return redirect()->route('client.auth.login')->with('success', 'Đăng ký thành công, vui lòng kiểm tra email để kích hoạt tài khoản');
       }
       return redirect()->back()->with('error', 'Đăng ký không thành công');
    }
    public function postLogin(Request $request)
{
    // Validate email và mật khẩu
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:6'
    ], [
        'email.required' => 'Vui lòng nhập email',
        'email.exists' => 'Email không tồn tại trong hệ thống',
        'email.email' => 'Email không đúng định dạng',
        'password.required' => 'Vui lòng nhập mật khẩu',
        'password.min' => 'Mật khẩu phải lớn hơn 6 kí tự'
    ]);

    $user = User::where('email', $request->input('email'))->first();
    if ($user && is_null($user->email_verified_at)) {
        return back()->withErrors(['email' => 'Tài khoản của bạn chưa được kích hoạt.'])->onlyInput('email');
    }

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/')->with('success', 'Đăng nhập thành công');
    }
    return back()->withErrors([
        'password' => 'Mật khẩu không chính xác.',
    ])->onlyInput('email');
}


    public function forget()
    {
        return view('client.auth.forget_password.forget');
    }

    public function change()
    {
        return view('client.auth.forget_password.change');
    }

    public function active($email)
    {
        $account = User::where('email', $email)->whereNUll('email_verified_at')->firstOrFail();
        User::where('email', $email)->update([
            'email_verified_at' => now(), 
            'publish' => 1 
        ]);
        return redirect()->route('client.auth.login')->with('success', 'Kích hoạt thành công');

    }

    public function logout()
    {
    }




}
