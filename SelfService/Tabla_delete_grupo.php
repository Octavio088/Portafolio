<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="Tablas_actualizar.css" />
    </style>
</head>
<body>
<div class="container">
    <?php
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $contrasena = "";
    $dbname = "t15a_proyecto";

    $conn = new mysqli($servername, $username, $contrasena, $dbname);

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar y ejecutar la consulta
    $sql = "SELECT 
        G.grupo,
        G.clave_grupo, 
        G.maestro, 
        M.nombre_materia, 
        H.tipo,
        S.clave_salon
        FROM grupos G
        INNER JOIN materias M ON M.materia = G.materia
        INNER JOIN horarios H ON H.horario = G.horario
        INNER JOIN salones S ON S.salon = G.salon";
    $result = $conn->query($sql);

    // Mostrar los datos en una tabla
    if ($result->num_rows > 0) {
        echo "<form method='post' action='action_delete_grupos.php'>";
        echo "<table>
                <tr>
                    <th>Seleccionar</th>
                    <th>Clave</th>
                    <th>Maestro</th>
                    <th>Materia</th>
                    <th>Horario</th>
                    <th>Salon</th>
                </tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td><input type='radio' name='grupo' value='" . $row["grupo"] . "'></td>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["maestro"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["tipo"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<input type='submit' value='Borrado'>";
        echo "<a href='Menu.php'>Salir</a>";
        echo "</form>";
    } else {
        echo "<p>No se encontraron resultados.</p>";
        echo "<a href='Menu.php'>Salir</a>";
    }
    $conn->close();
    ?>
</div>
</body>
</html>