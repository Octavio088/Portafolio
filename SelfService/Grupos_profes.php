<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto Slab', serif;
            background-color: #242424;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 100%;
            background-color: #353535;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: white;
        }

        h1 {
            font-size: 24px;
            color: #ffffff;
            margin-bottom: 20px;
        }

        /* Mantener la tabla en un tamaño fijo y permitir el desplazamiento */
        table {
            width: 100%;
            max-height: 400px; /* Ajusta esta altura según necesites */
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.61);
            color: white;
            display: block; /* Permite que el contenedor tenga un desplazamiento */
            overflow-y: auto;
        }

        thead, tbody {
            display: table;
            width: 100%;
            table-layout: fixed; /* Para que las columnas se ajusten al ancho */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #080808;
        }

        th {
            background-color: orangered; 
            color: white;
            text-transform: uppercase;
        }

        tr:hover {
            transition: all 0.5s;
            background-color: black;
        }

        /* Estilos para los botones */
        .button-container {
            display: flex;
            justify-content: center;
        }

        input[type="submit"], a {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            background-color: orangered;
            color: white;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
            width: 150px; /* Misma anchura para ambos botones */
            text-align: center;
            transition: all 0.5s;
        }

        input[type="submit"]:hover, a:hover {
            background-color: rgb(196, 52, 0);
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            table {
                font-size: 14px;
            }
        }

        table::-webkit-scrollbar {
            display: none;
        }
    </style>
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
    echo "<form method='post' action='Alumnosxgrupo.php'>";
    echo "<table border  = 1px >
            <tr>
                <th>Select</th>
                <th>Clave del Grupo</th>
                <th>Nombre de la materia</th>
                <th>Hora</th>
                <th>Tipo de Horario</th>
                <th>Total de Alumnos</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        //hacer ciclo que cuente el numero de monos
        $grupo = $row['grupo'];
        $total_alumnos = 0;
        $query_2 ="SELECT calificaciones.alumno, usuarios.nombre_completo, calificaciones.u1, calificaciones.u2, calificaciones.u3, calificaciones.uf,calificaciones.Final FROM calificaciones
            INNER JOIN usuarios ON calificaciones.alumno = usuarios.matricula
            WHERE calificaciones.grupo = $grupo AND usuarios.tipo = 1; "; 
        $alumnos = $link->query($query_2);

        if($alumnos->num_rows > 0){
            while ($fila = $alumnos->fetch_assoc()) {
                $total_alumnos = $total_alumnos + 1;
            }
        }else{
            $total_alumnos = 0;
        }
        echo "<tr>
                <td><input type='radio' name='id' value='" . $row["grupo"] . "'></td>
                <td>" . $row["clave_grupo"] . "</td>
                <td>" . $row["nombre_materia"] . "</td>
                <td>" . $row["hora_lunes"] . "</td>
                <td>" . $row["tipo"] . "</td>
                <td>" . $total_alumnos . "</td>
            </tr>";
    }
    echo "</table>";
    echo "<input type='submit' value='Ver Alumnos'>";
    echo "<a href='Menu.php'>Salir</a>";
    echo "</form>";
} else {
    echo "<p>No se encontraron resultados.</p>";
    echo "<a href='Menu.php'>Salir</a>";
}

?>
    </div>
</body>
</html>