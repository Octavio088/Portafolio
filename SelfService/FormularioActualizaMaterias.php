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
  $cadQuery = "SELECT * FROM materias WHERE materia = '$x'";
  $query = mysqli_query($link, $cadQuery);
  for ($c = 0; $c < mysqli_num_rows($query); $c++) {
    $f = mysqli_fetch_array($query);
    $nombre_materia = $f[1];
    $clave_materia = $f[2];
    $numero_horas = $f[3];
    $creditos = $f[4];
    $semestre = $f[5];
    $materia_anterior = $f[6];
    $area = $f[7];
    $carrera = $f[8];
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
        <h2>Actualiza Materias</h2>
        <form action="action_actualizacion_materias.php" method="post">

        <div class="form-group">
            <label>Nombre de la Materia</label>
            <input type="text" class="form-control" name="nombre_materia" value="<?php echo $nombre_materia; ?>" placeholder="hola" required>
        </div>
 
        <div class="form-group">
            <label>Numero de horas</label>
            <select class="form-control" name="numero_horas" required>
                <option value="<?php echo $numero_horas; ?>"><?php echo $numero_horas; ?></option>
                <?php if($numero_horas != "48"){ ?><option value="48">48</option><?php }?>
                <?php if($numero_horas != "80"){ ?><option value="80">80</option><?php }?>
            </select>
        </div>

        <div class="form-group">
            <label>Clave de la Materia</label>
            <input type="text" class="form-control" value="<?php echo $clave_materia; ?>" name="clave_materia" required>
        </div>
      
   
        <div class="form-group">
            <label>Creditos</label>
            <select class="form-control" name="creditos" required>
                <option value="<?php echo $creditos; ?>"><?php echo $creditos; ?></option>
                <?php if($creditos != "7"){ ?><option value="7">7</option><?php }?>
                <?php if($creditos != "8"){ ?><option value="8">8</option><?php }?>
                <?php if($creditos != "9"){ ?><option value="9">9</option><?php }?>
            </select>
        </div>

    
        <div class="form-group">
            <label>Semestre</label>
            <select class="form-control" name="semestre" required>
                <option value="<?php echo $semestre;?>"><?php echo $semestre;?></option>
                <?php if($semestre != "0"){ ?><option value="0">Semestre 0</option><?php }?>
                <?php if($semestre != "1"){ ?><option value="1">Semestre I</option><?php }?>
                <?php if($semestre != "2"){ ?><option value="2">Semestre II</option><?php }?>
                <?php if($semestre != "3"){ ?><option value="3">Semestre III</option><?php }?>
                <?php if($semestre != "4"){ ?><option value="4">Semestre IV</option><?php }?>
                <?php if($semestre != "5"){ ?><option value="5">Semestre V</option><?php }?>
                <?php if($semestre != "6"){ ?><option value="6">Semestre VI</option><?php }?>
                <?php if($semestre != "7"){ ?><option value="7">Semestre VII</option><?php }?>
                <?php if($semestre != "8"){ ?><option value="8">Semestre VIII</option><?php }?>
                <?php if($semestre != "9"){ ?><option value="9">Semestre IX</option><?php }?>
                <?php if($semestre != "10"){ ?><option value="10">Semestre X</option><?php }?>
            </select>
        </div>

       
        <div class="form-group">
            <label>Materia anterior</label>
            <input type="text" class="form-control" name="materia_anterior" value="<?php echo $materia_anterior; ?>" readonly>
        </div>

        
        <div class="form-group">
            <label>Area</label>
            <input type="text" class="form-control" name="area" value="<?php echo $area; ?>" readonly>
        </div>

        
        <div class="form-group">
            <label>Carrera</label>
            <input type="text" class="form-control" name="carrera" value="<?php echo $carrera; ?>" readonly>
        </div>
        
        <div class="form-group buttons-container">
            <button type="submit" class="btn">Guardar Cambios</button>
            <button type="button" class="btn" onclick="location.href='TablaMateria.php'">Salir</button>
        </div>
      </form>
    </div>
</body>
</html>