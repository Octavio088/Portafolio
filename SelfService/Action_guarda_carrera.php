<?php
   $nombre_carrera = $_POST['nombre_carrera'];
   $semestres =$_POST['semestres'];


  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }

  $database = 't15a_proyecto';
  $band = false;
  mysqli_select_db($link, $database);
  $cadQuery = "INSERT INTO carreras (nombre,semestres) VALUES ('$nombre_carrera','$semestres')";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);

      header("Location: Menu.php");

?>