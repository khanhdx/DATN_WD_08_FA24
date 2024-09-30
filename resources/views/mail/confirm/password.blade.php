<x-mail::message>
# Bạn đã tạo tài khoản mới

Thông tin tài khoản: <br>
Tên tài khoản: {{$user->name}}<br>
Địa chỉ mail: {{$user->email}}<br>
Mật khẩu: {{$user->password}}<br>
Loại tài khoản: {{ $user->role }}<br>
<br>

<a href="{{ route('client.posts.index') }}">Cập nhật mật khẩu</a>
<x-mail::button :url="''">
Cập nhật mật khẩu
</x-mail::button>

Xin cảm ơn!,<br>
{{ config('app.name') }}
</x-mail::message>
