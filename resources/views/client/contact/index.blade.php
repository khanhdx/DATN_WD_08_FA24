@extends('client.layouts.master')

@section('title', 'Liên hệ')

@section('text_page')
    Liên hệ 
@endsection

@section('content')
@include('client.layouts.components.pagetop')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 animation">
                <div class="contact-content">

                    <h4>Mẫu liên hệ</h4>
                    <p>Khách hàng vui lòng nhập thông tin vào mẫu dưới đây để gửi phản hồi về chúng tôi.</p>
                    <form action="{{ route('client.sendContact') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name">Tên của bạn*</label>
                                    <input name="name" type="text" id="name" class="form-control" value=""
                                        data-msg-required="Please enter your name." required>
                                </div>
                                <div class="col-xs-6">
                                    <label for="customer_mail">Email của bạn*</label>
                                    <input name="email" type="email" id="email" class="form-control"
                                        value="" data-msg-required="Please enter your email address."
                                        data-msg-email="Please enter a valid email address." required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="subject">Chủ đề*</label>
                                    <input name="subject" type="text" id="subject" class="form-control" value=""
                                        data-msg-required="Please enter the subject." required>
                                </div>
                                <div class="col-xs-6">
                                    <label for="website">Ảnh</label>
                                    <input type="file" class="form-control" id="images" name="images" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comments">Tin nhắn của bạn*</label>
                            <textarea name="message" id="message" class="form-control" rows="3"
                                data-msg-required="Please enter your message." required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Gửi</button>
                            {{-- <input type="submit" value="Submit" class="btn btn-primary"> --}}
                        </div>
                    </form>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 animation">
                <div class="contact-content">
                    <h4>Liên hệ</h4>
                    <p>Khách hàng rất quan trọng, khách hàng sẽ được chúng tôi chăm sóc qua email này.
                         Và chúng tôi sẽ phản hồi lại một cách nhanh nhất.</p>
                    <address>
                        <i class="fa fa-map-marker"></i> Tòa nhà FPT Polytechnic. <br>
                        Cổng số 2, 13 P. Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội<br><i class="fa fa-phone"></i> 012.345.6789<br>
                        <i class="fa fa-print"></i> 012.345.6789<br>
                        <i class="fa fa-envelope"></i> <a href="mailto:mail@domainname.com">mail@domainname.com</a>
                    </address>
                </div>
            </div>
        </div>
    </div>
@endsection
