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
$check = [0, 0, 0];
$matricula= $_POST['matricula'];
$matricula = ($matricula === "") ? NULL : $matricula;
if($matricula != NULL){
    $check[0] = 1 ;
}
$tipo= $_POST['varTipo'];
$tipo = ($tipo === "") ? NULL : $tipo;
if($tipo != NULL){
    $check[1] = 1 ;
}
$carrera= $_POST['varCarrera'];
$carrera = ($carrera === "") ? NULL : $carrera;
if($carrera != NULL){
    $check[2] = 1 ;
}

$servername = "localhost";
$username = "root";
$contrasena = "";
$dbname = "t15a_proyecto";

$conn = new mysqli($servername, $username, $contrasena, $dbname);

if($check[0] == 1){ //si la matricula no es nula
    if($check[1] == 1){ //que cheque si el tipo no es nulo
        if($check[2] == 1){ // que cheque si la carrera no es nula
            $cadQuery = "SELECT 
            usuarios.matricula, 
            usuarios.nombre_completo, 
            carreras.nombre AS 'carrera', 
            usuarios.generacion,
            usuarios.semestre, 
            usuarios.username,
            usuarios.password,
            tipousuarios.nombre AS 'user'
            FROM usuarios
            INNER JOIN carreras ON carreras.carrera = usuarios.carrera
            INNER JOIN tipousuarios ON usuarios.tipo = tipousuarios.tipo
            WHERE usuarios.matricula = $matricula AND usuarios.carrera = $carrera AND usuarios.tipo = $tipo";
            $result = $conn->query($cadQuery);
            if ($result->num_rows > 0) {
                echo "<table>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre Completo</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Usuario</th>
                        <th>Tipo</th>
                    </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["matricula"] . "</td>
                            <td>" . $row["nombre_completo"] . "</td>
                            <td>" . $row["carrera"] . "</td>
                            <td>" . $row["semestre"] . "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["user"] . "</td>
                        </tr>";
                }
                echo "</table>";
                echo "<a href='ConsultaUsuarios.php'>Salir</a>";
            }else{
            echo"No hay resultados";}
        }else{
            $cadQuery = "SELECT 
            usuarios.matricula, 
            usuarios.nombre_completo, 
            carreras.nombre AS 'carrera', 
            usuarios.generacion,
            usuarios.semestre, 
            usuarios.username,
            usuarios.password,
            tipousuarios.nombre AS 'user'
            FROM usuarios
            INNER JOIN carreras ON carreras.carrera = usuarios.carrera
            INNER JOIN tipousuarios ON usuarios.tipo = tipousuarios.tipo 
            WHERE usuarios.matricula = '$matricula' AND usuarios.tipo = '$tipo'";
            $result = $conn->query($cadQuery);
            if ($result->num_rows > 0) {
                echo "<table>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre Completo</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Usuario</th>
                        <th>Tipo</th>
                    </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["matricula"] . "</td>
                            <td>" . $row["nombre_completo"] . "</td>
                            <td>" . $row["carrera"] . "</td>
                            <td>" . $row["semestre"] . "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["user"] . "</td>
                        </tr>";
                }
                echo "</table>";
                echo "<a href='ConsultaUsuarios.php'>Salir</a>";
            }else{
            echo"No hay resultados";}
        }
    }elseif($check[2] == 1){ //si el tipo es nulo pero la carrera no es nula
        $cadQuery = "SELECT 
        usuarios.matricula, 
        usuarios.nombre_completo, 
        carreras.nombre AS 'carrera', 
        usuarios.generacion,
        usuarios.semestre, 
        usuarios.username,
        usuarios.password,
        tipousuarios.nombre AS 'user'
        FROM usuarios
        INNER JOIN carreras ON carreras.carrera = usuarios.carrera
        INNER JOIN tipousuarios ON usuarios.tipo = tipousuarios.tipo 
        WHERE usuarios.matricula = '$matricula' AND usuarios.carrera = '$carrera'";
        $result = $conn->query($cadQuery);
        if ($result->num_rows > 0) {
            echo "<table>
                <tr>
                    <th>Matrícula</th>
                    <th>Nombre Completo</th>
                    <th>Carrera</th>
                    <th>Semestre</th>
                    <th>Usuario</th>
                    <th>Tipo</th>
                </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                            <td>" . $row["matricula"] . "</td>
                            <td>" . $row["nombre_completo"] . "</td>
                            <td>" . $row["carrera"] . "</td>
                            <td>" . $row["semestre"] . "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["user"] . "</td>
                    </tr>";
            }
            echo "</table>";
            echo "<a href='ConsultaUsuarios.php'>Salir</a>";
        }else{
        echo"No hay resultados";}
    }
}elseif ($check[1] == 1 && $check[2] == 1) { //si la matricula es nula pero lo otro no entonces:
    $cadQuery = "SELECT 
    usuarios.matricula, 
    usuarios.nombre_completo, 
    carreras.nombre AS 'carrera', 
    usuarios.generacion,
    usuarios.semestre, 
    usuarios.username,
    usuarios.password,
    tipousuarios.nombre AS 'user'
    FROM usuarios
    INNER JOIN carreras ON carreras.carrera = usuarios.carrera
    INNER JOIN tipousuarios ON usuarios.tipo = tipousuarios.tipo 
    WHERE usuarios.tipo = '$tipo' AND usuarios.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Matrícula</th>
                <th>Nombre Completo</th>
                <th>Carrera</th>
                <th>Semestre</th>
                <th>Usuario</th>
                <th>Tipo</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                            <td>" . $row["matricula"] . "</td>
                            <td>" . $row["nombre_completo"] . "</td>
                            <td>" . $row["carrera"] . "</td>
                            <td>" . $row["semestre"] . "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["user"] . "</td>
                        </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaUsuarios.php'>Salir</a>";
    }else{
    echo"No hay resultados";}
}elseif ($check[1] == 1 && $check[2] == 0) { //si la matricula es nula pero y la carrera tambien:
    $cadQuery = "SELECT 
    usuarios.matricula, 
    usuarios.nombre_completo, 
    carreras.nombre AS 'carrera', 
    usuarios.generacion,
    usuarios.semestre, 
    usuarios.username,
    usuarios.password,
    tipousuarios.nombre AS 'user'
    FROM usuarios
    INNER JOIN carreras ON carreras.carrera = usuarios.carrera
    INNER JOIN tipousuarios ON usuarios.tipo = tipousuarios.tipo
    WHERE usuarios.tipo = '$tipo'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Matrícula</th>
                <th>Nombre Completo</th>
                <th>Carrera</th>
                <th>Semestre</th>
                <th>Usuario</th>
                <th>Tipo</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                            <td>" . $row["matricula"] . "</td>
                            <td>" . $row["nombre_completo"] . "</td>
                            <td>" . $row["carrera"] . "</td>
                            <td>" . $row["semestre"] . "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["user"] . "</td>
                        </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaUsuarios.php'>Salir</a>";
    }else{
    echo"No hay resultados";}
}
elseif ($check[1] == 0 && $check[2] == 1) { //si la matricula es nula pero el tipo es nulo y la carrera no:
    $cadQuery = "SELECT 
    usuarios.matricula, 
    usuarios.nombre_completo, 
    carreras.nombre AS 'carrera', 
    usuarios.generacion,
    usuarios.semestre, 
    usuarios.username,
    usuarios.password,
    tipousuarios.nombre AS 'user'
    FROM usuarios
    INNER JOIN carreras ON carreras.carrera = usuarios.carrera
    INNER JOIN tipousuarios ON usuarios.tipo = tipousuarios.tipo
    WHERE usuarios.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Matrícula</th>
                <th>Nombre Completo</th>
                <th>Carrera</th>
                <th>Semestre</th>
                <th>Usuario</th>
                <th>Tipo</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                            <td>" . $row["matricula"] . "</td>
                            <td>" . $row["nombre_completo"] . "</td>
                            <td>" . $row["carrera"] . "</td>
                            <td>" . $row["semestre"] . "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["user"] . "</td>
                        </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaUsuarios.php'>Salir</a>";
    }else{
    echo"No hay resultados";}
}elseif ($check[1] == 0 && $check[2] == 0) {
    $cadQuery = "SELECT 
    usuarios.matricula, 
    usuarios.nombre_completo, 
    carreras.nombre AS 'carrera', 
    usuarios.generacion,
    usuarios.semestre, 
    usuarios.username,
    usuarios.password,
    tipousuarios.nombre AS 'user'
    FROM usuarios
    INNER JOIN carreras ON carreras.carrera = usuarios.carrera
    INNER JOIN tipousuarios ON usuarios.tipo = tipousuarios.tipo";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Matrícula</th>
                <th>Nombre Completo</th>
                <th>Carrera</th>
                <th>Semestre</th>
                <th>Usuario</th>
                <th>Tipo</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                            <td>" . $row["matricula"] . "</td>
                            <td>" . $row["nombre_completo"] . "</td>
                            <td>" . $row["carrera"] . "</td>
                            <td>" . $row["semestre"] . "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["user"] . "</td>
                        </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaUsuarios.php'>Salir</a>";
    }else{
    echo"No hay resultados";}
}

