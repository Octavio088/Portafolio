<?php
    $usuario = $_COOKIE['matri'];
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'mysql';
    $link = mysqli_connect($server, $user, $pass, $database);
    mysqli_set_charset($link, "utf8");
    if (!$link) {header("Location: Login.php");}
    $database = 't15a_proyecto';
    mysqli_select_db($link, $database);

    $query = "SELECT usuarios.nombre_completo, calificaciones.u1, calificaciones.u2, calificaciones.u3, calificaciones.uf, calificaciones.Final, calificaciones.ee, 
    grupos.clave_grupo, materias.nombre_materia 
    FROM calificaciones 
    INNER JOIN grupos ON calificaciones.grupo = grupos.grupo 
    INNER JOIN usuarios ON usuarios.matricula = $usuario
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE alumno = $usuario;";

    $result = $link->query($query);
    if($result->num_rows > 0){
        echo "<table border  = 1px >
                <tr>
                    <th>Clave de Grupo</th>
                    <th>Nombre Materia</th>
                    <th>Primer Parcial</th>
                    <th>Segundo Parcial</th>
                    <th>Tercer Parcial</th>
                    <th>Parcial Final</th>
                    <th>Calificacion Final</th>
                </tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>".$row["nombre_materia"]."</td>
                    <td>" . $row["u1"] . "</td>
                    <td>" . $row["u2"] . "</td>
                    <td>" . $row["u3"] . "</td>
                    <td>" . $row["uf"] . "</td>
                    <td>" . $row["Final"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='Grupos_profes.php'>Salir</a>";
    }else {
        echo "<p>No se encontraron resultados.</p>";
        echo "<a href='Grupos_profes.php'>Salir</a>";
    }
?>