<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="Tablas_actualizar.css" />
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

    // Mostrar los datos en una tabla
    if ($result->num_rows > 0) {
        echo "<form method='post' action='action_delete.php'>";
        echo "<table>
                <tr>
                    <th>Seleccionar</th>
                    <th>Matrícula</th>
                    <th>Nombre Completo</th>
                    <th>Carrera</th>
                    <th>Semestre</th>
                    <th>Usuario</th>
                    <th>Tipo</th>
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