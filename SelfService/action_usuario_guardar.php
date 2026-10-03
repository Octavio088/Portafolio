<?php
   $varMatricula = $_POST ['varMatricula'];
   $varNombre = $_POST ['varNombre'];
   $varCarrera = $_POST ['varCarrera'];
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
  $cadQuery = "INSERT INTO usuarios VALUES ('$varMatricula','$varNombre','$varCarrera', '$varGeneracion','$varsemestre','$varUsername','$varPassword','$varTipo')";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);

      header("Location: Menu.php");

?>