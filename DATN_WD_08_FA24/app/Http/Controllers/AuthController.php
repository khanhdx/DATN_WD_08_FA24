<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showRegistrationForm()
    {
        return view('clients.auth.register'); // Trỏ đến view đăng ký
    }

    public function register(RegisterRequest $request)
    {
        // Kiểm tra nếu email đã tồn tại
        if ($this->authService->userExists($request->email)) {
            return redirect()->back()->withErrors(['email' => 'Email đã tồn tại.'])->withInput();
        }

        // Tạo người dùng mới
        $this->authService->register($request->validated());
        return redirect()->route('login')->with('success', 'Đăng ký thành công.');
    }

    public function showLoginForm()
    {
        return view('clients.auth.login'); // Trỏ đến view đăng nhập
    }

    public function login(LoginRequest $request)
    {
        // Kiểm tra xem người dùng có tồn tại không
        if (!$this->authService->userExists($request->email)) {
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        // Kiểm tra đăng nhập
        if ($this->authService->login($request->validated())) {
            return redirect()->route('check')->with('success', 'Đăng nhập thành công.');
        }

        return redirect()->back()->withErrors(['email' => 'Sai tên đăng nhập hoặc mật khẩu.']);
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công.');
    }

    public function showResetPasswordForm()
    {
        return view('clients.auth.passwords');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Gửi email đặt lại mật khẩu
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm($token)
    {
        return view('clients.auth.passwordsReset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Mật khẩu đã được thay đổi thành công.');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}
