<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Formulario_inserta_estilo.css">
</head>
<body>
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
  $cadQuery = "SELECT matricula, nombre_completo FROM usuarios where tipo = 2"; // Manda llamar solo a los profesores
  $query = mysqli_query($link, $cadQuery);
  
  $cadQuery_materia = "SELECT materia, nombre_materia FROM materias"; // Manda llamar a todas las materias que tenemos
  $query_materia = mysqli_query($link, $cadQuery_materia);

  $cadQuery_salon = "SELECT salon, clave_salon FROM salones"; // Manda llamar a todos los salones
  $query_salon = mysqli_query($link, $cadQuery_salon);

  $cadQuery_horario = "SELECT horario,tipo, hora_lunes FROM horarios"; // Manda llamar a todos los salones
  $query_horario = mysqli_query($link, $cadQuery_horario);
  ?>

  <div class="container">
    <h2>Insertar Grupos</h2>
  <form action="action_guardar_grupos.php" method="post">

    <div class="form-fila">
        <div class="form-grupo">
        <label>Clave del grupo:</label>
        <input type="text" name="clave_grupo" required>
        </div>
        <div class="form-grupo">
        <label>Selecciona un maestro</label>
    <select id="profesor" name="profesor">
        <?php
            while ($row = $query->fetch_assoc()) {
                echo "<option value='" . $row['matricula'] . "'>" . $row['nombre_completo'] . "</option>";
            }
        ?>
    </select>
        </div>
    </div>
    <div class="form-fila">
        <div class="form-grupo">
        <label>Selecciona la materia:</label>
    <select id="materia" name="materia">
        <?php
            while ($row = $query_materia->fetch_assoc()) {
                echo "<option value='" . $row['materia'] . "'>" . $row['nombre_materia'] . "</option>";
            }
        ?>
    </select>
        </div>
        <div class="form-grupo">
        <label>Selecciona el horario:</label>
    <select id="horario" name="horario">
        <?php
            while ($row = $query_horario->fetch_assoc()) {
                echo "<option value='" . $row['horario'] . "'>" . $row['tipo'] .":". $row['hora_lunes'] . "</option>";
            }
        ?>
    </select>
        </div>
    </div>

    <label>Selecciona Salon</label>
    <select id="salon" name="salon">
        <?php
            while ($row = $query_salon->fetch_assoc()) {
                echo "<option value='" . $row['salon'] . "'>" . $row['clave_salon'] . "</option>";
            }
        ?>
    </select>
    <button type="submit">Guardar Grupos</button>
  </form>
  </div>

<?php
mysqli_close($link);
?>
</body>
</html>
