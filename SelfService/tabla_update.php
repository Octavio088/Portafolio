<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Actualizar Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Tablas_actualizar.css" />
    <style>
        /* Estilos para cambiar el color de la cinta (cabecera) de las tablas */
        tr.alumnos th {
            background-color: #007BFF; /* Azul */
            color: white;
            padding: 10px;
            text-align: center;
        }

        tr.docentes th {
            background-color: #FFA500; /* Naranja */
            color: white;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tabla de Actualizar Usuarios</h1>
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

        // Consulta SQL para obtener solo los Administradores (Filtro por tipo "Administrador" tipo = 0)
        $sql_admins = "SELECT 
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
                        INNER JOIN tipousuarios T ON T.tipo = U.tipo
                        WHERE T.tipo = 0"; // Filtra solo a los Administradores (tipo = 0)

        $result_admins = $conn->query($sql_admins);

        // Consulta SQL para obtener solo los Alumnos (Filtro por tipo "Alumno" tipo = 1)
        $sql_alumnos = "SELECT 
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
                        INNER JOIN tipousuarios T ON T.tipo = U.tipo
                        WHERE T.tipo = 1"; // Filtra solo a los Alumnos (tipo = 1)

        $result_alumnos = $conn->query($sql_alumnos);

        // Consulta SQL para obtener solo los Docentes (Filtro por tipo "Docente" tipo = 2)
        $sql_docentes = "SELECT 
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
                        INNER JOIN tipousuarios T ON T.tipo = U.tipo
                        WHERE T.tipo = 2"; // Filtra solo a los Docentes (tipo = 2)

        $result_docentes = $conn->query($sql_docentes);

        // Mostrar la tabla de Administradores
        if ($result_admins->num_rows > 0) {
            echo "<form method='post' action='formulario_actualiza_usuarios.php'>";
            echo "<h2>Administradores</h2>";
            echo "<table>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Matrícula</th>
                        <th>Nombre Completo</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Usuario</th>
                    </tr>";

            // Mostrar solo los Administradores
            while ($row = $result_admins->fetch_assoc()) {
                echo "<tr>
                        <td><input type='radio' name='id' value='" . $row["matricula"] . "'></td>
                        <td>" . $row["matricula"] . "</td>
                        <td>" . $row["nombre_completo"] . "</td>
                        <td>" . $row["carrera"] . "</td>
                        <td>" . $row["semestre"] . "</td>
                        <td>" . $row["username"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron administradores.</p>";
        }

        // Mostrar la tabla de Alumnos
        if ($result_alumnos->num_rows > 0) {
            echo "<h2>Alumnos</h2>";
            echo "<table>
                    <tr class='alumnos'>
                        <th>Seleccionar</th>
                        <th>Matrícula</th>
                        <th>Nombre Completo</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Usuario</th>
                    </tr>";

            // Mostrar solo los Alumnos
            while ($row = $result_alumnos->fetch_assoc()) {
                echo "<tr>
                        <td><input type='radio' name='id' value='" . $row["matricula"] . "'></td>
                        <td>" . $row["matricula"] . "</td>
                        <td>" . $row["nombre_completo"] . "</td>
                        <td>" . $row["carrera"] . "</td>
                        <td>" . $row["semestre"] . "</td>
                        <td>" . $row["username"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron alumnos.</p>";
        }

        // Mostrar la tabla de Docentes
        if ($result_docentes->num_rows > 0) {
            echo "<h2>Docentes</h2>";
            echo "<table>
                    <tr class='docentes'>
                        <th>Seleccionar</th>
                        <th>Matrícula</th>
                        <th>Nombre Completo</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Usuario</th>
                    </tr>";

            // Mostrar solo los Docentes
            while ($row = $result_docentes->fetch_assoc()) {
                echo "<tr>
                        <td><input type='radio' name='id' value='" . $row["matricula"] . "'></td>
                        <td>" . $row["matricula"] . "</td>
                        <td>" . $row["nombre_completo"] . "</td>
                        <td>" . $row["carrera"] . "</td>
                        <td>" . $row["semestre"] . "</td>
                        <td>" . $row["username"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron docentes.</p>";
        }

        // Botón para actualizar
        echo "<div class='button-container'>";
        echo "<input type='submit' value='Actualizar'>";
        echo "<a href='Menu.php'>Salir</a>";
        echo "</div>";

        echo "</form>";

        $conn->close();
        ?>
    </div>
</body>
</html>
