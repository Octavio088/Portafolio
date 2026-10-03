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
  $cadQuery = "SELECT * FROM grupos WHERE grupo = '$x'";
  $query = mysqli_query($link, $cadQuery);
  for ($c = 0; $c < mysqli_num_rows($query); $c++) {
    $f = mysqli_fetch_array($query);
    $clave_grupo = $f[1];
    $maestro = $f[2];
    $materia = $f[3];
    $horario = $f[4];
    $salon = $f[5];
  }

  $cadQuery_profe = "SELECT matricula, nombre_completo FROM usuarios where tipo = 2"; // Manda llamar solo a los profesores
  $query_profe = mysqli_query($link, $cadQuery_profe);

  $cadQuery_salon = "SELECT salon, clave_salon FROM salones"; // Manda llamar a todos los salones
  $query_salon = mysqli_query($link, $cadQuery_salon);
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
<?php
                $cadQuery_nombre_profe = "SELECT nombre_completo FROM usuarios where matricula = $maestro"; // Manda llamar solo a los profesores
                $query_profe_o = mysqli_query($link, $cadQuery_nombre_profe);
                $lolo = mysqli_fetch_assoc($query_profe_o);
                $nombre_profe = $lolo['nombre_completo'];

                $cadQuery_nombre_salon = "SELECT clave_salon FROM salones where salon = $salon"; // Manda llamar solo a los profesores
                $query_salon_o = mysqli_query($link, $cadQuery_nombre_salon);
                $lala = mysqli_fetch_assoc($query_salon_o);
                $nombre_salon = $lala['clave_salon'];

                $cadQuery_nombre_salonvf = "SELECT nombre_materia FROM materias where materia = $materia"; // Manda llamar solo a los profesores
                $query_salon_vf = mysqli_query($link, $cadQuery_nombre_salonvf);
                $lalaf = mysqli_fetch_assoc($query_salon_vf);
                $nombre_mate = $lalaf['nombre_materia'];

                $cadQuery_nombre_salonv = "SELECT hora_lunes FROM horarios where horario = $horario"; // Manda llamar solo a los profesores
                $query_salon_v = mysqli_query($link, $cadQuery_nombre_salonv);
                $lala = mysqli_fetch_assoc($query_salon_v);
                $hora = $lala['hora_lunes'];
?>

<body>
    <div class="container">
        <h2>Actualiza Grupos</h2>
        <form action="action_actualiza_grupo.php" method="post">

        <div class="form-group">
            <label>Clave del Grupo</label>
            <input class="form-control" type="text" value="<?php echo $clave_grupo;?>" name="clave_grupo" required>
        </div>
 
        <div class="form-group">
            <label>Selecciona un maestro</label>

            <select id="profesor" name="profesor" class="form-control">
                <option value="<?php echo $maestro;?>"><?php echo $nombre_profe;?></option>
                <?php
                    while ($row = $query_profe->fetch_assoc()) {
                        if ($row['matricula'] != $maestro) {
                            echo "<option value='" . $row['matricula'] . "'>" . $row['nombre_completo'] . "</option>";
                        }
                    }
                ?>
            </select>
        </div>

   
        <div class="form-group">
            <label>Materia</label>
            <select name="materia" class="form-control" readonly>
            <option  value="<?php echo $materia;?>"><?php echo $nombre_mate; ?></option>
            </select>
        </div>

    
        <div class="form-group">
            <label>Horario</label>
            <select name="horario" class="form-control" readonly>
            <option  value="<?php echo $horario;?>"><?php echo $hora; ?></option>
            </select>
        </div>

       
        <div class="form-group">
            <label>Selecciona Salon</label>
            <select id="salon" name="salon" class="form-control">
                <option value="<?php echo $salon; ?>"><?php echo $nombre_salon; ?></option>
                <?php
                    while ($row = $query_salon->fetch_assoc()) {
                        if ($row['salon'] != $salon) {
                            echo "<option value='" . $row['salon'] . "'>" . $row['clave_salon'] . "</option>";
                        }
                    }
                ?>
            </select>
        </div>

        <div class="form-group buttons-container">
            <button type="submit" class="btn">Guardar Cambios</button>
            <button type="button" class="btn" onclick="location.href='TablaGrupo.php'">Salir</button>
        </div>
      </form>
    </div>
</body>
</html>
<?php
mysqli_close($link);
?>