<?php
   $x = $_COOKIE['variable_x'];
   $nombre_materia = $_POST ['nombre_materia'];
   $clave_materia = $_POST ['clave_materia'];
   $numero_horas = $_POST['numero_horas'];
   $creditos = $_POST ['creditos'];
   $semestre = $_POST ['semestre'];
   $materia_anterior = $_POST['materia_anterior'];
   $area = $_POST ['area'];
   $carrera = $_POST ['carrera'];

  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }

  $database = 't15a_proyecto';
  $band = false;
  mysqli_select_db($link, $database);
  $cadQuery = "UPDATE materias SET nombre_materia = '$nombre_materia', clave_materia = '$clave_materia', numero_horas = '$numero_horas', creditos = '$creditos', semestre = '$semestre', materia_anterior = '$materia_anterior', area = '$area', carrera = '$carrera' WHERE materia = '$x'";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);
  setcookie("variable_x", "", time() - 3600);
  header("Location: TablaMateria.php");
?>