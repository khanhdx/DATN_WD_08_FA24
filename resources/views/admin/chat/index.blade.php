@extends('admin.layouts.master')

@section('title')
    Chat với khách hàng
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="list-user">

                </div>
            </div>
            <div class="col-8">
                <div class="message-chat">
                    <header id="header-chat">
                        <h4 class="chat-title">Chat:</h4>
                        
                    </header>
                    
                    <div class="chat-box">
                        <div class="text-welcome">Welcome to Admin Chat</div>
                    </div>

                    <div class="chat-input">
                        <textarea name="message" id="message-input" placeholder="Nhập nội dung tin nhắn..." required></textarea>

                        <span id="send-btn" class="material-symbols-rounded">send</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')

    @vite('resources/js/chat.js')
@endsection
