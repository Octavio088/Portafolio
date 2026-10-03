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
        <h2>Insertar Horarios</h2>
        <form action="action_guardar_horario.php" method="post">

            <label>Tipo</label>
            <select name="tipo_horario" required>
                <option value="Diario">Diario</option>
                <option value="Terceario">Terceario</option>
            </select>

            <div class="form-fila">
                <div class="form-grupo">
                <label>Hora Lunes</label>
                <select name="hora_lunes">
                    <option value="">Selecciona una hora</option>
                    <option value="07:00 - 07:55">07:00</option>
                    <option value="08:00 - 08:55">08:00</option>
                    <option value="09:00 - 09:55">09:00</option>
                    <option value="10:00 - 10:55">10:00</option>
                    <option value="11:00 - 11:55">11:00</option>
                    <option value="12:00 - 12:55">12:00</option>
                    <option value="13:00 - 13:55">13:00</option>
                    <option value="14:00 - 14:55">14:00</option>
                    <option value="15:00 - 15:55">15:00</option>
                    <option value="16:00 - 16:55">16:00</option>
                    <option value="17:00 - 17:55">17:00</option>
                    <option value="18:00 - 18:55">18:00</option>
                    <option value="19:00 - 19:55">19:00</option>
                    <option value="20:00 - 20:55">20:00</option>
                </select>
                </div>
                <div class="form-grupo">
                <label>Hora Martes</label>
                <select name="hora_martes">
                    <option value="">Selecciona una hora</option>
                    <option value="07:00 - 07:55">07:00</option>
                    <option value="08:00 - 08:55">08:00</option>
                    <option value="09:00 - 09:55">09:00</option>
                    <option value="10:00 - 10:55">10:00</option>
                    <option value="11:00 - 11:55">11:00</option>
                    <option value="12:00 - 12:55">12:00</option>
                    <option value="13:00 - 13:55">13:00</option>
                    <option value="14:00 - 14:55">14:00</option>
                    <option value="15:00 - 15:55">15:00</option>
                    <option value="16:00 - 16:55">16:00</option>
                    <option value="17:00 - 17:55">17:00</option>
                    <option value="18:00 - 18:55">18:00</option>
                    <option value="19:00 - 19:55">19:00</option>
                    <option value="20:00 - 20:55">20:00</option>
                </select>
                </div>
            </div>
            <div class="form-fila">
                <div class="form-grupo">
                <label>Hora Miércoles</label>
                <select name="hora_miercoles">
                    <option value="">Selecciona una hora</option>
                    <option value="07:00 - 07:55">07:00</option>
                    <option value="08:00 - 08:55">08:00</option>
                    <option value="09:00 - 09:55">09:00</option>
                    <option value="10:00 - 10:55">10:00</option>
                    <option value="11:00 - 11:55">11:00</option>
                    <option value="12:00 - 12:55">12:00</option>
                    <option value="13:00 - 13:55">13:00</option>
                    <option value="14:00 - 14:55">14:00</option>
                    <option value="15:00 - 15:55">15:00</option>
                    <option value="16:00 - 16:55">16:00</option>
                    <option value="17:00 - 17:55">17:00</option>
                    <option value="18:00 - 18:55">18:00</option>
                    <option value="19:00 - 19:55">19:00</option>
                    <option value="20:00 - 20:55">20:00</option>
                </select>
                </div>
                <div class="form-grupo">
                <label>Hora Jueves</label>
                <select name="hora_jueves">
                    <option value="">Selecciona una hora</option>
                    <option value="07:00 - 07:55">07:00</option>
                    <option value="08:00 - 08:55">08:00</option>
                    <option value="09:00 - 09:55">09:00</option>
                    <option value="10:00 - 10:55">10:00</option>
                    <option value="11:00 - 11:55">11:00</option>
                    <option value="12:00 - 12:55">12:00</option>
                    <option value="13:00 - 13:55">13:00</option>
                    <option value="14:00 - 14:55">14:00</option>
                    <option value="15:00 - 15:55">15:00</option>
                    <option value="16:00 - 16:55">16:00</option>
                    <option value="17:00 - 17:55">17:00</option>
                    <option value="18:00 - 18:55">18:00</option>
                    <option value="19:00 - 19:55">19:00</option>
                    <option value="20:00 - 20:55">20:00</option>
                </select>
                </div>
            </div>

            <label>Hora Viernes</label>
            <select name="hora_viernes">
            <option value="">Selecciona una hora</option>
                <option value="07:00 - 07:55">07:00</option>
                <option value="08:00 - 08:55">08:00</option>
                <option value="09:00 - 09:55">09:00</option>
                <option value="10:00 - 10:55">10:00</option>
                <option value="11:00 - 11:55">11:00</option>
                <option value="12:00 - 12:55">12:00</option>
                <option value="13:00 - 13:55">13:00</option>
                <option value="14:00 - 14:55">14:00</option>
                <option value="15:00 - 15:55">15:00</option>
                <option value="16:00 - 16:55">16:00</option>
                <option value="17:00 - 17:55">17:00</option>
                <option value="18:00 - 18:55">18:00</option>
                <option value="19:00 - 19:55">19:00</option>
                <option value="20:00 - 20:55">20:00</option>
            </select>

            <button type="submit">Guardar Horario</button>
        </form>
    </div>
    
</body>
</html>