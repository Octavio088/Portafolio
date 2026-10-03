<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Formulario_consulta_estilo.css">
</head>
<body>
    <div class="container">
        <h2>Consulta de Calificaciones</h2>
        <form action="#" method="post">
            <div class="form-section">
                <div class="form-group">
                    <label>Alumno</label>
                    <input type="text" name="nombre_alumno" class="form-control">
                </div>
                <div class="form-group">
                    <label>Grupo</label>
                    <input type="text" name="nombre_grupo" class="form-control">
                </div>
                <div class="form-group">
                    <label>Calificaciones Parcial 1</label>
                    <select name="cal_u1" class="form-control">
                        <option value="">Selecciona una calificación</option>
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
                        <option value="">Selecciona una calificación</option>
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
                        <option value="">Selecciona una calificación</option>
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
                        <option value="">Selecciona una calificación</option>
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
                    <label>Calificaciones Extraordinario</label>
                    <select name="cal_ee" class="form-control">
                        <option value="">Selecciona una calificación</option>
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
                    <label>Calificaciones Regularización</label>
                    <select name="cal_eo" class="form-control">
                        <option value="">Selecciona una calificación</option>
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
            <div class="button-group">
                <button type="submit" class="btn">Buscar</button>
                <button type="reset" class="btn">Limpiar</button>
                <button type="submit" formaction="Menu.php" class="btn">Salir</button>
            </div>
        </form>
    </div>

</body>
</html>