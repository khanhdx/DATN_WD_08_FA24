@extends('client.layouts.master')

@section('title', 'Reset Password')

@section('text_page')
    Reset Password
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
    <div class="container">
        <div class="row">
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
                    <input type="email" id="email" name="email" class="form-control input-lg" placeholder="Email">
                    @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Password:</label>
                    <input type="password" id="password" name="password" class="form-control input-lg"
                        placeholder="New Password">
                    @error('password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control input-lg" placeholder="Confirm Password">
                    @error('password_confirmation')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;">Reset
                        Password</button>
                </div>
            </form>
        </div>
    </div>

@endsection
