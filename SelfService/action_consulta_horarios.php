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

$check = [0,0];
$tipo_h = $_POST['tipoHorario'];
$hora = $_POST['hora'];

$tipo_h= ($tipo_h === "") ? NULL : $tipo_h;
if($tipo_h!= NULL){
    $check[0] = 1 ;
}
$hora= ($hora === "") ? NULL : $hora;
if($hora != NULL){
    $check[1] = 1 ;
}

if($check[0] == 0 && $check[1] == 0){
    $cadQuery = "SELECT * FROM horarios";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Tipo</th>
                <th>Hora Lunes</th>
                <th>Hora Martes</th>
                <th>Hora Miercoles</th>
                <th>Hora Jueves</th>
                <th>Hora Viernes</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["tipo"] . "</td>
                    <td>" . $row["hora_lunes"] . "</td>
                    <td>" . $row["hora_martes"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["hora_jueves"] . "</td>
                    <td>" . $row["hora_viernes"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaHorarios.php'>Salir</a>";
    }
}
if($check[0] == 1 && $check[1] == 0){
    $cadQuery = "SELECT * FROM horarios where tipo = '$tipo_h'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Tipo</th>
                <th>Hora Lunes</th>
                <th>Hora Martes</th>
                <th>Hora Miercoles</th>
                <th>Hora Jueves</th>
                <th>Hora Viernes</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["tipo"] . "</td>
                    <td>" . $row["hora_lunes"] . "</td>
                    <td>" . $row["hora_martes"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["hora_jueves"] . "</td>
                    <td>" . $row["hora_viernes"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaHorarios.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}
if($check[0] == 0 && $check[1] == 1){
    $cadQuery = "SELECT * FROM horarios where hora_lunes ='$hora' OR hora_martes ='$hora'OR hora_miercoles ='$hora'OR hora_jueves ='$hora'OR hora_viernes ='$hora'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Tipo</th>
                <th>Hora Lunes</th>
                <th>Hora Martes</th>
                <th>Hora Miercoles</th>
                <th>Hora Jueves</th>
                <th>Hora Viernes</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["tipo"] . "</td>
                    <td>" . $row["hora_lunes"] . "</td>
                    <td>" . $row["hora_martes"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["hora_jueves"] . "</td>
                    <td>" . $row["hora_viernes"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaHorarios.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}
if($check[0] == 1 && $check[1] == 1){
    $cadQuery = "SELECT * FROM horarios where tipo = '$tipo_h' AND hora_miercoles ='$hora'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Tipo</th>
                <th>Hora Lunes</th>
                <th>Hora Martes</th>
                <th>Hora Miercoles</th>
                <th>Hora Jueves</th>
                <th>Hora Viernes</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["tipo"] . "</td>
                    <td>" . $row["hora_lunes"] . "</td>
                    <td>" . $row["hora_martes"] . "</td>
                    <td>" . $row["hora_miercoles"] . "</td>
                    <td>" . $row["hora_jueves"] . "</td>
                    <td>" . $row["hora_viernes"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaHorarios.php'>Salir</a>";
    }else{
        echo"Resultados no encontrados";
    }
}
$conn->close();
?>
    </div>
</body>
</html>