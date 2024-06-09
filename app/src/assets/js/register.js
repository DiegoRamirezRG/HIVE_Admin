jQuery(document).ready($ => {
    $("#formSingUp").validate({
        errorClass: "jquery-error",
        rules: {
            username: {
                required: true
            },
            userlastname: {
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            username: {
                required: 'Name cannot be empty'
            },
            userlastname: {
                required: 'Last name cannot be empty'
            },
            email: {
                required: 'Email cannot be empty',
                email: 'Email must be valid'
            }
        },
        submitHandler: (form, event) => {
            event.preventDefault();

            if($("#password").val() == '' || $("#confirmPassword").val() == ''){
                return Swal.fire({
                    title: 'Passsword or confirm password cannot be empty',
                    icon: 'error'
                });
            }

            if($("#password").val() != $("#confirmPassword").val()){
                return Swal.fire({
                    title: 'Passwords do not match',
                    icon: 'error'
                });
            }

            var data = `method=register&action=register&type=singUp&name=${$("#username").val()}&lastname=${$("#userlastname").val()}&extraname=${$("#userextraname").val()}&email=${$("#email").val()}&password=${$("#password").val()}`;

            $.ajax({
                type: 'POST',
                url: 'index.php',
                data: data,
                beforeSend: () => {
                    $("#loading").show();
                }
            }).done((res) => {
                const { success, message } = JSON.parse(res);
                if(success){
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
            })
        }
    });
});