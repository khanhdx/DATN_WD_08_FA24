<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('assets/client/vendor/jquery.min.js') }}"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('assets/client/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/client/bootstrap/js/bootstrap-hover-dropdown.min.js') }}"></script>
<script src="{{ asset('assets/client/vendor/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/client/vendor/modernizr.custom.js') }}"></script>
<script src="{{ asset('assets/client/vendor/jquery.stellar.js') }}"></script>
<script src="{{ asset('assets/client/vendor/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/client/vendor/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/client/vendor/jquery.pricefilter.js') }}"></script>
<script src="{{ asset('assets/client/vendor/bxslider/jquery.bxslider.min.js') }}"></script>
<script src="{{ asset('assets/client/vendor/mediaelement-and-player.js') }}"></script>
<script src="{{ asset('assets/client/vendor/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/client/vendor/flexslider/jquery.flexslider-min.js') }}"></script>

<!-- Theme Initializer -->
<script src="{{ asset('assets/client/js/theme.plugins.js') }}"></script>
<script src="{{ asset('assets/client/js/theme.js') }}"></script>

<!-- Style Switcher -->
<script type="text/javascript" src="{{ asset('assets/client/style-switcher/js/switcher.js') }}"></script>

<script>
    var quantityInput = document.getElementById('quantity');
    var increaseButton = document.getElementById('increase');
    var decreaseButton = document.getElementById('decrease');

    // Xử lý khi nhấn nút Tăng
    increaseButton.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value) || 0;
        quantityInput.value = currentValue + 1;
    });

    // Xử lý khi nhấn nút Giảm
    decreaseButton.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value) || 0;
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    // Đảm bảo giá trị nhập vào là số hợp lệ
    quantityInput.addEventListener('input', (e) => {
        const value = e.target.value;
        if (!/^\d*$/.test(value)) {
            e.target.value = value.replace(/\D/g, ''); // Xóa ký tự không phải số
        }
    });
</script>

<script>
    // Chọn tất cả các thẻ <a> có class 'submitLink'
    const submitLinks = document.querySelectorAll('.submitLink');

    submitLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

            // Lấy giá trị của data-form để biết form nào cần submit
            const formId = this.getAttribute('data-form');
            const form = document.getElementById(formId);

            if (form) {
                form.submit();
            } else {
                console.error(`Form với id "${formId}" không tồn tại.`);
            }
        });
    });
</script>