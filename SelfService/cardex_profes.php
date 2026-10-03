<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Kardex.css" />
</head>
<body>
    <div class="container">
        <div class="info">
            <?php
                $var_alumno = $_POST['NombreAlumno']; // Matricula del alumno desde la cookie
                $promedio = 0;
                $contador_materias = 0;
                // Conexión a la base de datos
                $server = 'localhost';
                $user = 'root';
                $pass = '';
                $database = 'mysql';
                $link = mysqli_connect($server, $user, $pass, $database);
                mysqli_set_charset($link, "utf8");

                if (!$link) {
                    header("Location: Login.php");
                    exit;
                }

                // Selecciona la base de datos del proyecto
                $database = 't15a_proyecto';
                mysqli_select_db($link, $database);

                // Consulta para obtener los datos del alumno
                $cadQuery = "SELECT usuarios.nombre_completo, carreras.nombre, carreras.carrera
                    FROM usuarios 
                    INNER JOIN carreras ON usuarios.carrera = carreras.carrera 
                    WHERE matricula = '$var_alumno'";
                $query = mysqli_query($link, $cadQuery);
                $row = mysqli_fetch_assoc($query);
                if (!$row) {
                    echo "No se encontraron datos para el alumno.";
                    mysqli_close($link);
                    exit;
                }
                echo "<p>Alumno: " . $row['nombre_completo'] . "</p>";
                echo "<p>Carrera: " .$row['nombre'] . "</p>";
                echo "<hr>";
                echo '<button><a href="Menu.php"><span>Salir</span></a></button>';
            ?>
        </div>
        <div class="tablas">
            <?php

                for ($i = 0; $i < 10; $i++) { 
                    switch ($i) {
                        case 0:
                            echo "<div class='sm'><h2>Primer Semestre</h2></div>";
                            break;
                        case 1:
                            echo "<div class='sm'><h2>Segundo Semestre</h2></div>";
                            break;
                        case 2:
                            echo "<div class='sm'><h2>Tercer Semestre</h2></div>";
                            break;
                        case 3:
                            echo "<div class='sm'><h2>Cuarto Semestre</h2></div>";
                            break;
                        case 4:
                            echo "<div class='sm'><h2>Quinto Semestre</h2></div>";
                            break;
                        case 5:
                            echo "<div class='sm'><h2>Sexto Semestre</h2></div>";
                            break;
                        case 6:
                            echo "<div class='sm'><h2>Septimo Semestre</h2></div>";
                            break;
                        case 7:
                            echo "<div class='sm'><h2>Octavo Semestre</h2></div>";
                            break;
                        case 8:
                            echo "<div class='sm'><h2>Noveno Semestre</h2></div>";
                            break;
                    }
                    echo "<br><table border='1'>
                        <tr>
                            <th>Materia</th>
                            <th>Créditos</th>
                            <th>Calificación</th>
                            <th>Grupo</th>
                        </tr>";
                    $pull_materias = "SELECT nombre_materia, creditos, materia FROM materias WHERE semestre = $i AND carrera = '" . $row['carrera'] . "'";
                    $result = mysqli_query($link, $pull_materias);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($fila = mysqli_fetch_assoc($result)) {
                            
                            $pull_calificacion = "SELECT grupos.clave_grupo, calificaciones.Final FROM calificaciones 
                                INNER JOIN grupos ON calificaciones.grupo = grupos.grupo 
                                WHERE calificaciones.alumno = '$var_alumno' AND grupos.materia = '" . $fila['materia'] . "'";
                            
                            $resultado = mysqli_query($link, $pull_calificacion);
                            
                            $final = "N/C"; 
                            $clave_grupo = "No asignado";
                            
                            if ($resultado && mysqli_num_rows($resultado) > 0) {
                                $cali = mysqli_fetch_assoc($resultado);
                                $final = $cali['Final'];
                                $clave_grupo = $cali['clave_grupo'];
                                $promedio = $promedio + $final;
                                $contador_materias = $contador_materias + 1;
                            }
                            echo "<tr>
                                    <td>" . $fila["nombre_materia"] . "</td>
                                    <td>" . $fila["creditos"] . "</td>
                                    <td>" . $final . "</td>
                                    <td>" . $clave_grupo . "</td>
                                </tr>";
                        }
                    }
                    echo "</table>";
                    
                }
                if($contador_materias> 0){
                    $promedio = $promedio/$contador_materias;
                }else{
                    $promedio = 0.0;
                }
                echo "Promedio: ";
                echo number_format($promedio, 2);
                mysqli_close($link);
            ?>
        </div>
    </div>
</body>
</html>