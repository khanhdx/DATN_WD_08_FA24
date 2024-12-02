import './bootstrap';

const isAdmin = document.body.dataset.role === 'admin';
const currentUserId = Number(document.body.dataset.userId);

const sendChatBtn = document.getElementById('send-btn');
const chatInput = document.getElementById('message-input');

const chatTitle = document.querySelector('.chat-title');
const chatBox = document.querySelector('.chat-box');
const listUser = document.querySelector('.list-user');
const inputScrollHeight = chatInput.scrollHeight;

let currentRoomId = null;
let count = 0;
let message;

if (isAdmin) {
    fetchUserInRooms();
    $('.chat-input').hide();

} else {
    axios.get('/chat-room-id').then((response) => {
        let chatRoom = response.data;
        joinRoom(chatRoom);
    });
}

// Danh sách user có trong phòng
function fetchUserInRooms() {
    listUser.innerHTML = "";
    axios.get('/api/chat-room')
        .then((response) => {
            const chatRooms = response.data;

            chatRooms.forEach((room) => {
                if (room.user.role === "Khách hàng") {
                    const btnElement = document.createElement('button');
                    const imgURL = `/storage/${room.user.user_image}`

                    btnElement.classList.add('user');

                    btnElement.innerHTML = `
                            <div class="img-cir img-50">
                                <img src="${room.user.user_image ? imgURL : ''}" alt="Img" class="profile-image">
                            </div>
                            <div class="container-name">
                                <span class="name">${room.user.name}</span>
                                <span class="container-name__text-message"></span>
                            </div>
                        `;

                    btnElement.dataset.roomId = room.id;

                    if (room.user.blocked_user === null) {
                        btnElement.onclick = () => fetchMessages(room.id, room.user.name, room.user.id);
                    } else {
                        btnElement.onclick = () => fetchMessages(room.id, room.user.name, room.user.id, true);
                    }

                    joinMultiRoom(room);

                    listUser.appendChild(btnElement);

                    // Hiển thị tin nhắn nhỏ trong list user
                    axios.get(`/api/messages/${room.id}`)
                        .then((response) => {
                            const messages = response.data;

                            if (messages.length) {
                                const lastMess = messages.at(-1);

                                lastMessage(room.id).innerText = lastMess.user_id === currentUserId ?
                                    `Bạn: ${lastMess.content}` : lastMess.content;

                                if (!lastMess.is_read) {
                                    const button = $(`[data-room-id=${room.id}]`);

                                    if (!button.hasClass('new-notification')) {
                                        button.append('<div class="new-notification"></div>');
                                    } else {
                                        button.find('.new-notification').remove();
                                    }

                                    lastMessage(room.id).classList.add('new-message');
                                }
                            }
                        });

                }
            });
        });
}

// Di chuyển user có tin nhắn mới lên đầu
function updateUserList(chatRoomId) {
    let userItem = document.querySelector(`[data-room-id="${chatRoomId}"]`);

    if (userItem) {
        listUser.removeChild(userItem);
        listUser.prepend(userItem);
    }
}

function lastMessage(chatRoomId) {
    const button = document.querySelector(`[data-room-id="${chatRoomId}"]`);
    return button.querySelector('.container-name__text-message');
}

function isRead(chatRoomId) {
    axios.post(`/api/messages/${chatRoomId}`)
        .then(() => {
            // console.log("Đã đọc");
        });
}

// Admin: tham gia nhiều phòng
function joinMultiRoom(chatRoomId = []) {
    window.Echo.leave(`chat.${chatRoomId.id}`);
    console.log("Phòng cũ: " + chatRoomId.id);

    window.Echo.join(`chat.${chatRoomId.id}`)
        .here(users => {
            users.forEach((user) => {
                if (user.id != currentUserId) {
                    $(`[data-room-id=${user.chat_room_id}] .img-cir`).append('<span class="status"></span>');
                    console.log('Admin in room:', users);
                }
            });
        })
        .joining(user => {
            $(`[data-room-id=${user.chat_room_id}] .img-cir`).append('<span class="status"></span>');
        })
        .leaving(user => {
            $(`[data-room-id=${user.chat_room_id}] .img-cir`).find('.status').remove();
        })
        // Lắng nghe user gửi chat tin nhắn
        .listen('MessageSent', (e) => {
            if (e.message.chat_room_id === currentRoomId) {
                updateUserList(currentRoomId);

                isRead(currentRoomId);
                lastMessage(currentRoomId).innerText = e.message.content;

                chatBox.appendChild(createChat(e.message.content, "incoming"));
                chatBox.scrollTo(0, chatBox.scrollHeight);
            } else {
                updateUserList(chatRoomId.id);
                lastMessage(chatRoomId.id).innerText = e.message.content;

                const button = $(`[data-room-id=${chatRoomId.id}]`);

                button.find('.new-notification').remove();
                if (!button.hasClass('new-notification')) {
                    button.append('<div class="new-notification"></div>');
                }

                lastMessage(chatRoomId.id).classList.add('new-message');
            }
        });
}

