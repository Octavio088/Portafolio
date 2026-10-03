<html>
    <head>
        <link rel="stylesheet" href="design_users.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                margin: 0;
                padding: 50px;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: flex-start;
                font-family: "Quicksand", sans-serif;
                background-color: #2c2c2c;
            }
            .container {
                display: flex;
                height: 80%;
                width: 95%;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
                margin-top: 0;
            }
            .image-side {
                flex: 1;
                background: url('img/upslp.png') no-repeat center center;
                background-size: cover;
                clip-path: ellipse(100% 70% at 60% 50%);
                opacity: 0.9;
            }
            .form-horizontal {
                flex: 1;
                padding: 20px; /* Reducción del padding para que haya menos espacio interno */
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                background-color: #3b3b3b;
                height: 100%;
            }
            .form-header {
                text-align: center;
                margin-bottom: 10px;
            }
            .form-header h2 {
                font-size: 18px;
                color: #ff8800;
                margin: 0;
            }
            .form-group {
                margin-bottom: 5px; /* Reducción del margen entre campos */
            }
            label {
                font-size: 14px;
                color:white;
                margin-bottom: 4px;
                display: block;
            }
            .form-control {
                width: 100%;
                border: none;
                border-bottom: 2px solid #ff8800;
                padding: 4px 0;
                font-size: 12px;
                color:white;
                background: transparent;
                outline: none;
                transition: border-bottom-color 0.3s;
                margin-bottom: 4px; /* Reduce el margen entre campos */
            }
            .form-control:focus {
                border-bottom-color: #ffb733;
            }
            button.btn {
                width: 100%;
                padding: 8px;
                font-size: 12px;
                background-color: #ff8800;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 15px; /* Puedes ajustar esto si es necesario */
                transition: background-color 0.3s;
            }
            button.btn:hover {
                background-color: #e57a00;
            }
            .help-block {
                font-size: 10px;
                color:white;
            }

            input::placeholder{
                color: #c8c8c8;
            }

            option{
                color: black;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="image-side"></div>
            <form class="form-horizontal" action="action_usuario_guardar.php" method="post">
                <div class="form-header">
                    <h2>Registro de Usuarios</h2>
                </div>
                <div class="form-group">
                    <label for="varMatricula">Matrícula</label>
                    <input id="varMatricula" name="varMatricula" type="text" placeholder="Matrícula (Ingrese 6 dígitos)" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="varNombre">Nombre completo</label>
                    <input id="varNombre" name="varNombre" type="text" placeholder="Nombre completo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="varCarrera">Carrera</label>
                    <select id="varCarrera" name="varCarrera" class="form-control">
                        <option value="0">Administrador</option>
                        <option value="1">Ingeniería en Tecnologías de la Información</option>
                        <option value="2">Ingeniería en Telemática</option>
                        <option value="3">Ingeniería en Tecnologías de Manufactura</option>
                        <option value="4">Ingeniería en Sistemas y Tecnologías Industriales</option>
                        <option value="5">Licenciatura en Administración y Gestión</option>
                        <option value="6">Licenciatura en Mercadotecnia Internacional</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="varGeneracion">Generación</label>
                    <input id="varGeneracion" name="varGeneracion" type="text" placeholder="Generación" class="form-control">
                    <span class="help-block">Año de ingreso</span>
                </div>
                <div class="form-group">
                    <label for="varsemestre">Semestre</label>
                    <input id="varsemestre" name="varsemestre" type="text" placeholder="Semestre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="varUsername">Usuario</label>
                    <input id="varUsername" name="varUsername" type="text" placeholder="Nombre de usuario" class="form-control">
                </div>
                <div class="form-group">
                    <label for="varPassword">Contraseña</label>
                    <input id="varPassword" name="varPassword" type="password" placeholder="Contraseña" class="form-control">
                </div>
                <div class="form-group">
                    <label for="varTipo">Tipo usuario</label>
                    <select id="varTipo" name="varTipo" class="form-control">
                        <option value="0">Administrador</option>
                        <option value="1">Estudiante</option>
                        <option value="2">Docente</option>
                    </select>
                </div>
                <div class="form-group">
                    <button id="btnGuardar" name="btnGuardar" class="btn">Guardar</button>
                </div>
            </form>
        </div>
    </body>
</html>