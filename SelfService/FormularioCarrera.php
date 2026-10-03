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
        <h2>Insertar Carrera</h2>
        <form action="Action_guarda_carrera.php" method="post">
            <label>Nombre de la carrera</label>
            <input type="text" name="nombre_carrera" required>
            <label>Semestres</label>
            <select name="semestres" required>
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

            <button type="submit">Guardar Carrera</button>
        </form>
    </div>
</body>
</html>