<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Tablas_actualizar.css" />
</head>
<body>
    <div class="container">
    <h1>Tabla de Actualizar Calificaciones</h1>
    <?php
    $usuario = $_COOKIE['matri'];
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'mysql';
    $link = mysqli_connect($server, $user, $pass, $database);
    mysqli_set_charset($link, "utf8");
    if (!$link) {header("Location: Login.php");}
    $database = 't15a_proyecto';
    mysqli_select_db($link, $database);

    $query = "SELECT usuarios.matricula, usuarios.nombre_completo, materias.nombre_materia, calificaciones.u1, calificaciones.u2, calificaciones.u3, calificaciones.uf
    FROM usuarios
    INNER JOIN calificaciones ON usuarios.matricula = calificaciones.alumno
    INNER JOIN grupos ON calificaciones.grupo = grupos.grupo
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE (calificaciones.u1 IS NULL 
    OR calificaciones.u2 IS NULL 
    OR calificaciones.u3 IS NULL 
    OR calificaciones.uf IS NULL) AND grupos.maestro = $usuario;";

    $result = $link->query($query);
    if($result->num_rows > 0){
        echo "<form method='post' action='actualiza_nulos_form.php'>";
        echo "<table border='1'>
            <tr>
                <th>Select</th>
                <th>Nombre</th>
                <th>Unidad 1</th>
                <th>Unidad 2</th>
                <th>Unidad 3</th>
                <th>Unidad Final</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><input type='radio' name='id' value='" . $row["matricula"] . "'></td>
                <td>" . htmlspecialchars($row['nombre_completo'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . (is_null($row['u1']) ? 'Sin Calificación' : $row['u1']) . "</td>
                <td>" . (is_null($row['u2']) ? 'Sin Calificación' : $row['u2']) . "</td>
                <td>" . (is_null($row['u3']) ? 'Sin Calificación' : $row['u3']) . "</td>
                <td>" . (is_null($row['uf']) ? 'Sin Calificación' : $row['uf']) . "</td>
              </tr>";
    }
    echo "</table>";
        echo "<input type='submit' value='Actualizar'>";
        echo "<a href='Menu.php'>Salir</a>";
        echo "</form>";
    }else {
        echo "<p>No se encontraron resultados.</p>";
        echo "<a href='Menu.php'>Salir</a>";
    }
?>
    </div>
</body>
</html>