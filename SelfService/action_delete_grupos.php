<?php
     $id_grupo = $_POST ['grupo'];
     
     $server = 'localhost';
     $user = 'root';
     $pass = '';
     $database = 'mysql';
     $link = mysqli_connect($server, $user, $pass, $database);
   
     if(!$link) { header("Location: Login.php"); }
   
     $database = 't15a_proyecto';
     mysqli_select_db($link, $database);
     $cadQuery = "DELETE FROM grupos WHERE grupo = '$id_grupo'";
     $query = mysqli_query($link, $cadQuery);
     mysqli_close($link);
     header("Location: Tabla_delete_grupo.php");
?>