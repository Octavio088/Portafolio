<?php
  $usuario = $_COOKIE['matri'];
  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $database = 'mysql';
  $link = mysqli_connect($server, $user, $pass, $database);

  if(!$link) { header("Location: Login.php"); }
  $database = 't15a_proyecto';
  mysqli_select_db($link, $database);
  $cadQuery = "SELECT usuarios.matricula, usuarios.nombre_completo, carreras.nombre, usuarios.generacion, usuarios.semestre, usuarios.username,
  usuarios.password, tipousuarios.nombre, usuarios.carrera, usuarios.tipo 
  FROM usuarios
  INNER JOIN carreras ON usuarios.carrera=carreras.carrera
  INNER JOIN tipousuarios ON tipousuarios.tipo = usuarios.tipo 
  WHERE matricula = '$usuario'";
  $query = mysqli_query($link, $cadQuery);
  for ($c = 0; $c < mysqli_num_rows($query); $c++) {
    $f = mysqli_fetch_array($query);
    $matricula = $f[0];
    $nombreUsuario = $f[1];
    $carrera = $f[2];
    $generacion = $f[3];
    $semestre = $f[4];
    $username = $f[5];
    $password = $f[6];
    $tipoUsuario = $f[7];
  }
  mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: #2b2b2b;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: "Signika", sans-serif;
            color: #e0e0e0;
        }
        
        .container {
            background-color: #1e1e1e;
            border-radius: 15px;
            padding: 40px;
            width: 600px;
            max-height: 700px;
            overflow: auto;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
            border: 1px solid #444;
        }
        
        .container::-webkit-scrollbar {
            display: none;
        }
        
        .container h2 {
            color: #f5f5f5;
            font-size: 36px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        
        label {
            font-size: 15px;
            color: #b3b3b3;
            margin-bottom: 8px;
        }
        
        select, input {
            padding: 15px;
            background-color: #2f2f3a;
            border: 1px solid #3d3d4e;
            font-size: 15px;
            color: #f0f0f0;
            margin-bottom: 20px;
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        select:focus, input:focus {
            outline: none;
            border-color: #f09c00;
            box-shadow: 0 0 8px rgba(240, 156, 0, 0.6);
        }
        
        button {
            font-size: 18px;
            letter-spacing: 2px;
            text-transform: uppercase;
            display: inline-block;
            text-align: center;
            font-weight: bold;
            padding: 0.7em 2em;
            border: 3px solid black;
            border-radius: 2px;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.1);
            color: black;
            text-decoration: none;
            transition: 0.3s ease all;
            z-index: 1;
        }
        
        button:before {
            transition: 0.5s all ease;
            position: absolute;
            top: 0;
            left: 50%;
            right: 50%;
            bottom: 0;
            opacity: 0;
            content: '';
            background-color: #f09c00;
            z-index: -1;
        }
        
        button:hover, button:focus {
            color: white;
        }
        
        button:hover:before, button:focus:before {
            transition: 0.5s all ease;
            left: 0;
            right: 0;
            opacity: 1;
        }
        
        button:active {
            transform: scale(0.9);
        }
        
        .form-fila {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }
        
        .form-grupo {
            flex: 1;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input, select {
            width: 100%;
        }
        
        .contra{
            display:flex;
            align-items:center;
        }
        
        .contra ion-icon{
            margin-bottom: 20px;
            font-size: 37px;
            padding: 5px;
            cursor: pointer;
            color: var(--color-text-form);
            border-radius: 5px;
            width: 10%; /* El campo de texto ocupa todo el ancho disponible */
            box-sizing: border-box;
            font-family: 'calibri';
            background-color: #2f2f3a;
        }
</style>
</head>
<body>
<div class="container">
        <h2>Administración de Usuarios</h2>
        <form action="action_examen.php" method="post">

            <div class="form-fila">
                <div class="form-grupo">
                <label for="varMatricula">Matrícula</label>
                <input id="varMatricula" name="varMatricula" type="text" placeholder="Matrícula (Ingrese 6 dígitos)" class="form-control" value="<?php echo $f[0]; ?>"readonly>
                </div>
                <div class="form-grupo">
                <label for="nombreCompleto">Nombre Completo</label>
                <input id="nombreCompleto" name="nombreCompleto" type="text" class="form-control" value="<?php echo $f[1]; ?>" >
                </div>
            </div>
            <div class="form-fila">
                <div class="form-grupo">
                <label for="carrera">Carrera</label>
                <select id="carrera" name="carrera"  class="form-control" readonly >
                    <option value = "<?php echo $f[8]; ?>"><?php echo $f[2]; ?></option>
                </select>
                </div>
                <div class="form-grupo">
                <label>Generación</label>
                <input type="text" id="generacion" name="generacion" class="form-control" value="<?php echo $f[3]; ?>"  readonly>
                </div>
            </div>
            <div class="form-fila">
                <div class="form-grupo">
                <label>Semestre</label>
                <input type="text" id="semestre" name="semestre" class="form-control" value="<?php echo $f[4]; ?>"  readonly>
                </div>
                <div class="form-grupo">
                <label>Username</label>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo $f[5]; ?>"  required>
                </div>
            </div>
            <div class="form-fila">
                <div class="form-grupo">
                <label>Password</label>
                <div class="contra">
                <input type="password" id="password" name="password" class="form-control" required>
                <ion-icon id="eye" name="eye-outline"></ion-icon>
                </div>
                </div>
                <div class="form-grupo">
                <label>Tipo</label>
                <select id="tipo_usuarios" name="tipo_usuarios" class="form-control" readonly>
                    <option value = "<?php echo $f[9]; ?>"><?php echo $f[7]; ?></option>
                </select>
                </div>
            </div>
 
            <button type="submit">Actualizar</button>
        </form>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script>
        let eye = document.getElementById("eye");
        let password = document.getElementById("password");
 
        eye.onclick = function(){
            if(password.type == "password"){
                password.type = "text";
                eye.name = "eye-off-outline";
            }else{
                password.type = "password";
                eye.name = "eye-outline";
            }
        }
    </script>
</body>
</html>