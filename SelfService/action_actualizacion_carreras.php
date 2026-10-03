<?php
   $x = $_COOKIE['variable_x'];
   $varCarrera = $_POST ['varCarrera'];
   $varsemestres = $_POST['varsemestres'];

  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }

  $database = 't15a_proyecto';
  $band = false;
  mysqli_select_db($link, $database);
  $cadQuery = "UPDATE carreras SET nombre ='$varCarrera',semestres = '$varsemestres' where carrera = '$x'";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);
  setcookie("variable_x", "", time() - 3600);
  header("Location: TablaCarrera.php");
?>