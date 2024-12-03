<?php
session_start();
$servidor="localhost";  
$usuario="root";        
$clave="";             
$base="salonb";       

// Conexión a la base de datos
$conn = new mysqli($servidor, $usuario, $clave, $base);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Consultar en la base de datos
$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena='$contrasena'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuario y contraseña correctos
    // Redirigir o realizar acción después de inicio de sesión exitoso
    header("Location: dashboard.php");
} else {
    // Si no se encuentra el usuario o la contraseña es incorrecta
    $_SESSION['error'] = "Usuario o contraseña incorrectos"; // Guardar mensaje de error en sesión
    header("Location: index.php"); // Redirigir de nuevo al formulario
}

$conn->close();
?>
