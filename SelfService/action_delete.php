<?php
     $varMatricula = $_POST ['id'];
     
     $server = 'localhost';
     $user = 'root';
     $pass = '';
     $database = 'mysql';
     $link = mysqli_connect($server, $user, $pass, $database);
   
     if(!$link) { header("Location: Login.php"); }
   
     $database = 't15a_proyecto';
     $band = false;
     mysqli_select_db($link, $database);
     $cadQuery = "DELETE FROM usuarios WHERE matricula = '$varMatricula'";
     $query = mysqli_query($link, $cadQuery);
     mysqli_close($link);
     header("Location: tabla_delete.php");
?>