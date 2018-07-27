$(document).ready(function () {
    localStorage.clear()
    $('#enviarLogueo').click(function (e) {
        $('.sk-folding-cube').show();
        $('#formularioIngreso').hide();
        e.preventDefault();

        var data = {
            user: $('#username').val(),
            pwd: $('#password').val()

        };

        $.ajax({
            type: "post",
            url: "server/login.php",
            data: data,
            dataType: "json",
            success: function (response) {

                setTimeout(function () {
                    $('.sk-folding-cube').hide();
                    $('#formularioIngreso').show();

                }, 1000);
                if (!response) {
                    swal({
                        title: '¡Ups!',
                        text: 'Las credenciales ingresadas no son las correctas, por favor intenta de nuevo.',
                        type: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Entiendo',
                        closeOnConfirm: false
                    }, );
                } else {
                    if (response.tipo_usuario == "monitoreo") {
                        var nombre = response.nombre
                        localStorage.setItem('nombre', nombre)
                        var idusuario = response.idusuario
                        localStorage.setItem('idusuario', idusuario)
                        window.location.href = "monitoreo.html"
                    } else {
                        var idusuario = response.nombre
                        localStorage.setItem('nombre', nombre)
                        var idusuario = response.idusuario
                        localStorage.setItem('idusuario', idusuario)
                        window.location.href = "bot.html"
                    }
                }
            }
        });

    })
})