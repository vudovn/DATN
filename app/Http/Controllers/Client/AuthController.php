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
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepository;


class AuthController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
        if ($account = User::create($data)) {
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
            'password' => 'required'
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


    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Email không tồn tại trong hệ thống',
        ]);

        $token = strtoupper(Str::random(10));
        $payload = [
            'remember_token' => $token
        ];
        // dd($payload);
        $user = $this->userRepository->findByField('email', $request->email)->first();
        $update = $this->userRepository->updateByWhereIn('email', [$request->email], $payload);
        Mail::send('client.emails.reset-password-client', ['user' => $user, 'token' => $token], function ($email) use ($user) {
            $email->subject('Thế giới nội thất - Đặt lại mật khẩu');
            $email->to($user->email, $user->name);
        });
        return redirect()->back()->with('success', 'Kiểm tra email để đặt lại mật khẩu');
    }


    public function change(User $user, $token)
    {
        if ($user->remember_token === $token) {
            return view('client.auth.forget_password.change', ['user' => $user->id, 'token' => $token]);
        }
        return redirect()->route('client.auth.login')->withErrors(['token' => 'Token không hợp lệ.']);
    }


    public function submitChangePasswordForm(User $user, $token, Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.min' => 'Mật khẩu phải lớn hơn 6 kí tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
        ]);
        // dd($user, $token, $request->all());

        if ($user && $user->remember_token === $token) {
            $update = $user->update([
                'password' => Hash::make($request->password),
                'remember_token' => null,
            ]);

            return redirect()->route('client.auth.login')->with('success', 'Đặt lại mật khẩu thành công');
        }

        return back()->withErrors(['token' => 'Token không hợp lệ hoặc đã hết hạn.']);
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
        Auth::logout();
        return redirect()->route('client.auth.login')->with('success', 'Đăng xuất thành công');
    }
}
