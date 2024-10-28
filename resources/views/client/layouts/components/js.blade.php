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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js"></script>

<!-- Xử lý nút dropdown -->
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

<!-- Xử lý nút tăng giảm -->
<script>
    $(document).on('click', '.plus', function() {
        let input = $(this).siblings('.qty');
        let quantity = parseInt(input.val()) + 1;
        input.val(quantity);

        console.log(quantity);

        if (window.location.pathname === '/carts') {
            let id = $(this).data('id');
            let productVariantId = $(this).data('variant-id');
            updateCart(id, productVariantId, quantity)
        }
    });

    $(document).on('click', '.minus', function() {
        let input = $(this).siblings('.qty');
        let quantity = parseInt(input.val());

        if (quantity > 1) {
            input.val(quantity - 1);
            quantity -= 1
        } else {
            return
        }
        console.log(quantity);

        if (window.location.pathname === '/carts') {
            let id = $(this).data('id');
            let productVariantId = $(this).data('variant-id');
            updateCart(id, productVariantId, quantity)
        }
    });

    $(document).on('change', '.qty', function() {
        let value = parseInt($(this).val());

        if (isNaN(value) || value < 1) {
            $(this).val(1);
        }

        if (window.location.pathname === '/carts') {
            let id = $(this).data('id');
            let productVariantId = $(this).data('variant-id');
            let quantity = value;
            updateCart(id, productVariantId, quantity)
        }
    });

    $(document).on('keydown', '.qty', function(e) {
        if ($.inArray(e.key, ["Backspace", "ArrowLeft", "ArrowRight", "Delete"]) !== -1 ||
            (e.key >= "0" && e.key <= "9")) {
            return;
        }
        e.preventDefault();
    });
</script>

<!-- Lấy dữ liệu ajax đổ ra modal -->
<script>
    $(document).ready(function() {
        $('.view-product').click(function(e) {
            e.preventDefault();
            const productId = $(this).data('id');

            $.ajax({
                url: `/api/product/${productId}`,
                type: 'GET',
                success: function(data) {
                    $('#product_id').val(data.id);
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

                    $('#size-btn').empty();
                    data.sizes.forEach(item => {
                        $('#size-btn').append(
                            `<button class="btn-size mr-1"
                                data-size-id="${item.id}">${item.name}</button>`
                        );
                    });

                    $('#color-btn').empty();
                    data.colors.forEach(item => {
                        $('#color-btn').append(
                            `<button class="btn-color mr-1" data-color-id="${item.id}"
                                style="background-color:${item.code_color}"></button>`
                        );
                    });
                },
                error: function() {
                    alert('Không tìm thấy sản phẩm!');
                }
            });
        });
    });
</script>

<!-- Xử lý cập nhật và xóa giỏ hàng qua ajax -->
<script>
    $(document).on('click', '.remove-cart', function(e) {
        e.preventDefault();

        let href = $(this).attr('href');
        let data = {
            _token: '{{ csrf_token() }}',
            _method: "DELETE"
        };

        $.post(href, data, function(res) {
            load_cart();
            load_header();
        });
    });

    function updateCart(id, productVariantId, qty) {
        let data = {
            _token: '{{ csrf_token() }}',
            _method: 'PUT',
            quantity: qty,
            product_variant_id: productVariantId,
        };

        $.post(`{{ route('client.home') }}/carts/${id}`, data, function(res) {
            load_cart();
            load_header();
        });
    }

    function load_cart() {
        $.get("{{ route('client.carts.cart') }}", function(res) {
            $('.cart-view').html(res);
        });
    }
    load_cart();

    function load_header() {
        $.get("{{ route('client.header') }}", function(res) {
            $('.header-view').html(res);
        });
    }
    load_header();
</script>

<!-- Xử lý logic chọn màu và thêm giỏ hàng qua ajax -->
<script>
    $(document).ready(function() {
        let selectedColor = null;
        let selectedSize = null;

        $('#color-btn').on('click', '.btn-color', function(e) {
            e.preventDefault();
            $('.btn-color').removeClass('color-active');
            $(this).addClass('color-active');

            selectedColor = $(this).data('color-id');
            // fetchAvailableSizes(selectedColor);
        });

        $('#size-btn').on('click', '.btn-size', function(e) {
            e.preventDefault();
            $('.btn-size').removeClass('btn-active');
            $(this).addClass('btn-active');

            selectedSize = $(this).data('size-id');
            fetchAvailableColors(selectedSize);
        });

        $('#addToCart').on('submit', function(e) {
            e.preventDefault();
            let productId = $('#product_id').val();
            let quantity = $('#quantity').val();
            let dataCart = {
                product_id: productId,
                color_id: selectedColor,
                size_id: selectedSize,
                quantity: quantity,
                _token: '{{ csrf_token() }}',
            }

            if (selectedColor && selectedSize) {
                $.post("{{ route('client.carts.add') }}", dataCart, function(res) {
                    if (res.status_code == 200) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: res.message
                        });
                        quantity = $('#quantity').val(1);
                        selectedColor = null;
                        selectedSize = null;
                        $('#productModal').modal('hide');
                        load_header();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: res.message,
                        });
                    }
                })
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Vui lòng chọn phân loại!",
                });
            }
        });

        function fetchAvailableColors(sizeId) {
            let productId = $('#product_id').val();
            let dataColor = {
                product_id: productId,
                size_id: sizeId
            }
            $.get("{{ route('get.color') }}", dataColor, function(res) {
                $('.btn-color').hide();
                $('.btn-color').removeClass('color-active');
                res.forEach(item => {
                    $(`.btn-color[data-color-id="${item.color_id}"]`).show();
                    console.log(item.color_id);
                });
            });
        }
    });
</script>
