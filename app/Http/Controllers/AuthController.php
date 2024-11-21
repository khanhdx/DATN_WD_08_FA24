<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Cart;
use App\Models\ChatRoom;
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
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(RegisterRequest $request)
    {
        if ($this->authService->userExists($request->email)) {
            return redirect()->back()->withErrors(['email' => 'Email đã tồn tại.'])->withInput();
        }
        try {
            // Tạo người dùng mới
            $user = $this->authService->register($request->validated());

            // Tạo giỏ hàng cho người dùng mới
            Cart::create([
                'user_id' => $user->id,
                // Nếu có các trường khác cần thiết, hãy thêm vào đây
            ]);

            ChatRoom::firstOrCreate([
                'user_id' => $user->id,
            ]);

            $this->authService->login($request->validated());

            return redirect()->route('client.home')->with('success', 'Đăng ký thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['email' => 'Đã xảy ra lỗi: ' . $e->getMessage()])->withInput();
        }
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(LoginRequest $request)
    {
        if (!$this->authService->userExists($request->email)) {
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        if ($this->authService->login($request->validated())) {
            // Lấy thông tin người dùng sau khi đăng nhập thành công
            $user = Auth::user();

            // Chuyển hướng theo vai trò của người dùng
            if ($user->role === 'Quản lý') {
                return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công.');
            } elseif ($user->role === 'Khách hàng') {
                return redirect()->route('client.home')->with('success', 'Đăng nhập thành công.');
            }

            // Chuyển hướng mặc định nếu không có vai trò phù hợp
            return redirect()->route('client.home')->with('success', 'Đăng nhập thành công.');
        }

        return redirect()->back()->withErrors(['email' => 'Sai tên đăng nhập hoặc mật khẩu.']);
    }

    public function loginAjax(LoginRequest $request)
    {
        if (!$this->authService->userExists($request->email)) {
            return response()->json([
                'message' => 'Email không tồn tại!',
                'status_code' => 404,
            ], 404);
        }

        if ($this->authService->login($request->validated())) {
            $user = Auth::user();

            if ($user->role === 'Quản lý') {
                return response()->json([
                    'admin' => route('admin.dashboard'),
                    'message' => 'Đăng nhập thành công!',
                    'status_code' => 200,
                ]);
            }

            return response()->json([
                'message' => 'Đăng nhập thành công!',
                'status_code' => 200,
            ]);
        }

        return response()->json([
            'message' => 'Sai tên đăng nhập hoặc mật khẩu!',
            'status_code' => 500,
        ], 500);
    }

    public function logout()
    {
        $this->authService->logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('client.home')->with('success', 'Đăng xuất thành công.');
    }

    // Hiển thị form đặt lại mật khẩu
    public function showResetPasswordForm()
    {
        return view('auth.passwords');
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
        return view('auth.passwordsReset', ['token' => $token]);
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
