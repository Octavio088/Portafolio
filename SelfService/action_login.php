<?php
  // Capturar valores de POST
  $nombreUsuario = $_POST['varUser'];
  $valorContrasenia = $_POST['varPass'];
  $contra_encript  = md5($valorContrasenia);
  session_start();
  $message = '';
  $bandera = 0;
  if ( isset($_POST['securityCode']) && ($_POST['securityCode']!="")){
	  if(strcasecmp($_SESSION['captcha'], $_POST['securityCode']) != 0){
		  $message = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.";
		  $bandera = 0; 
		  setcookie("bandera", $bandera);
	  }else{
		  $message = "Ha introducido el código de seguridad correcto.";
		  $bandera = 1; 
		  setcookie("bandera", $bandera);
	  }
  } else {
	  $message = "Introduzca el código de seguridad.";
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
  if($bandera == 1){
  $cadQuery = "SELECT * FROM usuarios WHERE username = '$nombreUsuario' AND password = '$contra_encript'";
  $query = mysqli_query($link, $cadQuery);
  for ($c = 0; $c < mysqli_num_rows($query); $c++) {
    $f = mysqli_fetch_array($query);
    
    $matri = $f[0];
    $nombreUsuario = $f[1];
    $tipoUsuario = $f[7];
    $band = true;
  }
  mysqli_close($link);

  if ($band) {
    // Crear las cookies
    setcookie("matri", $matri);
    setcookie("nombreUsuario", $nombreUsuario);
    setcookie("tipoUsuario", $tipoUsuario);
    // Enviar al menu
    header("Location: Menu.php");
  }
  else { header("Location: index.php"); }
  }else{
    header("Location: index.php");
  }
  
?>