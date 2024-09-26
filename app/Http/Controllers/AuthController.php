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

    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('clients.auth.register');
    }

    // Xử lý đăng ký
    public function register(RegisterRequest $request)
    {
        if ($this->authService->userExists($request->email)) {
            return redirect()->back()->withErrors(['email' => 'Email đã tồn tại.'])->withInput();
        }

        $this->authService->register($request->validated());
        return redirect()->route('login')->with('success', 'Đăng ký thành công.');
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('clients.auth.login');
    }

    // Xử lý đăng nhập
    public function login(LoginRequest $request)
    {
        if (!$this->authService->userExists($request->email)) {
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        if ($this->authService->login($request->validated())) {
            return redirect()->route('home')->with('success', 'Đăng nhập thành công.');
        }

        return redirect()->back()->withErrors(['email' => 'Sai tên đăng nhập hoặc mật khẩu.']);
    }

    // Xử lý đăng xuất
    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công.');
    }

    // Hiển thị form đặt lại mật khẩu
    public function showResetPasswordForm()
    {
        return view('clients.auth.passwords');
    }

    // Gửi link đặt lại mật khẩu
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    // Hiển thị form reset mật khẩu với token
    public function showResetForm($token)
    {
        return view('clients.auth.passwordsReset', ['token' => $token]);
    }

    // Xử lý reset mật khẩu
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