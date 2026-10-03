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
  $cadQuery_carrera = "SELECT carrera, nombre FROM carreras"; // Manda llamar las carreras
  $query_carrera = mysqli_query($link, $cadQuery_carrera);
  $cadQuery_area = "SELECT area, nombre_area FROM academias"; // Manda llamar las carreras
  $query_area = mysqli_query($link, $cadQuery_area);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias</title>
    <link rel="stylesheet" href="Formulario_consulta_estilo.css">
</head>
<body>
    <div class="container" >
        <h2>Consulta de Materias</h2>
        <form action="action_consulta_materias.php"method="post" >
            <div class="form-section">
                <div>
                    <label for="nombreMateria">Nombre de la Materia</label>
                    <input type="text" id="nombre" name="nombre" value="" class="form-control">
                </div>
                <div>
                    <label for="claveMateria">Clave de la Materia</label>
                    <input type="text" id="clave" name="clave" value="" class="form-control">
                </div>
                <div>
                    <label for="creditos">Area</label>
                    <select id="area" name="area" class="form-control">
                    <option value="">Elige</option>
                      <?php
                      while ($row = $query_area->fetch_assoc()) {
                      echo "<option value='" . $row['area'] . "'>" . $row['nombre_area'] . "</option>";
                      }
                      ?>
                    </select>
                </div>
                <div>
                    <label for="semestre">Semestre</label>
                    <select id="semestre" name="semestre" class="form-control">
                        <option value="">Selecciona semestre</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div>
                <div>
                    <label for="carreraMateria">Carrera</label>
                    <select id="carrera" name="carrera" class="form-control">
                      <option value="">Elige</option>
                      <?php
                      while ($row = $query_carrera->fetch_assoc()) {
                      echo "<option value='" . $row['carrera'] . "'>" . $row['nombre'] . "</option>";
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