if($check[0] == 1 && $check[1] == 0 && $check[2] == 0){ // que cheque si la carrera no es nula
    $cadQuery = "SELECT 
    usuarios.matricula, 
    usuarios.nombre_completo, 
    carreras.nombre AS 'carrera', 
    usuarios.generacion,
    usuarios.semestre, 
    usuarios.username,
    usuarios.password,
    tipousuarios.nombre AS 'user'
    FROM usuarios
    INNER JOIN carreras ON carreras.carrera = usuarios.carrera
    INNER JOIN tipousuarios ON usuarios.tipo = tipousuarios.tipo
            WHERE usuarios.matricula = '$matricula'";
            $result = $conn->query($cadQuery);
            if ($result->num_rows > 0) {
                echo "<table>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre Completo</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Usuario</th>
                        <th>Tipo</th>
                    </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["matricula"] . "</td>
                    <td>" . $row["nombre_completo"] . "</td>
                    <td>" . $row["carrera"] . "</td>
                    <td>" . $row["semestre"] . "</td>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["user"] . "</td>
                </tr>";
                }
                echo "</table>";
                echo "<a href='ConsultaUsuarios.php'>Salir</a>";
            }else{
            echo"No hay resultados";}
        }
$conn->close();
?>
</div>
</body>
</html>