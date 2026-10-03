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
$edificio = $_POST['edificio'];
$edificio = ($edificio === "") ? NULL : $edificio;
if($edificio != NULL){
    $check[0] = 1 ;
}
//---------------------------------------------------------------------------------
if($check[0] == 1){
    $cadQuery = "SELECT * FROM salones WHERE nombre_salon = '$edificio'";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave del Salon</th>
                <th>Nombre del Salon</th>
                <th>Ubicacion fisica</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_salon"] . "</td>
                    <td>" . $row["nombre_salon"] . "</td>
                    <td>" . $row["ubicacion_fisica"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaSalones.php'>Salir</a>";
    }else{
    echo"No hay resultados";}    
}elseif ($check[0] == 0) {
    $cadQuery = "SELECT * FROM salones";
    $result = $conn->query($cadQuery);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Clave del Salon</th>
                <th>Nombre del Salon</th>
                <th>Ubicacion fisica</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["clave_salon"] . "</td>
                    <td>" . $row["nombre_salon"] . "</td>
                    <td>" . $row["ubicacion_fisica"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='ConsultaSalones.php'>Salir</a>";
    }
}
$conn->close();
?>
    </div>
</body>
</html>