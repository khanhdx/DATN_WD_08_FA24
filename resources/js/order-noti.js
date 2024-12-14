
// async function loadNotificationsFromDB() {
//     const response = await fetch('/api/notifications');
//     const data = await response.json();
//     notifications = data;
//     updateNotificationUI();
// }

// async function saveNotificationToDB(notification) {
//     await fetch('/api/notifications', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify(notification),
//     });
// }


// async function deleteNotificationFromDB(orderCode) {
//     await fetch(`/api/notifications/${orderCode}`, {
//         method: 'DELETE',
//     });
// }


// function updateNotificationUI() {
//     const maxNotifications = 3;
//     const notifiBox = document.querySelector('.notifi-dropdown .notifi__box');
//     const notifiTitle = document.querySelector('.notifi__title p');

//     // Giới hạn số lượng thông báo hiển thị
//     if (notifications.length > maxNotifications) {
//         notifications = notifications.slice(-maxNotifications);
//     }

//     notifiTitle.textContent = `Bạn có ${notifications.length} thông báo`;

//     notifiBox.innerHTML = ""; //

//     notifications.forEach(notification => {
//         const itemHTML = `
//             <div class="notifi__item" data-order-code="${notification.order_code}">
//                 <div class="bg-c1 img-cir img-40">
//                     <i class="zmdi zmdi-file-text"></i>
//                 </div>
//                 <div class="content">
//                     <h5>${notification.title}</h5>
//                     <p>Mã ${notification.order_code}</p>
//                     <button class="btn btn-primary confirm-order" data-order-code="${notification.order_code}"><a href="/admin/orders">Kiểm tra</a></button></br>
//                     <span class="date">${new Date(notification.created_at).toLocaleString()}</span>
//                 </div>
//             </div>
//         `;
//         notifiBox.insertAdjacentHTML('beforeend', itemHTML);
//     });
// }

// window.Echo.channel('order-noti')
//     .listen('OrderEvent', function (event) {
//         const newNotification = {
//             title: 'Đơn hàng mới',
//             order_code: `${event.slug}`,
//             created_at: `${event.created_at}`,
//         };

//         notifications.push(newNotification);
//         updateNotificationUI();
//         saveNotificationToDB(newNotification);
//     });

// document.querySelector('.notifi-dropdown .notifi__box').addEventListener('click', function (e) {
//     if (e.target.classList.contains('confirm-order')) {
//         const orderCode = e.target.dataset.orderCode;
//         notifications = notifications.filter(notification => notification.order_code !== orderCode);
//         deleteNotificationFromDB(orderCode);
//         updateNotificationUI();
//     }
// });

// // Tải thông báo khi trang được load
// document.addEventListener('DOMContentLoaded', loadNotificationsFromDB)


let notifications = [];

function loadNotificationsFromLocal() {
    const storedNotifications = JSON.parse(localStorage.getItem('notifications')) || [];
    notifications = storedNotifications.slice(-5);
    updateNotificationUI();
}

// Lưu thông báo mới vào localStorage
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
        const itemHTML = 
            <div class="notifi__item" data-order-code="${notification.orderCode}">
                <div class="bg-c1 img-cir img-40">
                    <i class="zmdi zmdi-file-text"></i>
                </div>
                <div class="content">
                    <h5>${notification.title}</h5>
                    <p>Mã ${notification.orderCode}</p>
                    <button class="btn btn-primary confirm-order" data-order-code="${notification.orderCode}"><a href="/admin/orders">Kiểm tra</a></button></br>
                    <span class="date">${notification.timeOrder}</span>
                </div>
            </div>
        ;
        notifiBox.insertAdjacentHTML('beforeend', itemHTML);
    });
}

window.Echo.channel('order-noti')
    .listen('OrderEvent', function (event) {
        const newNotification = {
            title: 'Đơn hàng mới',
            orderCode: ${event.slug},
            timeOrder: ${event.created_at}, 
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
    if (e.target.classList.contains('confirm-order')) {
        const orderCode = e.target.dataset.orderCode;
        notifications = notifications.filter(notification => notification.orderCode !== orderCode);
        deleteNotificationFromLocal(orderCode);
        updateNotificationUI();
    }
});

document.addEventListener('DOMContentLoaded', loadNotificationsFromLocal)