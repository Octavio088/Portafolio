<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Actualizar Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Tablas_actualizar.css" />
</head>
<body>
    <div class="container">
        <h1>Tabla de Actualizar Calificaciones</h1>
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
        //$sql = "SELECT matricula, nombre_completo, carrera, generacion, semestre, username, password, tipo FROM usuarios"; 
        $sql =  "SELECT 
        U.matricula, 
        U.nombre_completo, 
        C.nombre AS 'carrera', 
        U.generacion,
        U.semestre, 
        U.username,
        U.password,
        T.nombre
        FROM usuarios U
        INNER JOIN carreras C ON C.carrera = U.carrera
        INNER JOIN tipousuarios T ON T.tipo = U.tipo";
        $result = $conn->query($sql);

        // Mostrar los datos en una tabla con el nuevo diseño
        if ($result->num_rows > 0) {
            echo "<form method='post' action='#>";
            echo "<table>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Alumno</th>
                        <th>Grupo</th>
                        <th>Parcial 1</th>
                        <th>Parcial 2</th>
                        <th>Parcial 3</th>
                        <th>Final</th>
                        <th>Extraordinario</th>
                        <th>Regularizacio</th>
                    </tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td><input type='radio' name='id' value='" . $row["matricula"] . "'></td>
                        <td>" . $row["matricula"] . "</td>
                        <td>" . $row["nombre_completo"] . "</td>
                        <td>" . $row["carrera"] . "</td>
                        <td>" . $row["semestre"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["nombre"] . "</td>
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