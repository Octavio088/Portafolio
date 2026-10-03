<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Tablas_consulta.css" />
</head>
<body>
    <div class="container">
    <?php
$servername = "localhost";
$username = "root";
$contrasena = "";
$dbname = "t15a_proyecto";

$conn = new mysqli($servername, $username, $contrasena, $dbname);
//primero vamos a checar que campos lleno el usuario para ver que vamos a considerar pa buscar el grupo.
$check = [0,0,0,0,0];

//recopilamos los valores del forms
$materia= $_POST['materia'];
$horario = $_POST['horario'];
$maestro= $_POST['maestro'];
$salon = $_POST['salon'];
$claveGrupo = $_POST['claveGrupo'];
//te explico uno pa que sepas que pedo, al fin todas son iguales
$materia= ($materia === "") ? NULL : $materia; // si materia esta vacio, entonces en NULL si no es el valor que ya traia materia
if($materia!= NULL){ //si materia es diferente a NULL en el array de check en la primer posicion se pone 1 pa saber que debemos usar ese filtro
    $check[0] = 1 ;
}
$horario = ($horario === "") ? NULL : $horario;
if($horario != NULL){
    $check[1] = 1 ;
}
$maestro= ($maestro === "") ? NULL : $maestro;
if($maestro!= NULL){
    $check[2] = 1 ;
}
$salon = ($salon  === "") ? NULL : $salon ;
if($salon  != NULL){
    $check[3] = 1 ;
}
$claveGrupo= ($claveGrupo === "") ? NULL : $claveGrupo;
if($claveGrupo != NULL){
    $check[4] = 1 ;
}

if ($check[0] == 0 && $check[1] == 0 && $check[2] == 0 && $check[3] == 0 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    } else {
        echo "Resultados no encontrados";
    }
}

