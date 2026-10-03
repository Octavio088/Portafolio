<?php
   $x = $_COOKIE['variable_x'];
   $clave_salon = $_POST ['clave_salon'];
   $nombre_salon = $_POST ['nombre_salon'];
   $ubicacion_fisica = $_POST['ubicacion_fisica'];

  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }

  $database = 't15a_proyecto';
  $band = false;
  mysqli_select_db($link, $database);
  $cadQuery = "UPDATE salones SET clave_salon ='$clave_salon', nombre_salon = '$nombre_salon', ubicacion_fisica = '$ubicacion_fisica' where salon = '$x'";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);
  setcookie("variable_x", "", time() - 3600);
  header("Location: TablaSalon.php");
?>