<?php
   $x = $_COOKIE['variable_x'];
   $tipo_horario = $_POST ['tipo_horario'];
   $hora_lunes = $_POST['hora_lunes'];
   $hora_martes = $_POST ['hora_martes'];
   $hora_miercoles = $_POST ['hora_miercoles'];
   $hora_jueves = $_POST['hora_jueves'];
   $hora_viernes = $_POST ['hora_viernes'];

  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }

  $database = 't15a_proyecto';
  $band = false;
  mysqli_select_db($link, $database);
  $cadQuery = "UPDATE horarios SET tipo = '$tipo_horario', hora_lunes = '$hora_lunes', hora_martes = '$hora_martes', hora_miercoles = '$hora_miercoles', hora_jueves = '$hora_jueves', hora_viernes = '$hora_viernes' WHERE horario = '$x'";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);
  setcookie("variable_x", "", time() - 3600);
  header("Location: TablaHorario.php");