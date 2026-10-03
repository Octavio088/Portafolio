<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Tablas_consulta.css" />
</head>
<body>
    <div class="container">
    <?php
$var_profe = $_COOKIE['matri']; // Matricula del alumno desde la cookie

// Conexión a la base de datos
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'mysql';
$link = mysqli_connect($server, $user, $pass, $database);
mysqli_set_charset($link, "utf8");

if (!$link) {header("Location: Login.php");}

$database = 't15a_proyecto';
mysqli_select_db($link, $database);



$cadQuery = "SELECT grupos.clave_grupo, grupos.grupo ,materias.nombre_materia, horarios.hora_lunes , horarios.tipo FROM grupos
INNER JOIN  materias ON grupos.materia = materias.materia
INNER JOIN horarios ON grupos.horario = horarios.horario
WHERE maestro = $var_profe";
$result = $link->query($cadQuery);


if ($result->num_rows > 0) {
    echo "<table border  = 1px >
            <tr>
                <th>Clave del Grupo</th>
                <th>Nombre de la materia</th>
                <th>Total de Alumnos</th>
                <th>Alumnos con Calificacion 1 unidad</th>
                <th>Alumnos con Calificacion 2 unidad</th>
                <th>Alumnos con Calificacion 3 unidad</th>
                <th>Alumnos con Calificacion unidad final</th>
                <th>Alumnos con Calificacion Extraordinario</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        //hacer ciclo que cuente el numero de monos
        $grupo = $row['grupo'];
        $total_alumnos_2 = 0;
        $query_2 ="SELECT calificaciones.alumno, usuarios.nombre_completo, calificaciones.u1, calificaciones.u2, calificaciones.u3, calificaciones.uf,calificaciones.Final FROM calificaciones
            INNER JOIN usuarios ON calificaciones.alumno = usuarios.matricula
            WHERE calificaciones.grupo = $grupo AND usuarios.tipo = 1; "; 
        $alumnos = $link->query($query_2);

        if($alumnos->num_rows > 0){
            while ($fila = $alumnos->fetch_assoc()) {
                $total_alumnos_2 = $total_alumnos_2 + 1;
            }
        }else{
            $total_alumnos_2 = 0;
        }
//-----------------------------------------------------------------------------------------------------------
        $query_3 = "SELECT COUNT(*) AS total_alumnos
        FROM calificaciones
        INNER JOIN usuarios ON calificaciones.alumno = usuarios.matricula
        WHERE calificaciones.grupo = $grupo AND usuarios.tipo = 1 AND calificaciones.u1 IS NOT NULL;";
        $resultado = $link->query($query_3);

        if ($resultado) {
            $fila = $resultado->fetch_assoc();
            $p = $fila['total_alumnos']; // Asigna el valor a la variable $alumnos
        } else {
            $p = 0;
        }
//---------------------------------------------------------------------------------------------------------------
$query_4 = "SELECT COUNT(*) AS total_alumnos
FROM calificaciones
INNER JOIN usuarios ON calificaciones.alumno = usuarios.matricula
WHERE calificaciones.grupo = $grupo AND usuarios.tipo = 1 AND calificaciones.u2 IS NOT NULL;";
$resultado_2 = $link->query($query_4);

if ($resultado_2) {
    $fila = $resultado_2->fetch_assoc();
    $o = $fila['total_alumnos']; // Asigna el valor a la variable $alumnos
} else {
    $o = 0;
}
//---------------------------------------------------------------------------------------------------------------
$query_5 = "SELECT COUNT(*) AS total_alumnos
FROM calificaciones
INNER JOIN usuarios ON calificaciones.alumno = usuarios.matricula
WHERE calificaciones.grupo = $grupo AND usuarios.tipo = 1 AND calificaciones.u3 IS NOT NULL;";
$resultado_3 = $link->query($query_5);

if ($resultado_3) {
    $fila = $resultado_3->fetch_assoc();
    $k = $fila['total_alumnos']; // Asigna el valor a la variable $alumnos
} else {
    $k = 0;
}
//---------------------------------------------------------------------------------------------------------------
$query_6 = "SELECT COUNT(*) AS total_alumnos
FROM calificaciones
INNER JOIN usuarios ON calificaciones.alumno = usuarios.matricula
WHERE calificaciones.grupo = $grupo AND usuarios.tipo = 1 AND calificaciones.uf IS NOT NULL;";
$resultado_4 = $link->query($query_6);

if ($resultado_4) {
    $fila = $resultado_4->fetch_assoc();
    $h = $fila['total_alumnos']; // Asigna el valor a la variable $alumnos
} else {
    $h = 0;
}
//---------------------------------------------------------------------------------------------------------------
$query_7 = "SELECT COUNT(*) AS total_alumnos
FROM calificaciones
INNER JOIN usuarios ON calificaciones.alumno = usuarios.matricula
WHERE calificaciones.grupo = $grupo AND usuarios.tipo = 1 AND calificaciones.ee IS NOT NULL;";
$resultado_5 = $link->query($query_7);

if ($resultado_5) {
    $fila = $resultado_5->fetch_assoc();
    $e = $fila['total_alumnos']; // Asigna el valor a la variable $alumnos
} else {
    $e = 0;
}
//---------------------------------------------------------------------------------------------------------------
        echo "<tr>
                <td>" . $row["clave_grupo"] . "</td>
                <td>" . $row["nombre_materia"] . "</td>
                <td>" . $total_alumnos_2 . "</td>
                <td>" . $p . "</td>
                <td>" . $o . "</td>
                <td>" . $k . "</td>
                <td>" . $h . "</td>
                <td>" . $e . "</td>
            </tr>";
    }
    echo "</table>";
    echo "<a href='Menu.php'>Salir</a>";
} else {
    echo "<p>No se encontraron resultados.</p>";
    echo "<a href='Menu.php'>Salir</a>";
}

?>
    </div>
</body>
</html>