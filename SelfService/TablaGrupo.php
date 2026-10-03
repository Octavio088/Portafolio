<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Actualizar Grupos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Tablas_actualizar.css" />
</head>
<body>
    <div class="container">
        <h1>Tabla de Actualizar Grupos</h1>
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
        U.nombre_completo, 
        M.nombre_materia, 
        H.tipo,
        S.clave_salon
        FROM grupos G
        INNER JOIN usuarios U ON U.matricula = G.maestro
        INNER JOIN materias M ON M.materia = G.materia
        INNER JOIN horarios H ON H.horario = G.horario
        INNER JOIN salones S ON S.salon = G.salon";
    
        $result = $conn->query($sql);

        // Mostrar los datos en una tabla con el nuevo diseño
        if ($result->num_rows > 0) {
            echo "<form method='post' action='FormularioActualizaGrupo.php'>";
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
                        <td><input type='radio' name='id' value='" . $row["grupo"] . "'></td>
                        <td>" . $row["clave_grupo"] . "</td>
                        <td>" . $row["nombre_completo"] . "</td>
                        <td>" . $row["nombre_materia"] . "</td>
                        <td>" . $row["tipo"] . "</td>
                        <td>" . $row["clave_salon"] . "</td>
                      </tr>";
            }
            echo "</table>";
            echo "<div class='button-container'>";
            echo "<input type='submit' value='Actualizar'>";
            echo "<a href='Menu.php'>Salir</a>";
            echo "</div>";
            echo "</form>";
        } else {
            echo "<p>No se encontraron resultados.</p>";
            echo "<div class='button-container'>";
            echo "<a href='Menu.php'>Salir</a>";
            echo "</div>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>