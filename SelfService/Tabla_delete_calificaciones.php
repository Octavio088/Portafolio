<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Borrar Calificaciones</title>
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
            usuarios.nombre_completo AS nombre_completo,
            usuarios.matricula AS matricula,
            grupos.clave_grupo AS clave_grupo,
            calificaciones.u1,
            calificaciones.u2,
            calificaciones.u3,
            calificaciones.uf,
            calificaciones.Final,
            calificaciones.ee
            FROM 
                calificaciones
            JOIN 
                usuarios ON calificaciones.alumno= usuarios.matricula
            JOIN 
                grupos ON calificaciones.grupo = grupos.grupo
            WHERE tipo = 1";

            $result = $conn->query($sql);

        // Mostrar los datos en una tabla con el nuevo diseño
        if ($result->num_rows > 0) {
            echo "<form method='post' action='Action_delete_calificaciones.php'>";
            echo "<table>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Nombre Alumno</th>
                        <th>Clave del Grupo</th>
                        <th>Calificacion U1</th>
                        <th>Calificacion U2</th>
                        <th>Calificacion U3</th>
                        <th>Calificacion UF</th>
                        <th>Calificacion Final</th>
                        <th>Calificacion Extraordinario</th>
                    </tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td><input type='radio' name='id' value='" . $row["matricula"] . "'></td>
                        <td>" . $row["nombre_completo"] . "</td>
                        <td>" . $row["clave_grupo"] . "</td>
                        <td>" . $row["u1"] . "</td>
                        <td>" . $row["u2"] . "</td>
                        <td>" . $row["u3"] . "</td>
                        <td>" . $row["uf"] . "</td>
                        <td>" . $row["Final"] . "</td>
                        <td>" . $row["ee"] . "</td>
                      </tr>";
            }
            echo "</table>";
            echo "<div class='button-container'>";
            echo "<input type='submit' value='DELETE'>";
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