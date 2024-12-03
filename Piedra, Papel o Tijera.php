<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rock, Paper, Scissors - Menú</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
        }

        .container {
            text-align: center;
            padding: 20px;
        }

        .title-image {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
        }

        .menu {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .menu-button {
            display: block;
            width: 150px;
            height: auto;
            cursor: pointer;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #ccc;
        }

        /* Estilos para el panel de configuración */
        .config-panel {
            display: none;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            color: #000;
            width: 300px;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 999;
        }

        .btn-submit {
            background-color: #5c5af5;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #4a49c5;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Imagen centrada en la parte superior -->
        <img src="Botones/Logo.jpg" alt="Rock, Paper, Scissors II" class="title-image">

        <!-- Menú de botones -->
        <div class="menu">
            <a href="#" id="boton1">
                <img src="Botones/Boton1.jpg" alt="Jugador vs IA" class="menu-button">
            </a>
            <a href="puntajes.php">
                <img src="Botones/Boton3.jpg" alt="Consultar Estadísticas" class="menu-button">
            </a>
            <img src="Botones/Boton5.jpg" alt="Consultar Configuración" class="menu-button" onclick="showConfigPanel()">
            <img src="Botones/Boton4.jpg" alt="Salir" class="menu-button" onclick="window.location.href='logout.php';">
        </div>

        <footer>
            <img src="Botones/LPHN.jpg" alt="BY LPHN" class="footer-image">
        </footer>
    </div>

    <!-- Panel de configuración -->
    <div class="overlay" id="overlay" onclick="closeConfigPanel()"></div>
    <div class="config-panel" id="configPanel">
        <h2>Seleccionar Dificultad</h2>
        <form id="dificultadForm">
            <label for="dificultad">Dificultad:</label>
            <select id="dificultad" name="dificultad">
                <option value="facil">Fácil</option>
                <option value="normal" selected>Normal</option>
                <option value="dificil">Difícil</option>
            </select>
            <br><br>
            <button type="submit" class="btn-submit">Aplicar</button>
            <button type="button" class="btn-submit" onclick="closeConfigPanel()">Cerrar</button>
        </form>
    </div>

    <script>
        // Mostrar el panel de configuración
        function showConfigPanel() {
            document.getElementById('configPanel').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        // Cerrar el panel de configuración
        function closeConfigPanel() {
            document.getElementById('configPanel').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        // Manejo del formulario
        document.getElementById('dificultadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const dificultad = document.getElementById('dificultad').value;

            fetch('/set_dificultad', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ dificultad }),
            })
            .then(response => response.json())
            .then(data => {
                alert(data.mensaje || 'Dificultad configurada correctamente');
                closeConfigPanel();
            });
        });

        // Verificar disponibilidad de cámara
        document.getElementById('boton1').addEventListener('click', function(event) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function() {
                    fetch('/iniciar_juego', { method: 'POST' });
                })
                .catch(function() {
                    alert('Este dispositivo no cuenta con una cámara web. No se puede iniciar el juego.');
                    event.preventDefault();
                });
        });
    </script>
</body>
</html>
