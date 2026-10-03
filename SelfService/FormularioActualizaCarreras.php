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
  $cadQuery = "SELECT * FROM carreras WHERE carrera = '$x'";
  $query = mysqli_query($link, $cadQuery);
  for ($c = 0; $c < mysqli_num_rows($query); $c++) {
    $f = mysqli_fetch_array($query);
    $carrera = $f[0];
    $nombreCarrera = $f[1];
    $semestres = $f[2];
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
        <h2>Actualiza Carreras</h2>
        <form action="action_actualizacion_carreras.php" method="post">

        <div class="form-group">
            <label for="varCarrera">Carrera</label>
            <input type="text" class="form-control" id="varCarrera" name="varCarrera" value="<?php echo $nombreCarrera;?>" required>
        </div>
        
        <div class="form-group">
            <label for="varsemestre">Semestre</label>
            <select name="varsemestres" class="form-control" required>
                <option value="<?php echo $semestres;?>"><?php echo $semestres;?></option>
                <?php if($semestres != "1"){ ?><option value="1">Semestre I</option><?php }?>
                <?php if($semestres != "2"){ ?><option value="2">Semestre II</option><?php }?>
                <?php if($semestres != "3"){ ?><option value="3">Semestre III</option><?php }?>
                <?php if($semestres != "4"){ ?><option value="4">Semestre IV</option><?php }?>
                <?php if($semestres != "5"){ ?><option value="5">Semestre V</option><?php }?>
                <?php if($semestres != "6"){ ?><option value="6">Semestre VI</option><?php }?>
                <?php if($semestres != "7"){ ?><option value="7">Semestre VII</option><?php }?>
                <?php if($semestres != "8"){ ?><option value="8">Semestre VIII</option><?php }?>
                <?php if($semestres != "9"){ ?><option value="9">Semestre IX</option><?php }?>
                <?php if($semestres != "10"){ ?><option value="10">Semestre X</option><?php }?>
            </select>
        </div>
        <div class="form-group buttons-container">
            <button type="submit" class="btn">Guardar Cambios</button>
            <button type="button" class="btn" onclick="location.href='TablaCarrera.php'">Salir</button>
        </div>
      </form>
    </div>
</body>
</html>