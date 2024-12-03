// Xử lý login và logut qua ajax
$(document).ready(function() {
    var wrapper = $('.login-wrapper');

    $(document).on('click', '.login > a', function(e) {
        e.preventDefault();
        
        if (wrapper.hasClass('open')) {
            wrapper.removeClass('open');
        } else {
            wrapper.addClass('open');
        }
    });

    $('#form-login').submit(function(e) {
        e.preventDefault();
        let data = $(this).serialize();

        $('#errorEmail').html('');
        $('#errorPassword').html('');

        $.post("/loginAjax", data)
            .done(function(res) {
                if (res.admin) {
                    window.location.href = res.admin;
                } else {
                    window.location.reload();
                }
            })
            .fail(function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorEmail = errors.email;
                    let errorPassword = errors.password;

                    $('#errorEmail').html(errorEmail);
                    $('#errorPassword').html(errorPassword);
                } else {
                    $('#errorEmail').html(xhr.responseJSON.message);
                }
            });
    });

})