<?php
// Datos de conexión
$servidor = "localhost";
$usuario = "root";
$clave = "";
$base = "salonb";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $clave, $base);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>