// User: tham gia 1 phòng duy nhất
function joinRoom(chatRoomId) {
    window.Echo.join(`chat.${chatRoomId}`)
        .here(users => {
            console.log('Users in room:', users);
        })
        .joining(user => {
            console.log('User tham gia:', user);
        })
        .leaving(user => {
            console.log('User leaving:', user);
        })
        // Lắng nghe admin gửi tin nhắn đến
        .listen('MessageSent', (e) => {
            chatBox.appendChild(createChat(e.message.content, "incoming"));
            chatBox.scrollTo(0, chatBox.scrollHeight);
            isRead(chatRoomId);
        });

    fetchMessages(chatRoomId);
}

/**
* @param {number} chatRoomId
*/
// Hàm lấy lịch sử tin nhắn
function fetchMessages(chatRoomId, nameUser = "", userId = "", isBlock = false) {
    chatBox.innerHTML = '';
    currentRoomId = chatRoomId;
    
    if (isAdmin) {
        nameUser ? chatTitle.textContent = `Chat: ${nameUser}` : "";
        isRead(chatRoomId);
    }

    axios.get(`/api/messages/${chatRoomId}`)
        .then((response) => {
            const messages = response.data;
            $('.chat-input').show();

            messages.forEach((message) => {
                currentUserId === message.user_id ?
                    chatBox.appendChild(createChat(message.content, "outgoing")) :
                    chatBox.appendChild(createChat(message.content, "incoming"));

                chatBox.scrollTo(0, chatBox.scrollHeight);
            });

            if (isAdmin) {
                $('#header-chat').find('.is-block').remove();
                $('#header-chat').find('.unblock').remove();
                if (isBlock) {
                    $('.chat-input').hide();
                    $('#header-chat').append(`<button data-id="${userId}" class="unblock material-symbols-rounded">do_not_disturb_off</button>`);
                } else {
                    $('.chat-input').show();
                    $('#header-chat').append(`<button data-id="${userId}" class="is-block material-symbols-rounded">do_not_disturb_on</button>`);
                }
            }
        });
}

function createChat(message, className) {
    const chatElement = document.createElement("div");
    chatElement.classList.add("chat", className);

    let chatContent = `<p>${message}</p>`;
    chatElement.innerHTML = chatContent;

    return chatElement;
}

function handleChat() {
    message = chatInput.value.trim();

    if (!message) return;
    chatInput.value = "";
    chatInput.style.height = `${inputScrollHeight}px`;

    chatBox.appendChild(createChat(message, "outgoing"));
    chatBox.scrollTo(0, chatBox.scrollHeight);

    axios.post('/send-message', {
        chat_room_id: currentRoomId,
        content: message
    }).then(response => {
        if (isAdmin) {
            lastMessage(currentRoomId).innerText = "Bạn: " + response.data.content;
            isRead(currentRoomId);
            updateUserList(currentRoomId);
        }
        // console.log('Message sent:', response.data.content);
    }).catch(error => {
        Swal.fire({
            icon: "error",
            title: "Block!",
            html: `
            <p style="font-size: 1.5rem;line-height: 20px;">
                Bạn đã vi phạm nội quy của chúng tôi<br>Vui lòng liên hệ để biết thêm chi tiết!!!
            </p>
            `,
            // footer: 'Vui lòng liên hệ để biết thêm chi tiết'
        });
    });
}

chatInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
        e.preventDefault();
        handleChat();
    }
});

chatInput.addEventListener("input", () => {
    chatInput.style.height = `${inputScrollHeight}px`;
    chatInput.style.height = `${chatInput.scrollHeight}px`;
});

sendChatBtn.addEventListener("click", handleChat);


$(document).on('click', '.user', function () {
    $('.user').removeClass('active-user');

    $(this).addClass('active-user');

    $(this).find('.new-notification').remove();
    $(this).find('.new-message').removeClass('new-message');
});

$(document).on('click', '.is-block', function () {
    let userID = $(this).data('id');

    Swal.fire({
        title: "Bạn muốn chặn user này?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Chặn!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post(`/api/block-user`, {
                user_id: userID
            }).then(response => {
                Swal.fire({
                    title: response.data.message,
                    icon: "success"
                });
                fetchUserInRooms();

                $('.chat-input').hide();
                $('#header-chat').find('.is-block').remove();
                $('#header-chat').append(`<button data-id="${userID}" class="unblock material-symbols-rounded">do_not_disturb_off</button>`);
            });
        }
    });
});

$(document).on('click', '.unblock', function () {
    let userID = $(this).data('id');

    Swal.fire({
        title: "Bạn muốn bỏ chặn user này?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Bỏ Chặn!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post(`/api/unblock-user`, {
                user_id: userID
            }).then(response => {
                Swal.fire({
                    title: response.data.message,
                    icon: "success"
                });
                fetchUserInRooms();

                $('.chat-input').show();
                $('#header-chat').find('.unblock').remove();
                $('#header-chat').append(`<button data-id="${userID}" class="is-block material-symbols-rounded">do_not_disturb_on</button>`);
            });
        }
    });
});