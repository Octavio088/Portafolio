<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Actualizar Materias</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Tablas_actualizar.css" />
</head>
<body>
    <div class="container">
        <h1>Tabla de Actualizar Materias</h1>
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
        //$sql = "SELECT materia, nombre_materia, clave_materia, numero_horas, creditos, semestre, materia_anterior, area, carrera FROM materias"; 
        $sql =  "SELECT 
        M.materia, 
        M.nombre_materia, 
        M.clave_materia,
        M.numero_horas,
        M.creditos,
        M.semestre,
        M.materia_anterior,
        MA.nombre_materia AS 'nombre_materia_anterior', 
        A.nombre_area,
        C.nombre AS 'carrera' 
        FROM materias M
        LEFT JOIN materias MA ON M.materia_anterior = MA.materia
        INNER JOIN carreras C ON C.carrera = M.carrera
        INNER JOIN academias A ON A.area = M.area";

        $result = $conn->query($sql);

        // Mostrar los datos en una tabla con el nuevo diseño
        if ($result->num_rows > 0) {
            echo "<form method='post' action='FormularioActualizaMaterias.php'>";
            echo "<table>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Materia</th>
                        <th>Nombre</th>
                        <th>Clave</th>
                        <th>Horas</th>
                        <th>Creditos</th>
                        <th>Semestre</th>
                        <th>Materia anterior</th>
                        <th>Area</th>
                        <th>Carrera</th>
                    </tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td><input type='radio' name='id' value='" . $row["materia"] . "'></td>
                        <td>" . $row["materia"] . "</td>
                        <td>" . $row["nombre_materia"] . "</td>
                        <td>" . $row["clave_materia"] . "</td>
                        <td>" . $row["numero_horas"] . "</td>
                        <td>" . $row["creditos"] . "</td>
                        <td>" . $row["semestre"] . "</td>
                        <td>" . $row["nombre_materia_anterior"] . "</td>
                        <td>" . $row["nombre_area"] . "</td>
                        <td>" . $row["carrera"] . "</td>
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