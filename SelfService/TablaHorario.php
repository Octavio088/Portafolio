<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Actualizar Horarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Tablas_actualizar.css" />
</head>
<body>
    <div class="container">
        <h1>Tabla de Actualizar Horarios</h1>
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
        $sql = "SELECT horario, tipo, hora_lunes, hora_martes, hora_miercoles, hora_jueves, hora_viernes FROM horarios"; 
        $result = $conn->query($sql);

        // Mostrar los datos en una tabla con el nuevo diseño
        if ($result->num_rows > 0) {
            echo "<form method='post' action='FormularioActualizarHorario.php'>";
            echo "<table>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Horario</th>
                        <th>Tipo</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Mercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                    </tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td><input type='radio' name='id' value='" . $row["horario"] . "'></td>
                        <td>" . $row["horario"] . "</td>
                        <td>" . $row["tipo"] . "</td>
                        <td>" . $row["hora_lunes"] . "</td>
                        <td>" . $row["hora_martes"] . "</td>
                        <td>" . $row["hora_miercoles"] . "</td>
                        <td>" . $row["hora_jueves"] . "</td>
                        <td>" . $row["hora_viernes"] . "</td>
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