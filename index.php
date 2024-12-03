<?php include 'Static/connect/db.php'?>
<?php include 'includes/header.php'?>
<?php 
       session_start();
        
       $user = $_SESSION['usuario'];

       if(isset($_SESSION['usuario'])){
            echo "<h1>Iniciaste sesion como:". $user. "</h1>";
            ?>
              <a href="logout.php">Cerrar Sesion</a>
        <?php
       }else{
                header("Location:login.php");
            }

?>