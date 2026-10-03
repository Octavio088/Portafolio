<?php
// Obtener los valores de los campos del formulario
$x = isset($_POST['chamaco']) ? $_POST['chamaco'] : 'No se proporcionó alumno';
$cal_u1 = isset($_POST['u1']) ? $_POST['u1'] : 'No se proporcionó unidad 1';
$cal_u2 = isset($_POST['u2']) ? $_POST['u2'] : 'No se proporcionó unidad 2';
$cal_u3 = isset($_POST['u3']) ? $_POST['u3'] : 'No se proporcionó unidad 3';
$cal_uf = isset($_POST['uf']) ? $_POST['uf'] : 'No se proporcionó examen final';

if(empty($_POST ['extra'])){
    $cal_ee= NULL;
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
  $cadQuery = "UPDATE calificaciones SET u1 = '$cal_u1', u2 ='$cal_u2', u3= '$cal_u3', uf= '$cal_uf', Final= '$cal_final', ee='$cal_ee' where alumno = '$x'";
  $query = mysqli_query($link, $cadQuery);

  mysqli_close($link);
//  setcookie("variable_x", "", time() - 3600);
header("Location: menu.php");
?>

