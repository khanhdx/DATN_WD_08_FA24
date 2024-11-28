<!-- Begin Login -->
<div class="login-wrapper">
    <form id="form-login" role="form" method="POST">
        @csrf
        
        <h4>Đăng nhập</h4>
        {{-- <p>Nếu bạn là thành viên, đăng nhập tại đây.</p> --}}
        <div class="form-group">
            <label for="inputusername">Email</label>
            <input type="text" name="email" class="form-control input-lg" id="inputusername" placeholder="Email">
            <div id="errorEmail" class="text-danger"></div>
        </div>
        <div class="form-group">
            <label for="inputpassword">Password</label>
            <input type="password" name="password" class="form-control input-lg" id="inputpassword"
                placeholder="Password">
            <div id="errorPassword" class="text-danger"></div>
        </div>
        <ul class="list-inline">
            <li><a href="{{ route('register') }}">Đăng ký tài khoản mới! Tại đây</a></li>
            <li><a href="{{ route('password.request') }}">Quên mật khẩu?</a></li>
        </ul>
        <button type="submit" class="btn btn-white">Đăng nhập</button>
    </form>
</div>
<!-- End Login -->
