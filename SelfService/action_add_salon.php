<?php
   $clave_salon =$_POST['clave_salon'];
   $nombre_salon =$_POST['nombre_salon'];
   $edificio =$_POST['ubicacion_fisica'];


  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 't15a_proyecto';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }
  
  $band = false;
  mysqli_select_db($link, $database);
  $cadQuery = "INSERT INTO salones (clave_salon,nombre_salon,ubicacion_fisica) VALUES ('$clave_salon','$nombre_salon','$edificio')";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);

      header("Location: Menu.php");

?>