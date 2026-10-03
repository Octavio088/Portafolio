<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salones</title>
    <link rel="stylesheet" href="Formulario_consulta_estilo.css">
</head>
<body>
    <div class="container">
        <h2>Consulta de Salones</h2>
        <form action="action_consulta_salones.php"method="post" >
            <div class="form-section">
                <div>
                    <label for="edificio">Edificio</label>
                    <select id="edificio" name="edificio" class="form-control">
                        <option value="">Elige</option>
                        <option value="UAE1">UAE1</option>
                        <option value="UAE2">UAE2</option>
                        <option value="UAE3">UAE3</option>
                        <option value="UAE4">UAE4</option>
                        <option value="CADI">CADI</option>
                        <option value="CC">CC</option>
                        <option value="CNT">CNT</option>
                        <option value="VIRTUAL">VIRTUAL</option>
                    </select>
                </div>
            </div>
            <div class="button-group">
                <button type="subbmit" class="btn">Buscar</button>
                <button type="reset" class="btn">Limpiar</button>
                <button type="submit" formaction="Menu.php" class="btn">Salir</button>
            </div>
        </form>
    </div>
</body>
</html>
