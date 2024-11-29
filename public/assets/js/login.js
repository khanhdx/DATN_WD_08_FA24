// Xử lý login và logut qua ajax
$(document).ready(function() {
    var wrapper = $('.login-wrapper');

    // $('#toggle_button').hide();

    $(document).on('click', '.login > a', function(e) {
        e.preventDefault();
        
        if (wrapper.hasClass('open')) {
            wrapper.addClass('open');
        } else {
            wrapper.removeClass('open');
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
                    // const Toast = Swal.mixin({
                    //     toast: true,
                    //     position: "top",
                    //     showConfirmButton: false,
                    //     timer: 2500,
                    //     timerProgressBar: true,
                    //     didOpen: (toast) => {
                    //         toast.onmouseenter = Swal.stopTimer;
                    //         toast.onmouseleave = Swal.resumeTimer;
                    //     }
                    // });
                    // Toast.fire({
                    //     icon: "success",
                    //     title: `<span style="font-size: 1.5rem">${res.message}</span>`,
                    //     width: 280
                    // });
                    window.location.href = "/";
                    // wrapper.removeClass('open');
                    // load_header();
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