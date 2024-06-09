jQuery(document).ready($ => {
    $("#formAuthentication").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
        },
        messages: {
            email: {
                required: 'Email cannot be empty',
                email: 'Email must be valid'
            },
        },
        submitHandler: (form, event) => {
            event.preventDefault();

            if($("#password").val() == ''){
                return Swal.fire({
                    title: 'Passsword cannot be empty',
                    icon: 'error'
                });
            }

            var data = `method=login&action=login&type=signIn&email=${$("#email").val()}&password=${$("#password").val()}`;

            $.ajax({
                type: 'POST',
                url: 'index.php',
                data: data,
                beforeSend: () => {
                    $("#loading").show();
                }
            }).done((res) => {
                const { success, message, data } = JSON.parse(res);
                if(success){
                    $.cookie('user_id', data, { expires: 30 });
                    let timerInterval;
                    Swal.fire({
                        title: message,
                        html: "Redirecting in <b></b> milliseconds.",
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                                timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = '/';
                        }
                    });
                }
            }).fail((err) => {
                const { message, error } = JSON.parse(err.responseText);
                Swal.fire({
                    title: message,
                    text: error,
                    icon: 'error'
                });
            }).always(() => {
                $("#loading").hide();
            });
        }
    })
});