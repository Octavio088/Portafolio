<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'mysql';
$link = mysqli_connect($server, $user, $pass, $database);
if(!$link) { header("Location: Login.php"); exit; }
$database = 't15a_proyecto';
mysqli_select_db($link, $database);

// Consulta para obtener las carreras
$sql = "SELECT carrera, nombre FROM carreras";
$result = mysqli_query($link, $sql);

$sql_materias = "SELECT materia,nombre_materia FROM materias";
$result_materias = mysqli_query($link, $sql_materias);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($link));
}
if (!$result_materias) {
    die("Error en la consulta de materias: " . mysqli_error($link));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Formulario_inserta_estilo.css">
</head>
<body>
    <div class="container">
        <h2>Insertar materias</h2>
        <form action="action_guardar_materias.php" method="post">
            
            <div class="form-fila">
                <div class="form-grupo">
                    <label>Nombre de la Materia</label>
                    <input type="text" name="nombre_materia" required>
                </div>
                <div class="form-grupo">
                    <label>Clave de la materia</label>
                    <input type="text" name="clave_materia" required>
                </div>
            </div>

            <div class="form-fila">
                <div class="form-grupo">
                    <label>Numero de horas</label>
                    <select name="numero_horas" required>
                        <option value="">Selecciona el numero de horas</option>
                        <option value="48">48</option>
                        <option value="80">80</option>
                    </select>
                </div>
                <div class="form-grupo">
                    <label>Creditos</label>
                    <select name="creditos" required>
                        <option value="">Selecciona los creditos</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                </div>
            </div>

            <div class="form-fila">
                <div class="form-grupo">
                    <label>Semestre</label>
                    <select name="semestre" required>
                        <option value="">Selecciona un semestre</option>
                        <option value="1">Semestre I</option>
                        <option value="2">Semestre II</option>
                        <option value="3">Semestre III</option>
                        <option value="4">Semestre IV</option>
                        <option value="5">Semestre V</option>
                        <option value="6">Semestre VI</option>
                        <option value="7">Semestre VII</option>
                        <option value="8">Semestre VIII</option>
                        <option value="9">Semestre IX</option>
                        <option value="10">Semestre X</option>
                    </select>
                </div>
                <div class="form-grupo">
                    <label>Materia anterior</label>
                    <select name="materia_anterior" required>
                        <option value="">Selecciona una Materia</option>
                        <?php
                            if ($result_materias->num_rows > 0) {
                                while ($row = $result_materias->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['materia']) . "'>" . htmlspecialchars($row['nombre_materia']) . "</option>";
                                }
                            } else {
                                echo "<option value=''>No hay materias disponibles</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="form-fila">
                <div class="form-grupo">
                    <label>Area</label>
                    <select name="area" required>
                        <option value="">Selecciona una Area</option>
                        <option value="1">Ciencias Básicas</option>
                        <option value="2">Ciencias de la Ingenieria</option>
                        <option value="3">Ciencias de la Ingenieria Aplicada</option>
                        <option value="4">Ciencias Sociales y Humanidades</option>
                        <option value="5">Inglés</option>
                    </select>
                </div>
                <div class="form-grupo">
                <label>Carrera</label>
                    <select name="carrera" required>
                    <option value="">Selecciona una carrera</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['carrera']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No hay carreras disponibles</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <button type="submit">Guardar Materia</button>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($link);
?>