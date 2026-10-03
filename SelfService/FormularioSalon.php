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
        <h2>Insertar Salones</h2>
        <form action="action_add_salon.php" method="post">
            <label>Clave del Salón</label>
            <input type="text" name="clave_salon" required>
    
            <label>Nombre del Salón</label>
            <input type="text" name="nombre_salon" required>
    
            <label>Edificio</label>
            <select name="ubicacion_fisica" required>
                <option value="">Selecciona una ubicacion</option>
                <option value="Unidad Academica de Estudiantes 1">UAE 1</option>
                <option value="Unidad Academica de Estudiantes 2">UAE 2</option>
                <option value="Unidad Academica de Estudiantes 3">UAE 3</option>
                <option value="Unidad Academica de Estudiantes 4">UAE 4</option>
                <option value="Centro de Computo">CC</option>
                <option value="Centro Academico de Ingles">CADI</option>
                <option value="Centro de Nuevas Tecnologias">CNT</option>
            </select>
    
            <button type="submit">Guardar Salón</button>
        </form>
    </div>
</body>
</html>