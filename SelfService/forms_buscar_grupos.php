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
  $cadQuery_salon = "SELECT salon, clave_salon FROM salones"; // Manda llamar las carreras
  $query_salones = mysqli_query($link, $cadQuery_salon);
  $cadQuery_profes = "SELECT matricula, nombre_completo FROM usuarios where tipo = 2"; // Manda llamar las carreras
  $query_profes = mysqli_query($link, $cadQuery_profes);
  $cadQuery_materias = "SELECT materia, nombre_materia FROM materias"; // Manda llamar las carreras
  $query_materias = mysqli_query($link, $cadQuery_materias);
  $cadQuery_horario = "SELECT horario, hora_miercoles FROM horarios where horario <= 13"; // Manda llamar las carreras
  $query_horario = mysqli_query($link, $cadQuery_horario);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupos</title>
    <link rel="stylesheet" href="Formulario_consulta_estilo.css">
</head>
<body>
    <div class="container">
        <h2>Consulta de Grupos</h2>
        <form action="busca_grupo.php"method="post">
            <div class="form-section">
                <div>
                <label for="materia">Materia</label>
                    <select id="materia" name="materia" class="form-control">
                    <option value="">Elige</option>
                      <?php
                      while ($row = $query_materias->fetch_assoc()) {
                      echo "<option value='" . $row['materia'] . "'>" . $row['nombre_materia'] . "</option>";
                      }
                      ?>
                    </select>
                </div>
                <div>
                    <label for="horarioGrupo">Horario</label>
                    <select id="horario" name="horario" class="form-control">
                    <option value="">Elige</option>
                    <option value="07:00 - 07:55">07:00 - 07:55</option>
                      <?php
                      while ($row = $query_horario->fetch_assoc()) {
                      echo "<option value='" . $row['horario'] . "'>" . $row['hora_miercoles'] . "</option>";
                      }
                      ?>
                    </select>
                </div>
                <div>
                    <label for="maestro">Maestro</label>
                    <select id="maestro" name="maestro" class="form-control">
                    <option value="">Elige</option>
                      <?php
                      while ($row = $query_profes->fetch_assoc()) {
                      echo "<option value='" . $row['matricula'] . "'>" . $row['nombre_completo'] . "</option>";
                      }
                      ?>
                    </select>
                </div>
                <div>
                    <label for="salonGrupo">Salón</label>
                    <select id="salon" name="salon" class="form-control">
                    <option value="">Elige</option>
                      <?php
                      while ($row = $query_salones->fetch_assoc()) {
                      echo "<option value='" . $row['salon'] . "'>" . $row['clave_salon'] . "</option>";
                      }
                      ?>
                    </select>
                </div>
                <div>
                    <label for="claveGrupo">Clave de Grupo</label>
                    <input type="text" id="claveGrupo" name="claveGrupo"value="" class="form-control">
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
