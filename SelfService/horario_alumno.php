<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Tablas_consulta.css" />
</head>
<body>
<div class="container">
    <h1>Consulta Grupo</h1>
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

    $query = "SELECT grupos.clave_grupo, materias.nombre_materia, usuarios.nombre_completo , horarios.hora_lunes ,horarios.hora_martes, horarios.hora_miercoles,
    horarios.hora_jueves , horarios.hora_viernes , salones.clave_salon, salones.ubicacion_fisica
    FROM calificaciones 
    INNER JOIN grupos ON calificaciones.grupo = grupos.grupo 
    INNER JOIN horarios ON grupos.horario = horarios.horario
    INNER JOIN usuarios ON usuarios.matricula = grupos.maestro
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE alumno = $usuario;";

    $result = $link->query($query);
    if($result->num_rows > 0){
        echo "<table border  = 1px >
                <tr>
                    <th>Clave de Grupo</th>
                    <th>Nombre Materia</th>
                    <th>Profesor</th>
                    <th>Hora Lunes</th>
                    <th>Hora Martes</th>
                    <th>Hora Miercoles</th>
                    <th>Hora Jueves</th>
                    <th>Hora Viernes</th>
                    <th>Salon</th>
                    <th>Edificio</th>
                </tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>".$row["nombre_materia"]."</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["hora_lunes"] . "</td>
                    <td>" . $row["hora_martes"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["hora_jueves"] . "</td>
                    <td>" . $row["hora_viernes"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                    <td>" . $row["ubicacion_fisica"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='Menu.php'>Salir</a>";
    }else {
        echo "<p>No se encontraron resultados.</p>";
        echo "<a href='Menu.php'>Salir</a>";
    }
?>
</div>
</body>
</html>