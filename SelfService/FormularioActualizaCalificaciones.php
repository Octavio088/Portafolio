<?php 
  if(empty($_POST['id'])){
    header("Location: Tabla_actualiza_calificaciones.php");
  }else{
    $valores = explode(",", $_POST['id']);
    $x = $valores[0];
    $y = $valores[1];
    setcookie("variable_x", $_POST['id']);
  }
  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);

  if(!$link) { header("Location: Login.php"); }
  $database = 't15a_proyecto';
  mysqli_select_db($link, $database);

  $cadQuery = "SELECT 
            usuarios.nombre_completo AS nombre_completo,
            usuarios.matricula AS matricula,
            grupos.clave_grupo AS clave_grupo,
            calificaciones.u1,
            calificaciones.u2,
            calificaciones.u3,
            calificaciones.uf,
            calificaciones.Final,
            calificaciones.ee,
            calificaciones.grupo
            FROM 
                calificaciones
            JOIN 
                usuarios ON calificaciones.alumno= usuarios.matricula
            JOIN 
                grupos ON calificaciones.grupo = grupos.grupo
            WHERE matricula = $x AND calificaciones.grupo = $y";
  
  $query = mysqli_query($link, $cadQuery);
  
  for ($c = 0; $c < mysqli_num_rows($query); $c++) {
    $f = mysqli_fetch_array($query);
    
  }
  mysqli_close($link);
  ?>
<html>
<head>
    <link rel="stylesheet" href="design_users.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Formulario_actualiza.css" />
    <script>
        function confirmUpdate() {
            return confirm("¿Estás seguro de que deseas actualizar los datos?");
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Actualiza Calificaciones</h2>
        <form action="Action_Actualiza_Calificacion.php" method="post">

        <div class="form-group">
            <label>Alumno</label>
            <input type="text" name="nombre_alumno" class="form-control" value= "<?php echo $f[0]; ?>" disabled>
        </div>

        <div class="form-group">
            <label>Grupo</label>
            <select name="nombre_grupo" class="form-control">
                <option value= "<?php echo $f[9]; ?>"><?php echo $f[2]; ?></option>
            </select>
        </div>
        <div class="form-group">
        <label>Calificaciones Parcial 1</label>
            <select name="cal_u1" class="form-control">
                <option value="<?php echo $f[3]; ?>">Actual : <?php echo $f[3]; ?></option>
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
        <div class="form-group">
        <label>Calificaciones Parcial 2</label>
            <select name="cal_u2" class="form-control">
                <option value="<?php echo $f[4]; ?>">Actual : <?php echo $f[4]; ?></option >
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
        <div class="form-group">
        <label>Calificaciones Parcial 3</label>
            <select name="cal_u3" class="form-control">
                <option value="<?php echo $f[5]; ?>">Actual : <?php echo $f[5]; ?></option>
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
        <div class="form-group">
        <label>Calificaciones Final</label>
            <select name="cal_uf" class="form-control">
                <option value="<?php echo $f[6]; ?>"> Actual : <?php echo $f[6]; ?></option>
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
        <div class="form-group">
            <label>Calificacion Final</label>
            <input type="text" name="ale_gato" class="form-control" value= "<?php echo $f[7]; ?>" disabled>
        </div>
        <div class="form-group">
        <label>Calificaciones Extraordinario</label>
            <select name="extra" class="form-control">
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
        </div>
        
        <div class="form-group">
        <button type="submit" class="btn">Guardar Cambios</button>
        </div>
      </form>
    </div>
</body>
</html>