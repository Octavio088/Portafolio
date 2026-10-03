<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Formulario_consulta_estilo.css">
</head>
<body>
    <div class="container">
        <h2>Consulta de Usuarios</h2>
        <form action="action_consulta_usuarios.php" method="post">
            <div class="form-section">
                <div class="form-group">
                <label for="varMatricula">Matrícula</label>
                <input id="matricula" name="matricula" type="text" placeholder="Matrícula" value="" class="form-control">
            </div>
            <div class="form-group">
                <label for="varTipo">Tipo usuario</label>
                <select id="varTipo" name="varTipo" class="form-control" >
                    <option value="">Elige</option>
                    <option value="0">Administrador</option>
                    <option value="1">Estudiante</option>
                    <option value="2">Docente</option>
                </select>
            </div>
            <div class="form-group">
                <label for="varCarrera">Carrera</label>
                <select id="varCarrera" name="varCarrera" class="form-control">
                    <option value="">Elige</option>
                    <option value="1">Ingeniería en Tecnologías de la Información</option>
                    <option value="2">Ingeniería en Telemática</option>
                    <option value="3">Ingeniería en Tecnologías de Manufactura</option>
                    <option value="4">Ingeniería en Sistemas y Tecnologías Industriales</option>
                    <option value="5">Licenciatura en Administración y Gestión</option>
                    <option value="6">Licenciatura en Mercadotecnia Internacional</option>
                </select>
            </div>    
            </div>
        
    <div class="button-group">
        <button type="submit" class="btn">Buscar</button>
        <button type="reset" class="btn">Limpiar</button>
        <button type="submit" formaction="Menu.php" class="btn">Salir</button>
    </div>
    </form>
    </div>

</body>
</html>