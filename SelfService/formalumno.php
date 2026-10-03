<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
    font-family: "Quicksand", sans-serif;
    background-color: #2c2c2c; /* Fondo oscuro */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 100vh; /* Ocupar toda la altura de la ventana */
    color: #f0f0f0; /* Texto en color claro */
}
.container {
    background: #3b3b3b; /* Fondo del contenedor */
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
    width: 100%; /* Ocupar el 100% del ancho */
    max-width: 600px; /* Limitar el ancho máximo para pantallas grandes */
    box-sizing: border-box;
}
.form-group {
    margin-bottom: 10px;
}
.form-control {
    width: 100%;
    padding: 10px;
    border: none; /* Sin borde */
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #4a4a4a; /* Color de fondo para los campos */
    color: #f0f0f0; /* Texto en color claro */
    margin: 10px 0px;
    transition: all 0.2s;
}
.form-control:focus {
    outline: none; /* Sin contorno al enfocar */
    background-color: #5a5a5a; /* Color de fondo al enfocar */
    border-left: 5px solid #0145ff;
}

.button-group{
    display: flex;
    flex-direction: row;
}

h2{
    text-align: center;
}

button.btn {
    width: 100%;
    padding: 10px;
    background-color: #0145ff; /* Color naranja para el botón */
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin: 20px 10px;
}
button.btn:hover {
    background-color: #0c00ad; /* Color más oscuro al pasar el mouse */
}
.help-block {
    font-size: 10px;
    color: #aaa; /* Texto de ayuda en color gris claro */
}

label{
    font-size: 17px;
    color: #959AAB;
    margin-bottom: 10px;
}
    </style>
</head>
<body>
<?php
        // conexion a base de datos  
        $server = 'localhost';
        $user = 'root';
        $pass = '';
        $database = 'mysql';
        $link = mysqli_connect($server, $user, $pass, $database);
        if(!$link) { header("Location: Login.php"); }
        $database = 't15a_proyecto';
        mysqli_select_db($link, $database);
        //------------------------------------------------------------------
        $cadQuery = "SELECT matricula, nombre_completo FROM usuarios where tipo = 1"; // Manda llamar solo a los alumnos
        $query = mysqli_query($link, $cadQuery);
?>

<div class="container">
        <h2>Kardex de Alumno</h2>
        <form method="POST" action="cardex_profes.php">
        <label for="NombreAlumno">Selecciona un alumno:</label>
        <select name="NombreAlumno" id="NombreAlumno" class="form-control" required>
            <option value="" disabled selected>Selecciona un alumno</option> <!-- Opción predeterminada -->
            <?php
                // Suponiendo que ya tienes la conexión y la consulta ejecutada
                while ($row = $query->fetch_assoc()) {
                    echo "<option value='" . $row['matricula'] . "'>" . $row['nombre_completo'] . "</option>";
                }
            ?>
        </select>
        <button class="btn" type="submit">Enviar</button>
        </form>

    </div>
</body>
</html>