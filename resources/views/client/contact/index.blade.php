@extends('client.layouts.master')

@section('text_page')
    Contact Us
@endsection

@section('content')
@include('client.layouts.components.pagetop', ['md' => 'md'])
<div class="container mt-5">
    <div class="row">
        <!-- Form Section -->
        <div class="col-md-7">
            <h4>Tell Us Your Project</h4>
            <form action="{{route('client.sendContact')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter your name" >
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone *</label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter your phone number" >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" >
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject *</label>
                    <input type="text" class="form-control" name="subject" placeholder="Enter subject" >
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">File Upload</label>
                    <input type="file" class="form-control" name="images">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message *</label>
                    <textarea class="form-control" name="message" rows="4" placeholder="Enter your message" ></textarea>
                </div>
                <button type="submit" class="btn btn-warning">Send Message</button>
            </form>
            @if (session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        </div>

        <!-- Contact Section -->
        <div class="col-md-5">
            <h4>Contact Us</h4>
            <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.</p>
            <ul class="list-unstyled">
                <li><i class="bi bi-geo-alt"></i> Địa chỉ: Cửu Yên - Ngũ Thái - Thuận Thành - Bắc Ninh</li>
                <li><i class="bi bi-envelope"></i> Email: <a href="mailto:quanndph41110@fpt.edu.vn">quanndph41110@fpt.edu.vn</a></li>
                <li><i class="bi bi-telephone"></i> Phone: +8483183446</li>
            </ul>
            <p><strong>Working Hours:</strong> <br>Monday - Saturday: 08AM - 22PM</p>
        </div>
    </div>
</div>
@endsection
