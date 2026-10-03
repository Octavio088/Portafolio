<?php
   $x = $_COOKIE['variable_x']; 
   $cal_u1 = $_POST['cal_u1']; // unidad 1
   $cal_u2 = $_POST ['cal_u2']; // unidad 2
   $cal_u3 = $_POST ['cal_u3']; // unidad 3
   $cal_uf = $_POST['cal_uf']; // examen final 
   $extra = $_POST ['extra'];
   $clave_grupo = $_POST['nombre_grupo'];
   
   if($extra == -1){
    $cal_ee = -1;
    $cal_final = (($cal_u1*0.2)+($cal_u2*0.2)+($cal_u3*0.2)+($cal_uf*0.4)); // Calificacion FINAL
   }else{
    $cal_ee = $_POST ['extra']; // EXTRA
    $cal_final = $cal_ee;
   }
   
  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }

  $database = 't15a_proyecto';
  $band = false;

  mysqli_select_db($link, $database);
  $cadQuery = "UPDATE calificaciones SET u1 = '$cal_u1', u2 ='$cal_u2', u3= '$cal_u3', uf= '$cal_uf', Final= '$cal_final', ee='$cal_ee' where alumno = '$x' AND grupo = $clave_grupo";
  $query = mysqli_query($link, $cadQuery);

  $cadQuery2= "UPDATE calificaciones SET
  u1 = CASE WHEN u1 = -1 THEN NULL ELSE u1 END,
  u2 = CASE WHEN u2 = -1 THEN NULL ELSE u2 END,
  u3 = CASE WHEN u3 = -1 THEN NULL ELSE u3 END,
  uf = CASE WHEN uf = -1 THEN NULL ELSE uf END,
  Final = CASE WHEN Final = -1 THEN NULL ELSE Final END,
  ee = CASE WHEN ee = -1 THEN NULL ELSE ee END;";
  $query_2 = mysqli_query($link, $cadQuery2);
  
  mysqli_close($link);
  setcookie("variable_x", "", time() - 3600);
  header("Location: Tabla_actualiza_calificaciones.php");
?>