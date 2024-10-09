<h1>Bạn đã tạo tài khoản mới</h1>

Thời gian: {{$user->created_at}}
<p>Thông tin tài khoản:</p>
<p>Tên tài khoản: {{$user->name}}</p>
<p>Địa chỉ mail: {{$user->email}}</p>
<p>Mật khẩu: {{$user->password}}</p>
<p>Loại tài khoản: {{ $user->role }}</p>
<form action="{{ route('login') }}" method="POST">
    @csrf
    <input type="hidden" value="{{$user->email}}" name="email">
    <input type="hidden" value="{{$user->password}}" name="password">
    <button>Đăng nhập ngay</button>
</form>
<i>Vui lòng đăng nhập bằng tài khoản email.</i>
<strong>Xin cảm ơn!</strong>