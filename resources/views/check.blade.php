<h1>{{ Auth::user()->name }}</h1>
<form action="{{ route('logout') }}" method="post" style="display: inline;">
    @csrf
    <button type="submit" class="au-btn au-btn--red">Đăng Xuất</button>
</form>
