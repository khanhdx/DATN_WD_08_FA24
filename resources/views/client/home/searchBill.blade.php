@extends('client.layouts.master')

{{-- @section('text_page')
    Tìm kiếm hóa đơn
@endsection --}}
@section('title', 'Tìm kiếm hóa đơn')

@section('content')
@include('client.layouts.components.pagetop', ['md' => 'md'])

    <div class="container">

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('search.bill.post') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="phone_number">Số điện thoại</label>
                <input 
                    type="text" 
                    name="phone_number" 
                    id="phone_number" 
                    class="form-control" 
                    placeholder="Nhập số điện thoại của bạn..." 
                    required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Tìm kiếm</button>
        </form>
    </div>
@endsection
