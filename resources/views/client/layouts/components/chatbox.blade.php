@if (Auth::check())
    <div id="style-switcher">
        <div id="toggle_button"> <span class="material-symbols-rounded">mode_comment</span> </div>
        <div id="style-switcher-menu">
            <h4 class="text-center">Chat</h4>
            <div class="chat-box">

            </div>

            <div class="chat-input">
                <textarea name="message" id="message-input" placeholder="Nhập nội dung tin nhắn..." required></textarea>

                <span id="send-btn" class="material-symbols-rounded">send</span>
            </div>
        </div>
    </div>

    @vite('resources/js/chat.js')
@endif
