<style>
    @keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
}

.notification-icon.shake {
    animation: shake 0.5s ease-in-out infinite;
}
</style>

<div class="header-button-item has-noti js-item-menu">
    {{-- <i class="zmdi zmdi-notifications"></i> --}}
    <i class="zmdi zmdi-notifications notification-icon"></i>
    <div class="notifi-dropdown js-dropdown">
        <div class="notifi__title">
            <p>Bạn có 0 thông báo</p>
        </div>
        <div class="notifi__box">
            
        </div>
        <div class="notifi__footer">
            <a href="#">Tất cả thông báo</a>
        </div>
    </div>
</div>