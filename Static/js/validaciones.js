function validacion() {
    let isValid = true;

    // Obtener campos
    const usuario = document.getElementById("usuario");
    const contrasena = document.getElementById("contrasena");

    // Obtener mensajes de alerta
    const alertaUsuario = document.getElementById("alert-usuario");
    const alertaContrasena = document.getElementById("alert-contrasena");
    const alertaPass = document.getElementById("alerta-pass");

    // Validar usuario
    if (usuario.value.trim() === "") {
        alertaUsuario.classList.remove("d-none");
        usuario.classList.add("is-invalid");
        isValid = false;
    } else {
        alertaUsuario.classList.add("d-none");
        usuario.classList.remove("is-invalid");
        usuario.classList.add("is-valid");
    }

    // Validar contraseña
    const passwordRegex = /^[A-Za-z0-9#@]{7,14}$/; // Solo letras, números, # y @, de 7 a 14 caracteres
    if (contrasena.value.trim() === "") {
        alertaContrasena.classList.remove("d-none");
        contrasena.classList.add("is-invalid");
        isValid = false;
    } else {
        alertaContrasena.classList.add("d-none");
        contrasena.classList.remove("is-invalid");
        contrasena.classList.add("is-valid");
    }

    // Validar que la contraseña cumpla con la expresión regular
    if (!passwordRegex.test(contrasena.value)) {
        alertaPass.classList.remove("d-none"); // Mostrar alerta si no cumple el patrón
        contrasena.classList.add("is-invalid");
        isValid = false;
    } else {
        alertaPass.classList.add("d-none"); // Ocultar alerta si la contraseña es válida
        contrasena.classList.remove("is-invalid");
        contrasena.classList.add("is-valid");
    }

    // Si los campos están completos y la contraseña es válida, enviar formulario
    if (isValid) {
        document.frm1.submit();
    }
}