//caso de ejemplo: Cuando el usuario selecciona unicamente la materia:
// seguimos este orden: materia , horario, maestro, salon y clave de grupo
if($check[0] == 1 && $check[1] == 0 && $check[2] == 0 && $check[3] == 0 && $check[4] == 0){
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 2: Materia y horario
if ($check[0] == 1 && $check[1] == 1 && $check[2] == 0 && $check[3] == 0 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' AND grupos.horario = '$horario'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 3: Materia y maestro
if ($check[0] == 1 && $check[1] == 0 && $check[2] == 1 && $check[3] == 0 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' AND grupos.maestro = '$maestro'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 4: Materia y salón
if ($check[0] == 1 && $check[1] == 0 && $check[2] == 0 && $check[3] == 1 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' AND grupos.salon = '$salon'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 5: Materia y clave de grupo
if ($check[0] == 1 && $check[1] == 0 && $check[2] == 0 && $check[3] == 0 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 6: Solo horario
if ($check[0] == 0 && $check[1] == 1 && $check[2] == 0 && $check[3] == 0 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.horario = '$horario'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 7: Horario y maestro
if ($check[0] == 0 && $check[1] == 1 && $check[2] == 1 && $check[3] == 0 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.horario = '$horario' AND grupos.maestro = '$maestro'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 8: Horario y salón
if ($check[0] == 0 && $check[1] == 1 && $check[2] == 0 && $check[3] == 1 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.horario = '$horario' AND grupos.salon = '$salon'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 9: Horario y clave de grupo
if ($check[0] == 0 && $check[1] == 1 && $check[2] == 0 && $check[3] == 0 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.horario = '$horario' AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 10: Solo maestro
if ($check[0] == 0 && $check[1] == 0 && $check[2] == 1 && $check[3] == 0 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.maestro = '$maestro'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 11: Maestro y salón
if ($check[0] == 0 && $check[1] == 0 && $check[2] == 1 && $check[3] == 1 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.maestro = '$maestro' AND grupos.salon = '$salon'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 12: Maestro y clave de grupo
if ($check[0] == 0 && $check[1] == 0 && $check[2] == 1 && $check[3] == 0 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.maestro = '$maestro' AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 13: Solo salón
if ($check[0] == 0 && $check[1] == 0 && $check[2] == 0 && $check[3] == 1 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.salon = '$salon'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 14: Salón y clave de grupo
if ($check[0] == 0 && $check[1] == 0 && $check[2] == 0 && $check[3] == 1 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.salon = '$salon' AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Caso 15: Solo clave de grupo
if ($check[0] == 0 && $check[1] == 0 && $check[2] == 0 && $check[3] == 0 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

if ($check[0] == 1 && $check[1] == 1 && $check[2] == 1 && $check[3] == 1 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.horario = '$horario' 
    AND grupos.maestro = '$maestro' 
    AND grupos.salon = '$salon' 
    AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

if ($check[0] == 1 && $check[1] == 1 && $check[2] == 1 && $check[3] == 0 && $check[4] == 0) { 
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.horario = '$horario' 
    AND grupos.maestro = '$maestro'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Materia, Horario, y Salon
elseif ($check[0] == 1 && $check[1] == 1 && $check[2] == 0 && $check[3] == 1 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.horario = '$horario' 
    AND grupos.salon = '$salon'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Materia, Horario, y Clave de Grupo
elseif ($check[0] == 1 && $check[1] == 1 && $check[2] == 0 && $check[3] == 0 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.horario = '$horario' 
    AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Materia, Maestro, y Salon
elseif ($check[0] == 1 && $check[1] == 0 && $check[2] == 1 && $check[3] == 1 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.maestro = '$maestro' 
    AND grupos.salon = '$salon'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Materia, Maestro, y Clave de Grupo
elseif ($check[0] == 1 && $check[1] == 0 && $check[2] == 1 && $check[3] == 0 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.maestro = '$maestro' 
    AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Materia, Salon, y Clave de Grupo
elseif ($check[0] == 1 && $check[1] == 0 && $check[2] == 0 && $check[3] == 1 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.salon = '$salon' 
    AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Horario, Maestro, y Salon
elseif ($check[0] == 0 && $check[1] == 1 && $check[2] == 1 && $check[3] == 1 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.horario = '$horario' 
    AND grupos.maestro = '$maestro' 
    AND grupos.salon = '$salon'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Horario, Maestro, y Clave de Grupo
elseif ($check[0] == 0 && $check[1] == 1 && $check[2] == 1 && $check[3] == 0 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.horario = '$horario' 
    AND grupos.maestro = '$maestro' 
    AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Horario, Salon, y Clave de Grupo
elseif ($check[0] == 0 && $check[1] == 1 && $check[2] == 0 && $check[3] == 1 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.horario = '$horario' 
    AND grupos.salon = '$salon' 
    AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Maestro, Salon, y Clave de Grupo
elseif ($check[0] == 0 && $check[1] == 0 && $check[2] == 1 && $check[3] == 1 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.maestro = '$maestro' 
    AND grupos.salon = '$salon' 
    AND grupos.clave_grupo = '$claveGrupo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave de grupo</th>
                <th>Maestro</th>
                <th>Materia</th>
                <th>Horario</th>
                <th>Salon</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_grupo"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["clave_salon"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='forms_buscar_grupos.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}

// Materia, Horario, Maestro, y Salon
if ($check[0] == 1 && $check[1] == 1 && $check[2] == 1 && $check[3] == 1 && $check[4] == 0) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.horario = '$horario' 
    AND grupos.maestro = '$maestro' 
    AND grupos.salon = '$salon'";
     $result = $conn->query($cadQuery);
     if ($result->num_rows > 0) {
         echo "<table>
             <tr>
                 <th>Clave de grupo</th>
                 <th>Maestro</th>
                 <th>Materia</th>
                 <th>Horario</th>
                 <th>Salon</th>
             </tr>";
         while ($row = $result->fetch_assoc()) {
             echo "<tr>
                     <td>" . $row["clave_grupo"] . "</td>
                     <td>" . $row["nombre_completo"] . "</td>
                     <td>" . $row["nombre_materia"] . "</td>
                     <td>" . $row["hora_miercoles"] . "</td>
                     <td>" . $row["clave_salon"] . "</td>
                 </tr>";
         }
         echo "</table>";
         echo "<a href='forms_buscar_grupos.php'>Salir</a>";
     }else{
         echo"Resultados no encontrados";
     }
}

// Materia, Horario, Maestro, y Clave de Grupo
elseif ($check[0] == 1 && $check[1] == 1 && $check[2] == 1 && $check[3] == 0 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.horario = '$horario' 
    AND grupos.maestro = '$maestro' 
    AND grupos.clave_grupo = '$claveGrupo'";
     $result = $conn->query($cadQuery);
     if ($result->num_rows > 0) {
         echo "<table>
             <tr>
                 <th>Clave de grupo</th>
                 <th>Maestro</th>
                 <th>Materia</th>
                 <th>Horario</th>
                 <th>Salon</th>
             </tr>";
         while ($row = $result->fetch_assoc()) {
             echo "<tr>
                     <td>" . $row["clave_grupo"] . "</td>
                     <td>" . $row["nombre_completo"] . "</td>
                     <td>" . $row["nombre_materia"] . "</td>
                     <td>" . $row["hora_miercoles"] . "</td>
                     <td>" . $row["clave_salon"] . "</td>
                 </tr>";
         }
         echo "</table>";
         echo "<a href='forms_buscar_grupos.php'>Salir</a>";
     }else{
         echo"Resultados no encontrados";
     }
}

// Materia, Horario, Salon, y Clave de Grupo
elseif ($check[0] == 1 && $check[1] == 1 && $check[2] == 0 && $check[3] == 1 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.horario = '$horario' 
    AND grupos.salon = '$salon' 
    AND grupos.clave_grupo = '$claveGrupo'";
     $result = $conn->query($cadQuery);
     if ($result->num_rows > 0) {
         echo "<table>
             <tr>
                 <th>Clave de grupo</th>
                 <th>Maestro</th>
                 <th>Materia</th>
                 <th>Horario</th>
                 <th>Salon</th>
             </tr>";
         while ($row = $result->fetch_assoc()) {
             echo "<tr>
                     <td>" . $row["clave_grupo"] . "</td>
                     <td>" . $row["nombre_completo"] . "</td>
                     <td>" . $row["nombre_materia"] . "</td>
                     <td>" . $row["hora_miercoles"] . "</td>
                     <td>" . $row["clave_salon"] . "</td>
                 </tr>";
         }
         echo "</table>";
         echo "<a href='forms_buscar_grupos.php'>Salir</a>";
     }else{
         echo"Resultados no encontrados";
     }
}

// Materia, Maestro, Salon, y Clave de Grupo
elseif ($check[0] == 1 && $check[1] == 0 && $check[2] == 1 && $check[3] == 1 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.materia = '$materia' 
    AND grupos.maestro = '$maestro' 
    AND grupos.salon = '$salon' 
    AND grupos.clave_grupo = '$claveGrupo'";
     $result = $conn->query($cadQuery);
     if ($result->num_rows > 0) {
         echo "<table>
             <tr>
                 <th>Clave de grupo</th>
                 <th>Maestro</th>
                 <th>Materia</th>
                 <th>Horario</th>
                 <th>Salon</th>
             </tr>";
         while ($row = $result->fetch_assoc()) {
             echo "<tr>
                     <td>" . $row["clave_grupo"] . "</td>
                     <td>" . $row["nombre_completo"] . "</td>
                     <td>" . $row["nombre_materia"] . "</td>
                     <td>" . $row["hora_miercoles"] . "</td>
                     <td>" . $row["clave_salon"] . "</td>
                 </tr>";
         }
         echo "</table>";
         echo "<a href='forms_buscar_grupos.php'>Salir</a>";
     }else{
         echo"Resultados no encontrados";
     }
}

// Horario, Maestro, Salon, y Clave de Grupo
elseif ($check[0] == 0 && $check[1] == 1 && $check[2] == 1 && $check[3] == 1 && $check[4] == 1) {
    $cadQuery = "SELECT grupos.*, usuarios.nombre_completo, horarios.hora_miercoles, salones.clave_salon, materias.nombre_materia FROM grupos
    INNER JOIN usuarios ON grupos.maestro = usuarios.matricula
    INNER JOIN horarios ON grupos.horario = horarios.horario  
    INNER JOIN salones ON grupos.salon = salones.salon
    INNER JOIN materias ON grupos.materia = materias.materia
    WHERE grupos.horario = '$horario' 
    AND grupos.maestro = '$maestro' 
    AND grupos.salon = '$salon' 
    AND grupos.clave_grupo = '$claveGrupo'";
     $result = $conn->query($cadQuery);
     if ($result->num_rows > 0) {
         echo "<table>
             <tr>
                 <th>Clave de grupo</th>
                 <th>Maestro</th>
                 <th>Materia</th>
                 <th>Horario</th>
                 <th>Salon</th>
             </tr>";
         while ($row = $result->fetch_assoc()) {
             echo "<tr>
                     <td>" . $row["clave_grupo"] . "</td>
                     <td>" . $row["nombre_completo"] . "</td>
                     <td>" . $row["nombre_materia"] . "</td>
                     <td>" . $row["hora_miercoles"] . "</td>
                     <td>" . $row["clave_salon"] . "</td>
                 </tr>";
         }
         echo "</table>";
         echo "<a href='forms_buscar_grupos.php'>Salir</a>";
     }else{
         echo"Resultados no encontrados";
     }
}
$conn->close();
?>
    </div>
</body>
</html>