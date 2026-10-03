<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Formulario_actualiza.css" />
</head>
<body>
    <div class="container">
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $matricula = $_POST['id']; // Obtiene la matrícula seleccionada

    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 't15a_proyecto';
    $link = mysqli_connect($server, $user, $pass, $database);
    mysqli_set_charset($link, "utf8");
    if (!$link) { die("Error de conexión."); }

    // Consulta las calificaciones del alumno seleccionado
    $query = "SELECT calificaciones.alumno, materias.nombre_materia, calificaciones.u1, calificaciones.u2, calificaciones.u3, calificaciones.uf
              FROM calificaciones
              INNER JOIN grupos ON calificaciones.grupo = grupos.grupo
              INNER JOIN materias ON grupos.materia = materias.materia
              WHERE calificaciones.alumno = $matricula";
    
    $result = $link->query($query);

    if ($result && $result->num_rows > 0) {
        echo "<h1>Actualizar Calificaciones</h1>";
        echo "<form method='post' action='guarda_calificaciones_null.php'>";
        while ($row = $result->fetch_assoc()) {
            echo"<input type='text' name='chamaco' class='form-control' value='" . $row['alumno'] . "' readonly ><br><br>";
            echo "<label for='u1'>Unidad 1:</label><br>";
            if($row['u1'] == NULL){
                echo "<select name='u1' class='form-control'>
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                    </select>" ;
                    echo "<br><br>";
            }else{
                echo "<select name='u1' class='form-control' readonly>
                          <option value='" . $row['u1'] . "'>" . $row['u1'] . " </option>
                      </select>";
                      echo "<br><br>";
            }
            echo "<label for='u2'>Unidad 2:</label><br>";
            if($row['u2'] == NULL){
                echo "<select name='u2' class='form-control'>
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                    </select>" ;
                    echo "<br><br>";
            }else{
                echo "<select name='u2' class='form-control' readonly>
                          <option value='" . $row['u2'] . "'>" . $row['u2'] . "</option>
                      </select>";
                      echo "<br><br>";
            }
            echo "<label for='u3'>Unidad 3:</label><br>";
            if($row['u3'] == NULL){
                echo "<select name='u3' class='form-control'>
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                    </select>" ;
                    echo "<br><br>";
            }else{
                echo "<select name='u3' class='form-control' readonly >
                          <option value='" . $row['u3'] . "'>" . $row['u3'] . "</option>
                      </select>";
                      echo "<br><br>";
            }
            echo "<label for='uf'>Unidad Final:</label><br>";
            if($row['uf'] == NULL){
                echo "<select name ='uf' class='form-control'>
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                        <option value='8'>8</option>
                        <option value='9'>9</option>
                        <option value='10'>10</option>
                    </select>" ;
                    echo "<br><br>";
            }else{
                echo "<select name='uf' class='form-control' readonly> 
                          <option value='" . $row['uf'] . "'>" . $row['uf'] . "</option>
                      </select>";
                      echo "<br><br>";
            }
        }
        echo "<button type='submit' class='btn'>Guardar Cambios</button>";
        echo "</form>";
    } else {
        echo "<p>No se encontraron calificaciones para este alumno.</p>";
    }

    mysqli_close($link);
} else {
    echo "<p>No se ha seleccionado ningún alumno.</p>";
}
?>
    </div>
</body>
</html>