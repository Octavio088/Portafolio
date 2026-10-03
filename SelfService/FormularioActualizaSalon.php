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
  $cadQuery = "SELECT * FROM salones WHERE salon = '$x'";
  $query = mysqli_query($link, $cadQuery);
  for ($c = 0; $c < mysqli_num_rows($query); $c++) {
    $f = mysqli_fetch_array($query);
    $clave_salon = $f[1];
    $nombre_salon = $f[2];
    $ubicacion_fisica = $f[3];
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
        <h2>Actualiza Salones</h2>
        <form action="action_actualizacion_salon.php" method="post">

        <div class="form-group">
            <label>Clave del Salón</label>
            <input type="text" name="clave_salon" value="<?php echo $clave_salon; ?>" class="form-control" required>
        </div>
 
        <div class="form-group">
            <label>Nombre del Salón</label>
            <input type="text" name="nombre_salon" value="<?php echo $nombre_salon; ?>" class="form-control" required>
        </div>

   
        <div class="form-group">
            <label>Edificio</label>
            <select name="ubicacion_fisica" class="form-control" required>
                <option value="<?php echo $ubicacion_fisica; ?>"><?php echo $ubicacion_fisica; ?></option>
                <?php if($ubicacion_fisica != "Unidad Academica de Estudiantes 1"){ ?><option value="Unidad Academica de Estudiantes 1">Unidad Academica de Estudiantes 1</option><?php }?>
                <?php if($ubicacion_fisica != "Unidad Academica de Estudiantes 2"){ ?><option value="Unidad Academica de Estudiantes 2">Unidad Academica de Estudiantes 2</option><?php }?>
                <?php if($ubicacion_fisica != "Unidad Academica de Estudiantes 3"){ ?><option value="Unidad Academica de Estudiantes 3">Unidad Academica de Estudiantes 3</option><?php }?>
                <?php if($ubicacion_fisica != "Unidad Academica de Estudiantes 4"){ ?><option value="Unidad Academica de Estudiantes 4">Unidad Academica de Estudiantes 4</option><?php }?>
                <?php if($ubicacion_fisica != "Centro de Computo"){ ?><option value="Centro de Computo">Centro de Computo</option><?php }?>
                <?php if($ubicacion_fisica != "Centro Academico de Ingles"){ ?><option value="Centro Academico de Ingles">Centro Academico de Ingles</option><?php }?>
                <?php if($ubicacion_fisica != "Centro de Nuevas Tecnologias"){ ?><option value="Centro de Nuevas Tecnologias">Centro de Nuevas Tecnologias</option><?php }?>
            </select>
        </div>

        <div class="form-group buttons-container">
            <button type="submit" class="btn">Guardar Cambios</button>
            <button type="button" class="btn" onclick="location.href='TablaSalon.php'">Salir</button>
        </div>
      </form>
    </div>
</body>
</html>