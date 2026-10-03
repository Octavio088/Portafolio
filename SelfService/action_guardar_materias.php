<?php
   $nombremateria = $_POST ['nombre_materia'];
   $clavemateria =$_POST['clave_materia'];
   $numerohoras =$_POST['numero_horas'];
   $creditos =$_POST['creditos'];
   $semestre =$_POST['semestre'];
   $materia_anterior =$_POST['materia_anterior'];
   $area =$_POST['area'];
   $carrera =$_POST['carrera'];


  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }

  $database = 't15a_proyecto';
  $band = false;
  mysqli_select_db($link, $database);
  $cadQuery = "INSERT INTO materias (nombre_materia,clave_materia,numero_horas,creditos,semestre,materia_anterior,area,carrera) VALUES ('$nombremateria','$clavemateria','$numerohoras','$creditos','$semestre','$materia_anterior','$area','$carrera')";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);

      header("Location: Menu.php");

?>