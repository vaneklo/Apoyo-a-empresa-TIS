var formulario = document.getElementById('form');
var respuestaCorreo = document.getElementById('respuesta-correo');
var respuestaPassword = document.getElementById('respuesta-password');

formulario.addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('me diste un click');

    var datos = new FormData(formulario);

    console.log(datos);
    console.log(datos.get('correo'));
    console.log(datos.get('password'));

    fetch('../backend/iniciarSesion.php', {
        method: 'POST',
        body: datos
    })
        .then( res => res.json())
        .then( data => {
            console.log(data);

            if (data === 'correo no registrado en el sistema') {
                respuestaCorreo.innerHTML = `
                <div class="respuesta-correo">
                    <p>Correo no registrado en el sistema</p>
                </div>
                `
            }

            if (data === 'contrasena de estudiante incorrecta') {
                respuestaPassword.innerHTML = `
                <div class="respuesta-password">
                    <p>Contraseña de estudiante incorrecta</p>
                </div>
                `
            }

            if (data === 'contrasena de docente incorrecta') {
                respuestaPassword.innerHTML = `
                <div class="respuesta-password">
                    <p>Contraseña de docente incorrecta</p>
                </div>
                `
            }
        })
});