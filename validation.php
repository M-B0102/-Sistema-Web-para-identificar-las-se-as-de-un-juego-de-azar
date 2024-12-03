<?php include 'Static/connect/db.php'?>
<?php include 'includes/header.php'?>
<?php 
     
session_start();

$user = $_POST['usuario'];
$password = $_POST['contrasena'];
$sql = "SELECT * FROM usuarios WHERE  usuario = '$user' and contrasena = '$password';";
$execute = mysqli_query($conn,$sql); 

$row = mysqli_fetch_assoc($execute);

if(($row['usuario']==$user) &&($row['contrasena']==$password)){
 $_SESSION['usuario']= $user;
     header("Location: Piedra, Papel o Tijera.php");

}else{
    header("Location: login.php");

     }

?>