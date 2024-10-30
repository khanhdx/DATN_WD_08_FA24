@extends('client.layouts.master')

@section('text_page')
    Get in touch 
@endsection

@section('content')
@include('client.layouts.components.pagetop')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 animation">
                <div class="contact-content">

                    <h4>Contact Form</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Nam scelerisque faucibus risus non
                        iaculis.</p>
                    <form action="{{ route('client.sendContact') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="name">Your Name*</label>
                                    <input name="name" type="text" id="name" class="form-control" value=""
                                        data-msg-required="Please enter your name." required>
                                </div>
                                <div class="col-xs-6">
                                    <label for="customer_mail">Your Email*</label>
                                    <input name="email" type="email" id="email" class="form-control"
                                        value="" data-msg-required="Please enter your email address."
                                        data-msg-email="Please enter a valid email address." required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="subject">Subject*</label>
                                    <input name="subject" type="text" id="subject" class="form-control" value=""
                                        data-msg-required="Please enter the subject." required>
                                </div>
                                <div class="col-xs-6">
                                    <label for="website">images</label>
                                    <input type="file" class="form-control" id="images" name="images" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comments">Your Message*</label>
                            <textarea name="message" id="message" class="form-control" rows="3"
                                data-msg-required="Please enter your message." required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
                    <h4>Get in touch</h4>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                        architecto.</p>
                    <address>
                        <i class="fa fa-map-marker"></i> Alexander Street. Vancouver, BC<br>
                        V6A 1E1 Canada<br><i class="fa fa-phone"></i> 012.345.6789<br>
                        <i class="fa fa-print"></i> 012.345.6789<br>
                        <i class="fa fa-envelope"></i> <a href="mailto:mail@domainname.com">mail@domainname.com</a>
                    </address>
                </div>
            </div>
        </div>
    </div>
@endsection
