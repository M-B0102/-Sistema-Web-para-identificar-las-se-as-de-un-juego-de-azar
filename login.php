<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .form-control {
            background-color: #eaeaea; /* Fondo gris claro */
            border: 1px solid #ccc; /* Borde gris más oscuro */
            color: #333; /* Texto oscuro */
        }

        .form-control:focus {
            background-color: #e0e0e0;
            border-color: #999;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .form-label {
            color: #555;
        }

        .btn-primary {
            background-color: #4CAF50;
            border: none;
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-primary:active {
            background-color: #3d8c3a;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Autenticación</h2>
        
        <!-- Mensaje de error desde el servidor -->
        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalidcredentials'): ?>
            <div class="alert alert-danger text-center mt-3">
                Usuario o contraseña inválidos.
            </div>
        <?php endif; ?>

        <form method="POST" id="frmLogin" action="validation.php">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingresa tu usuario">
                <div id="alert-usuario" class="text-danger d-none">Por favor, ingresa tu usuario.</div>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Ingresa tu contraseña">
                <div id="alert-contrasena" class="text-danger d-none">Por favor, ingresa tu contraseña.</div>
                <!-- Mensaje de alerta para contraseña incorrecta -->
                <div id="alerta-pass" class="alert alert-warning d-none mt-2">
                    La contraseña debe tener entre 7 y 14 caracteres y solo puede contener letras, números y los caracteres especiales # y @.
                </div>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-primary" onclick="validarLogin();">Enviar</button>
            </div>
        </form>
    </div>

    <script>
        function validarLogin() {
            const usuario = document.getElementById('usuario').value.trim();
            const contrasena = document.getElementById('contrasena').value.trim();
            let valid = true;

            // Validación del usuario
            if (!usuario) {
                document.getElementById('alert-usuario').classList.remove('d-none');
                valid = false;
            } else {
                document.getElementById('alert-usuario').classList.add('d-none');
            }

            // Validación de la contraseña
            const regexPass = /^[a-zA-Z0-9#@]{7,14}$/;
            if (!regexPass.test(contrasena)) {
                document.getElementById('alerta-pass').classList.remove('d-none');
                valid = false;
            } else {
                document.getElementById('alerta-pass').classList.add('d-none');
            }

            // Si es válido, enviar el formulario
            if (valid) {
                document.getElementById('frmLogin').submit();
            }
        }
    </script>
</body>
</html>

