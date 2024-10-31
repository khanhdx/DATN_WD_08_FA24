@extends('auth.layout.auth')

@section('title', 'Login')

@section('text_page')
    sing In
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
    <div class="container">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <h4>Login</h4>
            <div class="form-group">
                <label class="form-label" for="email">Email Address:</label>
                <input type="email" id="email" name="email" class="form-control input-lg" placeholder="Email">
                @error('email')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="inputpassword">Password:</label>
                <input type="password" id="password" name="password" class="form-control input-lg" placeholder="Password">
                @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <ul class="list-inline">
                <li><a href="{{ route('register') }}">Sign Up Here</a></li>
                <li> <a href="{{ route('password.request') }}">Forgotten Password?</a></li>
            </ul>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;">Sign
                    In</button>
            </div>
        </form>
    </div>

@endsection

