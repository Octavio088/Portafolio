<?php 
  $x = $_POST['id'];
  setcookie("variable_x", $_POST['id']);

  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);

  if(!$link) { header("Location: Login.php"); }
  $database = 't15a_proyecto';
  mysqli_select_db($link, $database);
  $cadQuery = "SELECT * FROM horarios WHERE horario = '$x'";
  $query = mysqli_query($link, $cadQuery);
  for ($c = 0; $c < mysqli_num_rows($query); $c++) {
    $f = mysqli_fetch_array($query);
    $tipo = $f[1];
    $hora_lunes = $f[2];
    $hora_martes = $f[3];
    $hora_miercoles = $f[4];
    $hora_jueves = $f[5];
    $hora_viernes = $f[6];
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
        <h2>Actualiza Horarios</h2>
        <form action="action_actualiza_horarios.php" method="post">

        <div class="form-group">
            <label>Tipo</label>
            <select name="tipo_horario" class="form-control" required>
                <option value="<?php echo $tipo;?>"><?php echo $tipo;?></option>
                <?php if($tipo != "Diario"){ ?><option value="Diario">Diario</option><?php }?>
                <?php if($tipo != "Terceario"){ ?><option value="Terceario">Terceario</option><?php }?>
            </select>
        </div>
 
        <div class="form-group">
            <label>Hora Lunes</label>
            <select name="hora_lunes" class="form-control">
                <option value="<?php echo $hora_lunes;?>"><?php echo $hora_lunes;?></option>
                <?php if($hora_lunes != "07:00 - 07:55"){ ?><option value="07:00 - 07:55">07:00 - 07:55</option><?php }?>
                <?php if($hora_lunes != "08:00 - 08:55"){ ?><option value="08:00 - 08:55">08:00 - 08:55</option><?php }?>
                <?php if($hora_lunes != "09:00 - 09:55"){ ?><option value="09:00 - 09:55">09:00 - 09:55</option><?php }?>
                <?php if($hora_lunes != "10:00 - 10:55"){ ?><option value="10:00 - 10:55">10:00 - 10:55</option><?php }?>
                <?php if($hora_lunes != "11:00 - 11:55"){ ?><option value="11:00 - 11:55">11:00 - 11:55</option><?php }?>
                <?php if($hora_lunes != "12:00 - 12:55"){ ?><option value="12:00 - 12:55">12:00 - 12:55</option><?php }?>
                <?php if($hora_lunes != "13:00 - 13:55"){ ?><option value="13:00 - 13:55">13:00 - 13:55</option><?php }?>
                <?php if($hora_lunes != "14:00 - 14:55"){ ?><option value="14:00 - 14:55">14:00 - 14:55</option><?php }?>
                <?php if($hora_lunes != "15:00 - 15:55"){ ?><option value="15:00 - 15:55">15:00 - 15:55</option><?php }?>
                <?php if($hora_lunes != "16:00 - 16:55"){ ?><option value="16:00 - 16:55">16:00 - 16:55</option><?php }?>
                <?php if($hora_lunes != "17:00 - 17:55"){ ?><option value="17:00 - 17:55">17:00 - 17:55</option><?php }?>
                <?php if($hora_lunes != "18:00 - 18:55"){ ?><option value="18:00 - 18:55">18:00 - 18:55</option><?php }?>
                <?php if($hora_lunes != "19:00 - 19:55"){ ?><option value="19:00 - 19:55">19:00 - 19:55</option><?php }?>
                <?php if($hora_lunes != "20:00 - 20:55"){ ?><option value="20:00 - 20:55">20:00 - 20:55</option><?php }?>
            </select>
        </div>

   
        <div class="form-group">
        <label>Hora Martes</label>
            <select name="hora_martes" class="form-control">
                <option value="<?php echo $hora_martes;?>"><?php echo $hora_martes;?></option>
                <?php if($hora_martes != "07:00 - 07:55"){ ?><option value="07:00 - 07:55">07:00 - 07:55</option><?php }?>
                <?php if($hora_martes != "08:00 - 08:55"){ ?><option value="08:00 - 08:55">08:00 - 08:55</option><?php }?>
                <?php if($hora_martes != "09:00 - 09:55"){ ?><option value="09:00 - 09:55">09:00 - 09:55</option><?php }?>
                <?php if($hora_martes != "10:00 - 10:55"){ ?><option value="10:00 - 10:55">10:00 - 10:55</option><?php }?>
                <?php if($hora_martes != "11:00 - 11:55"){ ?><option value="11:00 - 11:55">11:00 - 11:55</option><?php }?>
                <?php if($hora_martes != "12:00 - 12:55"){ ?><option value="12:00 - 12:55">12:00 - 12:55</option><?php }?>
                <?php if($hora_martes != "13:00 - 13:55"){ ?><option value="13:00 - 13:55">13:00 - 13:55</option><?php }?>
                <?php if($hora_martes != "14:00 - 14:55"){ ?><option value="14:00 - 14:55">14:00 - 14:55</option><?php }?>
                <?php if($hora_martes != "15:00 - 15:55"){ ?><option value="15:00 - 15:55">15:00 - 15:55</option><?php }?>
                <?php if($hora_martes != "16:00 - 16:55"){ ?><option value="16:00 - 16:55">16:00 - 16:55</option><?php }?>
                <?php if($hora_martes != "17:00 - 17:55"){ ?><option value="17:00 - 17:55">17:00 - 17:55</option><?php }?>
                <?php if($hora_martes != "18:00 - 18:55"){ ?><option value="18:00 - 18:55">18:00 - 18:55</option><?php }?>
                <?php if($hora_martes != "19:00 - 19:55"){ ?><option value="19:00 - 19:55">19:00 - 19:55</option><?php }?>
                <?php if($hora_martes != "20:00 - 20:55"){ ?><option value="20:00 - 20:55">20:00 - 20:55</option><?php }?>
            </select>
        </div>

        <div class="form-group">
            <label>Hora Miércoles</label>
            <select name="hora_miercoles" class="form-control">
                <option value="<?php echo $hora_miercoles;?>"><?php echo $hora_miercoles;?></option>
                <?php if($hora_miercoles != "07:00 - 07:55"){ ?><option value="07:00 - 07:55">07:00 - 07:55</option><?php }?>
                <?php if($hora_miercoles != "08:00 - 08:55"){ ?><option value="08:00 - 08:55">08:00 - 08:55</option><?php }?>
                <?php if($hora_miercoles != "09:00 - 09:55"){ ?><option value="09:00 - 09:55">09:00 - 09:55</option><?php }?>
                <?php if($hora_miercoles != "10:00 - 10:55"){ ?><option value="10:00 - 10:55">10:00 - 10:55</option><?php }?>
                <?php if($hora_miercoles != "11:00 - 11:55"){ ?><option value="11:00 - 11:55">11:00 - 11:55</option><?php }?>
                <?php if($hora_miercoles != "12:00 - 12:55"){ ?><option value="12:00 - 12:55">12:00 - 12:55</option><?php }?>
                <?php if($hora_miercoles != "13:00 - 13:55"){ ?><option value="13:00 - 13:55">13:00 - 13:55</option><?php }?>
                <?php if($hora_miercoles != "14:00 - 14:55"){ ?><option value="14:00 - 14:55">14:00 - 14:55</option><?php }?>
                <?php if($hora_miercoles != "15:00 - 15:55"){ ?><option value="15:00 - 15:55">15:00 - 15:55</option><?php }?>
                <?php if($hora_miercoles != "16:00 - 16:55"){ ?><option value="16:00 - 16:55">16:00 - 16:55</option><?php }?>
                <?php if($hora_miercoles != "17:00 - 17:55"){ ?><option value="17:00 - 17:55">17:00 - 17:55</option><?php }?>
                <?php if($hora_miercoles != "18:00 - 18:55"){ ?><option value="18:00 - 18:55">18:00 - 18:55</option><?php }?>
                <?php if($hora_miercoles != "19:00 - 19:55"){ ?><option value="19:00 - 19:55">19:00 - 19:55</option><?php }?>
                <?php if($hora_miercoles != "20:00 - 20:55"){ ?><option value="20:00 - 20:55">20:00 - 20:55</option><?php }?>
            </select>
        </div>

        <div class="form-group">
            <label>Hora Jueves</label>
            <select name="hora_jueves" class="form-control">
                <option value="<?php echo $hora_jueves;?>"><?php echo $hora_jueves;?></option>
                <?php if($hora_jueves != "07:00 - 07:55"){ ?><option value="07:00 - 07:55">07:00 - 07:55</option><?php }?>
                <?php if($hora_jueves != "08:00 - 08:55"){ ?><option value="08:00 - 08:55">08:00 - 08:55</option><?php }?>
                <?php if($hora_jueves != "09:00 - 09:55"){ ?><option value="09:00 - 09:55">09:00 - 09:55</option><?php }?>
                <?php if($hora_jueves != "11:00 - 11:55"){ ?><option value="11:00 - 11:55">11:00 - 11:55</option><?php }?>
                <?php if($hora_jueves != "10:00 - 10:55"){ ?><option value="10:00 - 10:55">10:00 - 10:55</option><?php }?>
                <?php if($hora_jueves != "12:00 - 12:55"){ ?><option value="12:00 - 12:55">12:00 - 12:55</option><?php }?>
                <?php if($hora_jueves != "13:00 - 13:55"){ ?><option value="13:00 - 13:55">13:00 - 13:55</option><?php }?>
                <?php if($hora_jueves != "14:00 - 14:55"){ ?><option value="14:00 - 14:55">14:00 - 14:55</option><?php }?>
                <?php if($hora_jueves != "15:00 - 15:55"){ ?><option value="15:00 - 15:55">15:00 - 15:55</option><?php }?>
                <?php if($hora_jueves != "16:00 - 16:55"){ ?><option value="16:00 - 16:55">16:00 - 16:55</option><?php }?>
                <?php if($hora_jueves != "17:00 - 17:55"){ ?><option value="17:00 - 17:55">17:00 - 17:55</option><?php }?>
                <?php if($hora_jueves != "18:00 - 18:55"){ ?><option value="18:00 - 18:55">18:00 - 18:55</option><?php }?>
                <?php if($hora_jueves != "19:00 - 19:55"){ ?><option value="19:00 - 19:55">19:00 - 19:55</option><?php }?>
                <?php if($hora_jueves != "20:00 - 20:55"){ ?><option value="20:00 - 20:55">20:00 - 20:55</option><?php }?>
            </select>
        </div>

        <div class="form-group">
            <label>Hora Viernes</label>
            <select name="hora_viernes" class="form-control">
                <option value="<?php echo $hora_viernes;?>"><?php echo $hora_viernes;?></option>
                <?php if($hora_viernes != "07:00 - 07:55"){ ?><option value="07:00 - 07:55">07:00 - 07:55</option><?php }?>
                <?php if($hora_viernes != "08:00 - 08:55"){ ?><option value="08:00 - 08:55">08:00 - 08:55</option><?php }?>
                <?php if($hora_viernes != "09:00 - 09:55"){ ?><option value="09:00 - 09:55">09:00 - 09:55</option><?php }?>
                <?php if($hora_viernes != "10:00 - 10:55"){ ?><option value="10:00 - 10:55">10:00 - 10:55</option><?php }?>
                <?php if($hora_viernes != "11:00 - 11:55"){ ?><option value="11:00 - 11:55">11:00 - 11:55</option><?php }?>
                <?php if($hora_viernes != "12:00 - 12:55"){ ?><option value="12:00 - 12:55">12:00 - 12:55</option><?php }?>
                <?php if($hora_viernes != "13:00 - 13:55"){ ?><option value="13:00 - 13:55">13:00 - 13:55</option><?php }?>
                <?php if($hora_viernes != "14:00 - 14:55"){ ?><option value="14:00 - 14:55">14:00 - 14:55</option><?php }?>
                <?php if($hora_viernes != "15:00 - 15:55"){ ?><option value="15:00 - 15:55">15:00 - 15:55</option><?php }?>
                <?php if($hora_viernes != "16:00 - 16:55"){ ?><option value="16:00 - 16:55">16:00 - 16:55</option><?php }?>
                <?php if($hora_viernes != "17:00 - 17:55"){ ?><option value="17:00 - 17:55">17:00 - 17:55</option><?php }?>
                <?php if($hora_viernes != "18:00 - 18:55"){ ?><option value="18:00 - 18:55">18:00 - 18:55</option><?php }?>
                <?php if($hora_viernes != "19:00 - 19:55"){ ?><option value="19:00 - 19:55">19:00 - 19:55</option><?php }?>
                <?php if($hora_viernes != "20:00 - 20:55"){ ?><option value="20:00 - 20:55">20:00 - 20:55</option><?php }?>
            </select>
        </div>

        <div class="form-group buttons-container">
            <button type="submit" class="btn">Guardar Cambios</button>
            <button type="button" class="btn" onclick="location.href='TablaHorario.php'">Salir</button>
        </div>
      </form>
    </div>
</body>
</html>