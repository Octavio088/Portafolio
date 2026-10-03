<?php
   $x = $_COOKIE['variable_x'];
   $varMatricula = $_POST ['varMatricula'];
   $varNombre = $_POST ['varNombre'];
   $carrera = $_POST['varCarrera'];
   $varGeneracion = $_POST ['varGeneracion'];
   $varsemestre = $_POST ['varsemestre'];
   $varUsername = $_POST ['varUsername'];
   $varPassword = $_POST ['varPassword'];
   $varTipo = $_POST ['varTipo'];

   $varPassword = md5($varPassword);

  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }

  $database = 't15a_proyecto';
  $band = false;
  mysqli_select_db($link, $database);
  $cadQuery = "UPDATE usuarios SET matricula = '$varMatricula',nombre_completo ='$varNombre',carrera = '$carrera',generacion = '$varGeneracion',semestre ='$varsemestre',username ='$varUsername', password ='$varPassword',tipo = '$varTipo' where matricula = '$x'";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);
  setcookie("variable_x", "", time() - 3600);
  header("Location: tabla_update.php");
?>