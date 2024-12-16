let notifications = [];

function loadNotificationsFromLocal() {
    const storedNotifications = JSON.parse(localStorage.getItem('notifications')) || [];
    notifications = storedNotifications.slice(-5);
    updateNotificationUI();
}

function saveNotificationsToLocal(notification) {
    let storedNotifications = JSON.parse(localStorage.getItem('notifications')) || [];
    storedNotifications.push(notification);
    localStorage.setItem('notifications', JSON.stringify(storedNotifications));
}

function deleteNotificationFromLocal(orderCode) {
    let storedNotifications = JSON.parse(localStorage.getItem('notifications')) || [];
    storedNotifications = storedNotifications.filter(notification => notification.orderCode !== orderCode);
    localStorage.setItem('notifications', JSON.stringify(storedNotifications));
}

function toggleNotificationShake() {
    const notificationIcon = document.querySelector('.notification-icon');

    if (notifications.length > 0) {
        notificationIcon.classList.add('shake'); // Thêm hiệu ứng rung
    } else {
        notificationIcon.classList.remove('shake'); // Xóa hiệu ứng rung
    }
}

function updateNotificationUI() {
    const maxNotifications = 3;
    const notifiBox = document.querySelector('.notifi-dropdown .notifi__box');
    const notifiTitle = document.querySelector('.notifi__title p');

    if (notifications.length > maxNotifications) {
        notifications = notifications.slice(-maxNotifications);
    }

    notifiTitle.textContent = `Bạn có ${notifications.length} thông báo`;

    notifiBox.innerHTML = ""; 

    notifications.forEach(notification => {
        const itemHTML = `
            <div class="notifi__item" data-order-code="${notification.orderCode}">
                <div class="bg-c1 img-cir img-40">
                    <i class="zmdi zmdi-file-text"></i>
                </div>
                <div class="content">
                    <h5>${notification.title}</h5>
                    <p>Mã ${notification.orderCode}</p>
                    <button class="btn btn-primary confirm-order" data-order-code="${notification.orderCode}">
                       <a href="/admin/orders">Kiểm tra</a>
                    </button><br>
                    <span class="date">${notification.timeOrder}</span>
                </div>
            </div>
        `;
        notifiBox.insertAdjacentHTML('beforeend', itemHTML);

        toggleNotificationShake();
    });
}

window.Echo.channel('order-noti')
    .listen('OrderEvent', function (event) {
        const newNotification = {
            title: 'Đơn hàng mới',
            orderCode: `${event.slug}`,
            timeOrder: `${event.created_at}`, 
        };

        notifications.push(newNotification);

        updateNotificationUI(); 
        saveNotificationsToLocal(newNotification);
    });


document.addEventListener('click', function (e) {
    if (e.target.matches('.notifi__item, .notifi__item *')) {
        const notifiItem = e.target.closest('.notifi__item');
        const orderCode = notifiItem.getAttribute('data-order-code');
        console.log(orderCode);
        
        deleteNotificationFromLocal(orderCode);
    }
});


document.querySelector('.notifi-dropdown .notifi__box').addEventListener('click', function (e) {
    if (e.target.closest('.confirm-order')) {
        const orderCode = e.target.closest('.confirm-order').dataset.orderCode;
        console.log(orderCode);
        
        notifications = notifications.filter(notification => notification.orderCode !== orderCode);
        deleteNotificationFromLocal(orderCode);
        updateNotificationUI();
        // window.location.href = '/admin/orders';
    }
});

document.addEventListener('DOMContentLoaded', loadNotificationsFromLocal)
