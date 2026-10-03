<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Actualizar Salones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Tablas_actualizar.css" />
</head>
<body>
    <div class="container">
        <h1>Tabla de Actualizar Salones</h1>
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
        $sql = "SELECT salon, clave_salon, nombre_salon, ubicacion_fisica FROM salones";
        $result = $conn->query($sql);

        // Mostrar los datos en una tabla con el nuevo diseño
        if ($result->num_rows > 0) {
            echo "<form method='post' action='FormularioActualizaSalon.php'>";
            echo "<table>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Salon</th>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Ubicacion</th>
                    </tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td><input type='radio' name='id' value='" . $row["salon"] . "'></td>
                        <td>" . $row["salon"] . "</td>
                        <td>" . $row["clave_salon"] . "</td>
                        <td>" . $row["nombre_salon"] . "</td>
                        <td>" . $row["ubicacion_fisica"] . "</td>
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