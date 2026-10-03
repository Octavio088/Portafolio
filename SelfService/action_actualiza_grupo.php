<?php
   $x = $_COOKIE['variable_x'];

   $clave = $_POST ['clave_grupo'];
   $profesor = $_POST ['profesor'];
   $salon = $_POST['salon'];

  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }

  $database = 't15a_proyecto';
  $band = false;
  mysqli_select_db($link, $database);
  $cadQuery = "UPDATE grupos SET clave_grupo = '$clave',maestro ='$profesor',salon= '$salon' where grupo = '$x'";
  $query = mysqli_query($link, $cadQuery);
  mysqli_close($link);
  setcookie("variable_x", "", time() - 3600);
  header("Location: TablaGrupo.php");
?>