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
    $(document).ready(function() {
        $('.plus').click(function() {
            let input = $(this).siblings('.qty');
            let currentValue = parseInt(input.val());
            input.val(currentValue + 1);
        });

        $('.minus').click(function() {
            let input = $(this).siblings('.qty');
            let currentValue = parseInt(input.val());
            if (currentValue > 1) {
                input.val(currentValue - 1);
            }
        });

        $('.qty').on('input', function() {
            let value = parseInt($(this).val());

            if (isNaN(value) || value < 1) {
                $(this).val(1);
            }
        });

        $('.qty').on('keydown', function(e) {
            if ($.inArray(e.key, ["Backspace", "ArrowLeft", "ArrowRight", "Delete"]) !== -1 ||
                (e.key >= "0" && e.key <= "9")) {
                return;
            }
            e.preventDefault();
        });
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

<script>
    $(document).ready(function() {
        // Ngăn dropdown mở ngay khi click nếu đang ở chế độ desktop (hover)
        $('.dropdownLink').on('click', function(e) {
            if ($(window).width() > 992) {
                window.location.href = $(this).attr('href'); // Điều hướng ngay khi click.
            }
        });

        // Đảm bảo dropdown hoạt động tốt trên mobile (dùng click)
        $('.dropdown').on('mouseenter', function() {
            if ($(window).width() > 992) {
                $(this).addClass('open');
            }
        }).on('mouseleave', function() {
            $(this).removeClass('open');
        });
    });
</script>

{{-- Dùng ajax để hiển thị chi tiết sản phẩm lên modal --}}
<script>
    $(document).ready(function() {
        $('.view-product').click(function(e) {
            e.preventDefault(); // Ngăn chặn reload trang

            const productId = $(this).data('id');

            $.ajax({
                url: `/api/product/${productId}`,
                type: 'GET',
                success: function(data) {
                    $('#product-name').text(data.name);
                    $('#product-sku').text(data.SKU);
                    $('#product-description').text(data.description);
                    $('#product-content').text(data.content);
                    $('#product-price-regular').text(data.price_regular);

                    $('#category-name').text(data.category.name);
                    $('#category-type').text(data.category.type);

                    if (data.image) {
                        $('#product-image').attr('src', `${data.image}`);
                    }
                },
                error: function() {
                    alert('Không tìm thấy sản phẩm!');
                }
            });
        });
    });
</script>
