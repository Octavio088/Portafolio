<?php
$nombre_alumno = $_POST['nombre_alumno'];
$nombre_grupo = $_POST['grupo'];
$cal_u1 =  $_POST['cal_u1'];
$cal_u2 = $_POST['cal_u2'];
$cal_u3 = $_POST['cal_u3'];
$cal_uf = $_POST['cal_uf'];
if($_POST['cal_ee'] == -1){
    $cal_ee = -1;
    $cal_final = (($cal_u1*0.2)+($cal_u2*0.2)+($cal_u3*0.2)+($cal_uf*0.4)); // Calificacion FINAL
}else{
    $cal_ee = $_POST['cal_ee'];
    $cal_final = $cal_ee;
}
// conexion a base de datos  
  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }
  $database = 't15a_proyecto';
  mysqli_select_db($link, $database);
  $bandera = false;
  
  $cadQuery_corrobora = "SELECT * FROM calificaciones WHERE alumno = '$nombre_alumno' AND grupo = '$nombre_grupo'";
  $query_c = mysqli_query($link, $cadQuery_corrobora);
  for ($c = 0; $c < mysqli_num_rows($query_c); $c++) {
    $f = mysqli_fetch_array($query_c);
    $bandera = true;
  }
//------------------------------------------------------------------
    if($bandera == false){
        $cadQuery = "INSERT INTO calificaciones (alumno,grupo,u1,u2,u3,uf,Final,ee) VALUES ('$nombre_alumno','$nombre_grupo','$cal_u1','$cal_u2','$cal_u3','$cal_uf',$cal_final,'$cal_ee')";
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
        header("Location: Menu.php");
    }else{
        mysqli_close($link);
        echo "<script>alert('Este usuario ya esta en la db');</script>";
        header("Location: FormularioCalificaciones.php");
    }
    