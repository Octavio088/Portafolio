<?php
// conexion a base de datos  
  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);
  if(!$link) { header("Location: Login.php"); }
  $database = 't15a_proyecto';
  mysqli_select_db($link, $database);
//------------------------------------------------------------------
  $cadQuery = "SELECT hora_viernes FROM horarios where horario <= 13"; // Manda llamar las carreras
  $query = mysqli_query($link, $cadQuery);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario</title>
    <link rel="stylesheet" href="Formulario_consulta_estilo.css">
</head>
<body>
    <div class="container">
        <h2>Consulta de Horarios</h2>
        <form action="action_consulta_horarios.php" method="post">
            <div class="form-section blue-section">
                <div>
                    <label for="tipoHorario">Tipo de Horario</label>
                    <select id="tipoHorario" name="tipoHorario" class="form-control">
                    <option value="">Elige</option>
                        <option value="Diario">Diario</option>
                        <option value="Terciado">Terciario</option>
                    </select>
                </div>
                <div>
                    <label for="horaHorario">Hora</label>
                    <select id="hora" name="hora" class="form-control">
                        <option value="">Selecciona una hora</option>
                        <option value="07:00 - 07:55">07:00 - 07:55</option>
                        <?php
                      while ($row = $query->fetch_assoc()) {
                      echo "<option value='" . $row['hora_viernes'] . "'>" . $row['hora_viernes'] . "</option>";
                      }
                      ?>
                    </select>
                </div>
            </div>
            <div class="button-group">
                <button type="submit" class="btn">Buscar</button>
                <button type="reset" class="btn">Limpiar</button>
                <button type="submit" formaction="Menu.php" class="btn">Salir</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
mysqli_close($link);
?>
</body>
</html>