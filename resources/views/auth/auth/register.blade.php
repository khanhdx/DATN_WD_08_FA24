@extends('auth.layout.auth')

@section('title', 'Register')

@section('text_page')
    Register
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
    <div class="container">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <h4>Register</h4>
            <div class="form-group">
                <label class="form-label" for="email">Name:</label>
                <input type="text" id="name" name="name" class="form-control input-lg" placeholder="Name">
                @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
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
            <div class="form-group">
                <label class="form-label" for="inputpassword">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control input-lg"
                    placeholder="Confirm Password">
                @error('password_confirmation')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;">Register
                </button>
            </div>
            <ul class="list-inline">
                <p>
                    Already have an account?
                    <a href="{{ route('login') }}">Sign In</a>
                </p>
            </ul>
        </form>
    </div>

@endsection
