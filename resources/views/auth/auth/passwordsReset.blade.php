{{-- 

    @section('content')
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="images/icon/logo.png" alt="App Logo">
                        </a>
                    </div>
                    <div class="login-form">
                        <form action="{{ route('password.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="au-input au-input--full" type="email" name="email" placeholder="Email" required>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="New Password" required>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection --}}


@extends('auth.layout.auth')

@section('title', 'Reset Password')

@section('text_page')
Reset Password
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
    <div class="container">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <h4>Reset Password</h4> 
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label class="form-label" for="email">Email Address:</label>
                <input type="email" id="email" name="email" class="form-control input-lg" placeholder="Email" >
                @error('email')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Password:</label>
                <input type="password" id="password" name="password" class="form-control input-lg" placeholder="New Password" >
                @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" >
                @error('password_confirmation')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;">Reset Password</button>
            </div>
        </form>
    </div>

@endsection

