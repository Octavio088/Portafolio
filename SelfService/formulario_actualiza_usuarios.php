<?php 
  $x = $_POST['id'];
  setcookie("variable_x", $_POST['id']);

  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);

  if(!$link) { header("Location: Login.php"); }
  $database = 't15a_proyecto';
  mysqli_select_db($link, $database);
  $cadQuery = "SELECT usuarios.matricula, usuarios.nombre_completo, usuarios.carrera, usuarios.generacion, usuarios.semestre, usuarios.username, usuarios.password,
  usuarios.tipo,carreras.nombre,tipousuarios.nombre 
  FROM usuarios
  INNER JOIN carreras ON usuarios.carrera = carreras.carrera
  INNER JOIN tipousuarios ON usuarios.tipo = tipousuarios.tipo 
  WHERE matricula = '$x'";
  $query = mysqli_query($link, $cadQuery);
  for ($c = 0; $c < mysqli_num_rows($query); $c++) {
    $f = mysqli_fetch_array($query);
    $matricula = $f[0];
    $nombreUsuario = $f[1];
    $carrera = $f[2];
    $generacion = $f[3];
    $semestre = $f[4];
    $username = $f[5];
    $password = $f[6];
    $tipoUsuario = $f[7];
    $nombre_carrera = $f[8];
    $nombre_tipou = $f[9];
  }
  mysqli_close($link);
  ?>
<html>
<head>
    <link rel="stylesheet" href="design_users.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Formulario_actualiza.css" />
    <script>
        function confirmUpdate() {
            return confirm("¿Estás seguro de que deseas actualizar los datos?");
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Actualiza usuarios</h2>
        <form action="action_actualizacion.php" method="post">

        <div class="form-group">
            <label for="varMatricula">Matrícula</label>
            <input id="varMatricula" name="varMatricula" type="text" placeholder="Matrícula" value="<?php echo $matricula; ?>" class="form-control" required>
            <span class="help-block">El formato de la matrícula son 6 dígitos</span>
        </div>
 
        <div class="form-group">
            <label for="varNombre">Nombre completo</label>
            <input id="varNombre" name="varNombre" type="text" placeholder="Nombre completo" class="form-control" value="<?php echo $nombreUsuario; ?>"  required>
        </div>

   
        <div class="form-group">
            <label for="varCarrera">Carrera</label>
            <select id="varCarrera" name="varCarrera" class="form-control"  required>
                <option value="<?php echo $carrera; ?>"><?php echo $f[8]; ?></option>
                <?php if($carrera != "1"){ ?><option value="1">Ingeniería en Tecnologías de la Información</option><?php }?>
                <?php if($carrera != "2"){ ?><option value="2">Ingeniería en Telemática</option><?php }?>
                <?php if($carrera != "3"){ ?><option value="3">Ingeniería en Tecnologías de Manufactura</option><?php }?>
                <?php if($carrera != "4"){ ?><option value="4">Ingeniería en Sistemas y Tecnologías Industriales</option><?php }?>
                <?php if($carrera != "5"){ ?><option value="5">Licenciatura en Administración y Gestión</option><?php }?>
                <?php if($carrera != "6"){ ?><option value="6">Licenciatura en Mercadotecnia Internacional</option><?php }?>
            </select>
        </div>

    
        <div class="form-group">
            <label for="varGeneracion">Generación</label>
            <input id="varGeneracion" name="varGeneracion" type="text" placeholder="Generación" class="form-control" value="<?php echo $generacion; ?>"  required>
            <span class="help-block">Año de ingreso</span>
        </div>

       
        <div class="form-group">
            <label for="varsemestre">Semestre</label>
            <input id="varsemestre" name="varsemestre" type="text" placeholder="Semestre" class="form-control" value="<?php echo $semestre; ?>"  required>
        </div>

        
        <div class="form-group">
            <label for="varUsername">Usuario</label>
            <input id="varUsername" name="varUsername" type="text" placeholder="Nombre de usuario" class="form-control" value="<?php echo $username; ?>"  required>
        </div>

        
        <div class="form-group">
            <label for="varPassword">Contraseña</label>
            <input id="varPassword" name="varPassword" type="password" placeholder="Contraseña" class="form-control" value="<?php echo $password; ?>"  required>
        </div>

       
        <div class="form-group">
            <label for="varTipo">Tipo usuario</label>
            <select id="varTipo" name="varTipo" class="form-control" required>
                <option value="<?php echo $tipoUsuario;?>"><?php echo $f[9];?></option>
                <?php if($tipoUsuario != "0"){ ?><option value="0">Administrador</option><?php }?>
                <?php if($tipoUsuario != "1"){ ?><option value="1">Estudiante</option><?php }?>
                <?php if($tipoUsuario != "2"){ ?><option value="2">Docente</option><?php }?>
            </select>
        </div>

        
        <div class="form-group buttons-container">
            <button type="submit" class="btn">Guardar Cambios</button>
            <button type="button" class="btn" onclick="location.href='tabla_update.php'">Salir</button>
        </div>
      </form>
    </div>
</body>
</html>