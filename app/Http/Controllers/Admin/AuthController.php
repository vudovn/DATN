<?php  
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class AuthController extends Controller{

    public function __construct(

    ){

    }


    public function index(){
        return view('admin.auth.login');
    }

    public function login(AuthRequest $request){
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index')->with('success', 'Đăng nhập thành công');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function forget()
    {
        return view('admin.auth.forget');
    }

    public function postForgetPass(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
    
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    // Hiển thị trang thay đổi mật khẩu
    public function resetPassword(Request $request, $token, $email)
    {
        return view('admin.auth.change', ['token' => $token, 'email' => $email]);
    }

    public function postChangePass(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('auth.index')->with('success', __($status))
                    : back()->withErrors(['error' => [__($status)]]);

        // $user = User::where('email', $request->email)->first();

        // if (!$user) {
        //     return back()->withErrors(['email' => 'Không tìm thấy người dùng.']);
        // }

        // if ($user->reset_token !== $request->token) {
        //     return back()->withErrors(['token' => 'Token không hợp lệ.']);
        // }

        // $user->password = Hash::make($request->password);
        // $user->save();

        // return redirect()->route('auth.index')->with('status', 'Mật khẩu đã được thay đổi thành công.');
    }
    


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.index')->with('success', 'Đăng xuất thành công');
    }

}