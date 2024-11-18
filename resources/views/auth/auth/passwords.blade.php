@extends('auth.layout.auth')

@section('title', 'Forgot Password')

@section('text_page')
Forgot Password
@endsection

@section('content')
    @include('client.layouts.components.pagetop')
    <div class="container">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <form action="{{ route('password.email') }}" method="post">
            @csrf
            <h4>Forgot Password</h4>
           
            <div class="form-group">
                <label class="form-label" for="email">Email Address:</label>
                <input type="email" id="email" name="email" class="form-control input-lg" placeholder="Email" >
                @error('email')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px;">Send Password Reset Link</button>
            </div>
        </form>
    </div>

@endsection

