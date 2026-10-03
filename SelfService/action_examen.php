<?php
   $varMatricula = $_POST ['varMatricula'];
   $varNombre = $_POST ['nombreCompleto'];
   $carrera = $_POST['carrera'];
   $varGeneracion = $_POST ['generacion'];
   $varsemestre = $_POST ['semestre'];
   $varUsername = $_POST ['username'];
   $varPassword = $_POST ['password'];
   $varTipo = $_POST ['tipo_usuarios'];

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
  $cadQuery = "UPDATE usuarios SET matricula = '$varMatricula',nombre_completo ='$varNombre',carrera = '$carrera',generacion = '$varGeneracion',semestre ='$varsemestre',username ='$varUsername', password ='$varPassword',tipo = '$varTipo' where matricula = '$varMatricula'";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);
  setcookie("nombreUsuario", "", time() - 3600);
  setcookie("tipoUsuario", "", time() - 3600);
  setcookie("matri", "", time() - 3600);
  header("Location: index.php");
?>