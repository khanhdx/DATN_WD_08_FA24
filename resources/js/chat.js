import './bootstrap';

const isAdmin = document.body.dataset.role === 'admin';
const userId = document.body.dataset.userId;
const sendChatBtn = document.getElementById('send-btn');
const chatInput = document.getElementById('message-input');
const chatTitle = document.querySelector('.chat-title');
const chatBox = document.querySelector('.chat-box');
const listUser = document.querySelector('.list-user');

const inputScrollHeight = chatInput.scrollHeight;

let currentRoomId = null;
let message;

if (isAdmin) {
    fetchChatRooms();
} else {
    joinRoom(chatRoomId);
}

function fetchChatRooms() {
    axios.get('/api/chat-rooms').then((response) => {
        const users = response.data;

        users.forEach((user) => {

            const aElement = document.createElement('button');
            const imgUrl = `/storage/${user.user_image}`

            // chatTitle.textContent = `Chat: ${user.name}`;

            aElement.classList.add('user')
            aElement.innerHTML = `
                <div class="image img-cir img-60">
                    <img src="${user.user_image ? imgUrl : ''}" alt="Img">
                </div>
                <span class="name">${user.name}</span>
            `;

            aElement.dataset.roomId = user.rooms.id;
            aElement.onclick = () => joinRoom(user.rooms.id);
            listUser.appendChild(aElement);
        });
    });
}

function joinRoom(chatRoomId) {
    if (currentRoomId) {
        window.Echo.leave(`chat.${currentRoomId}`);
        console.log("Phòng cũ: " + currentRoomId);
    }

    currentRoomId = chatRoomId;

    console.log("Phòng mới: " + currentRoomId);

    chatBox.innerHTML = '';

    window.Echo.join(`chat.${chatRoomId}`)
        .here(users => {
            console.log('Users in room:', users);
        })
        .joining(user => {
            console.log('User joined:', user);
        })
        .leaving(user => {
            console.log('User leaving:', user);
        })
        .listen('MessageSent', (e) => {
            console.log(e.message.content);
            chatBox.appendChild(createChat(e.message.content, "incoming"));
            chatBox.scrollTo(0, chatBox.scrollHeight);
        });

    // Lấy lịch sử tin nhắn
    fetchMessages(chatRoomId);
}

/**
    * Hàm lấy tin nhắn trong phòng
    * @param {number} chatRoomId
   */
function fetchMessages(chatRoomId) {
    axios.get(`/api/messages/${chatRoomId}`)
        .then((response) => {
            const messages = response.data;

            messages.forEach((message) => {
                userId != message.user_id ?
                    chatBox.appendChild(createChat(message.content, "incoming")) :
                    chatBox.appendChild(createChat(message.content, "outgoing"));
            });
            chatBox.scrollTo(0, chatBox.scrollHeight);
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
        console.log('Message sent:', response.data);
    }).catch(error => {
        console.error('Có lỗi:', error);
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