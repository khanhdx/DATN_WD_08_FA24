// Xử lý nút tăng giảm
$(document).on('click', '.plus', function() {
    let input = $(this).siblings('.qty');
    let quantity = parseInt(input.val()) + 1;
    input.val(quantity);

    // console.log(quantity);

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
    // console.log(quantity);

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