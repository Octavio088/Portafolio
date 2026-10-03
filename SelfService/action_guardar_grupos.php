<?php
$clave_grupo = $_POST['clave_grupo'];
$profesor =$_POST['profesor'];
$materia = $_POST['materia'];
$horario =$_POST['horario'];
$salon = $_POST['salon'];
// conexion a base de datos  
  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }
  $database = 't15a_proyecto';
  mysqli_select_db($link, $database);
//------------------------------------------------------------------
  $cadQuery = "INSERT INTO grupos (clave_grupo,maestro,materia,horario,salon) VALUES ('$clave_grupo','$profesor','$materia','$horario','$salon')";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);

  header("Location: Menu.php");