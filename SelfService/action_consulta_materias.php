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
// semestre , area, nombre, clave, carrera
$check = [0, 0, 0, 0, 0];
$nombre = $_POST['nombre'];
$nombre = ($nombre === "") ? NULL : $nombre;
if($nombre != NULL){
    $check[2] = 1 ;
}
//---------------------------------------------
$clave= $_POST['clave'];
$clave = ($clave === "") ? NULL : $clave;
if($clave != NULL){
    $check[3] = 1 ;
}
//-----------------------------------------------
$area= $_POST['area'];
$area = ($area === "") ? NULL : $area;
if($area != NULL){
    $check[1] = 1 ;
}
//---------------------------------------------
$semestre= $_POST['semestre'];
$semestre = ($semestre === "") ? NULL : $semestre;
if($semestre != NULL){
    $check[0] = 1 ;
}
//-----------------------------------------------
$carrera= $_POST['carrera'];
$carrera = ($carrera === "") ? NULL : $carrera;
if($carrera != NULL){
    $check[4] = 1 ;
}
//----------------------------------------------
$servername = "localhost";
$username = "root";
$contrasena = "";
$dbname = "t15a_proyecto";

$conn = new mysqli($servername, $username, $contrasena, $dbname);
//caso con todo seleccionado 
if($check[0] == 1 && $check[1] == 1 && $check[2]==1 &&$check[3]==1 &&$check[4]==1){
    $cadQuery = "SELECT 
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
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso sin nada seleccionado
if($check[0] == 0 && $check[1] == 0 && $check[2]==0 &&$check[3]==0 && $check[4]==0){
    $cadQuery = "SELECT 
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
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}

//---------------------------------------------------casos donde un campo no existe----------------------------------------------------------
//caso donde carrera no existe
if($check[0] == 1 && $check[1] == 1 && $check[2]==1 &&$check[3]==1 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area 
        WHERE M.semestre = '$semestre' AND A.area = '$area' AND M.nombre_materia LIKE '%$nombre%' AND M.clave_materia = '$clave'";
    
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso donde clave no existe
if($check[0] == 1 && $check[1] == 1 && $check[2]==1 &&$check[3]==0 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area 
        WHERE M.semestre = '$semestre' AND A.area = '$area' AND M.nombre_materia LIKE '%$nombre%' AND M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso donde nombre no existe
if($check[0] == 1 && $check[1] == 1 && $check[2]==0 &&$check[3]==1 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
        WHERE M.semestre = '$semestre' AND A.area = '$area'AND M.clave_materia = '$clave' AND M.carrera = $carrera";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso donde area no existe
if($check[0] == 1 && $check[1] == 0 && $check[2]==1 &&$check[3]==1 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area   
    WHERE M.semestre = '$semestre' AND M.nombre_materia LIKE '%$nombre%' AND M.clave_materia = '$clave' AND M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["clave_materia"] . "</td>
                    <td>" . $row["numero_horas"] . "</td>
                    <td>" . $row["creditos"] . "</td>
                    <td>" . $row["semestre"] . "</td>
                    <td>" . $row["materia_anterior"] . "</td>
                    <td>" . $row["area"] . "</td>
                    <td>" . $row["carrera"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso donde semestre no existe
if($check[0] == 0 && $check[1] == 1 && $check[2]==1 &&$check[3]==1 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE A.area= '$area' AND M.nombre_materia LIKE '%$nombre%' AND M.clave_materia = '$clave' AND M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}

//---------------------------------------------------casos donde 2 campos no existen---------------------------------------------------------- 
// semestre , area, nombre, clave, carrera
//Caso sin nombre y clave
if($check[0] == 1 && $check[1] == 1 && $check[2]==0 &&$check[3]==0 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area   
    WHERE M.semestre = '$semestre' AND A.area = '$area' AND M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//Caso sin nombre y area
if($check[0] == 1 && $check[1] == 0 && $check[2]==0 &&$check[3]==1 && $check[4]==1){
   $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area   
    WHERE M.semestre = '$semestre' AND M.clave_materia = '$clave' AND M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//Caso sin nombre y semestre
if($check[0] == 0 && $check[1] == 1 && $check[2]==0 &&$check[3]==1 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.clave_materia = '$clave' AND A.area = '$area' AND M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//Caso sin nombre y carrera
if($check[0] == 1 && $check[1] == 0 && $check[2]==1 &&$check[3]==1 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.semestre = '$semestre' AND M.clave_materia = '$clave' AND A.area = '$area'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso sin clave y sin area
if($check[0] == 1 && $check[1] == 0 && $check[2]==1 &&$check[3]==0 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.semestre = '$semestre' AND M.nombre_materia LIKE '%$nombre%'AND M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["clave_materia"] . "</td>
                    <td>" . $row["numero_horas"] . "</td>
                    <td>" . $row["creditos"] . "</td>
                    <td>" . $row["semestre"] . "</td>
                    <td>" . $row["nombre_materia_anterior"] . "</td>
                    <td>" . $row["nombre-area"] . "</td>
                    <td>" . $row["carrera"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso sin clave y sin semestre
if($check[0] == 0 && $check[1] == 1 && $check[2]==1 &&$check[3]==0 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area   
    WHERE A.area = '$area' AND M.nombre_materia LIKE '%$nombre%'AND M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso sin clave y sin carrera
if($check[0] == 1 && $check[1] == 1 && $check[2]==1 &&$check[3]==0 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.semestre = '$semestre' AND M.nombre_materia LIKE '%$nombre%'AND A.area = '$area'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso sin area y sin semestre
if($check[0] == 0 && $check[1] == 0 && $check[2]==1 &&$check[3]==1 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.nombre_materia LIKE '%$nombre%' AND M.clave_materia = '$clave' AND M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso sin area y sin carrera
if($check[0] == 1 && $check[1] == 0 && $check[2]==1 &&$check[3]==1 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.semestre = '$semestre' AND M.nombre_materia LIKE '%$nombre%' AND M.clave_materia = '$clave'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso sin semestre y sin carrera
if($check[0] == 0 && $check[1] == 1 && $check[2]==1 &&$check[3]==1 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area   
    WHERE A.area= '$area' AND M.nombre_materia LIKE '%$nombre%' AND M.clave_materia = '$clave'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//---------------------------------------------------casos donde 3 campos no existen----------------------------------------------------------
// semestre , area, nombre, clave, carrera
//caso de nombre con clave
if($check[0] == 0 && $check[1] == 0 && $check[2]==1 &&$check[3]==1 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.nombre_materia LIKE '%$nombre%' AND M.clave_materia ='$clave'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso de nombre con area
if($check[0] == 0 && $check[1] == 1 && $check[2]==1 &&$check[3]==0 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.nombre_materia LIKE '%$nombre%' AND A.area = '$area'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["nombre_materia"] . "</td>
                    <td>" . $row["clave_materia"] . "</td>
                    <td>" . $row["numero_horas"] . "</td>
                    <td>" . $row["creditos"] . "</td>
                    <td>" . $row["semestre"] . "</td>
                    <td>" . $row["Nombre_materia_anterior"] . "</td>
                    <td>" . $row["Nombre_area"] . "</td>
                    <td>" . $row["carrera"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso de nombre con semestre
if($check[0] == 1 && $check[1] == 0 && $check[2]==1 &&$check[3]==0 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area   
    WHERE M.nombre_materia LIKE '%$nombre%' and M.semestre = '$semestre'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso de nombre con carrera
if($check[0] == 0 && $check[1] == 0 && $check[2]==1 &&$check[3]==0 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.nombre_materia LIKE '%$nombre%' and M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso de clave con area
if($check[0] == 0 && $check[1] == 1 && $check[2]==0 &&$check[3]==1 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area   
    WHERE M.clave_materia = '$clave' and A.area='$area'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso de clave con semestre
if($check[0] == 1 && $check[1] == 0 && $check[2]==0 &&$check[3]==1 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.clave_materia = '$clave' and M.semestre = '$semestre'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso de clave con carrera
if($check[0] == 0 && $check[1] == 0 && $check[2]==0 &&$check[3]==1 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.clave_materia = '$clave' and M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso de area con semestre
if($check[0] == 1 && $check[1] == 1 && $check[2]==0 && $check[3]==0 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.semestre = '$semestre' AND A.area = '$area'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso de area con carrera
if($check[0] == 0 && $check[1] == 1 && $check[2]==0 && $check[3]==0 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area   
    WHERE M.carrera = '$carrera' AND A.area = '$area'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso de semestre con carrera
if($check[0] == 1 && $check[1] == 0 && $check[2]==0 && $check[3]==0 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area   
    WHERE M.carrera = '$carrera' AND M.semestre = '$semestre'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//-----------------------------------------------------------------------------------casos unicos---------------------------------------------- 
//caso unico con semestre
if($check[0] == 1 && $check[1] == 0 && $check[2]==0 &&$check[3]==0 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.semestre = '$semestre'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso unico con area
if($check[0] == 0 && $check[1] == 1 && $check[2]==0 &&$check[3]==0 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE A.area = '$area'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso unico con nombre
if($check[0] == 0 && $check[1] == 0 && $check[2]==1 &&$check[3]==0 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.nombre_materia LIKE '%$nombre%'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso unico con clave
if($check[0] == 0 && $check[1] == 0 && $check[2]==0 &&$check[3]==1 && $check[4]==0){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  
    WHERE M.clave_materia = '$clave'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//caso unico con carrera
if($check[0] == 0 && $check[1] == 0 && $check[2]==0 &&$check[3]==0 && $check[4]==1){
    $cadQuery = "SELECT 
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
        INNER JOIN academias A ON A.area = M.area  WHERE M.carrera = '$carrera'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Nombre Materia</th>
                <th>Clave Materia</th>
                <th>Numero de horas</th>
                <th>Creditos</th>
                <th>Semestre</th>
                <th>Materia Anterior</th>
                <th>Area</th>
                <th>Carrera</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
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
        echo "<a href='ConsultaMaterias.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}
//------------------------------------------------------------------------------------------------------------------------------------------------- 
$conn->close();
?>
    </div>
</body>
</html>
