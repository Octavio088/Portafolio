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
        
        $cadQuery_grupo = "SELECT grupos.grupo, grupos.clave_grupo, materias.nombre_materia FROM grupos INNER JOIN materias ON grupos.materia = materias.materia"; // Manda llamar a todas las materias que tenemosc
        $query_grupo = mysqli_query($link, $cadQuery_grupo);
    ?>
    <div class="container">
        <h2>Insertar Calificaciones</h2>
        <form action="Action_guarda_calificacion.php" method="post">

            <div class="form-fila">
                <div class="form-grupo">
                <label>Alumno</label>
            <select id="nombre_alumno" name="nombre_alumno">
            <option value="NULL">Selecciona un alumno</option>
                <?php
                    while ($row = $query->fetch_assoc()) {
                        echo "<option value='" . $row['matricula'] . "'>" . $row['nombre_completo'] . "</option>";
                    }
                ?>
            </select>
                </div>
                <div class="form-grupo">
                <label>Grupo</label>
            <select id="grupo" name="grupo" >
            <option value="NULL">Selecciona un grupo</option>
                <?php
                    while ($row = $query_grupo->fetch_assoc()) {
                        echo "<option value='" . $row['grupo'] . "'>" . $row['clave_grupo'] . "-". $row['nombre_materia'] ."</option>";
                    }
                ?>
            </select>
                </div>
            </div>
            <div class="form-fila">
                <div class="form-grupo">
                <label>Calificaciones Parcial 1</label>
            <select name="cal_u1">
                <option value="-1">No cursado</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
                </div>
                <div class="form-grupo">
                <label>Calificaciones Parcial 2</label>
            <select name="cal_u2">
                <option value="-1">No cursado</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
                </div>
            </div>
            <div class="form-fila">
                <div class="form-grupo">
                <label>Calificaciones Parcial 3</label>
            <select name="cal_u3">
                <option value="-1">No cursado</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
                </div>
                <div class="form-grupo">
                <label>Calificaciones del Final</label>
            <select name="cal_uf">
                <option value="-1">No cursado</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
                </div>
            </div>

            <label>Calificaciones Extraordinario</label>
            <select name="cal_ee">
                <option value="-1">No requerido</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <button type="submit">Guardar Calificaciones</button>
        </form>
    </div>
</body>
</html>