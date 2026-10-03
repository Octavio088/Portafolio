<?php
	if (!isset($_COOKIE['nombreUsuario'])) {
		header("Location: index.php");
	}

  $nombreUsuario = $_COOKIE['nombreUsuario'];
  $tipoUsuario = $_COOKIE['tipoUsuario'];
  $matri = $_COOKIE['matri'];
  $colorEstilo = '#000000';

  if ($tipoUsuario == '0'){
    $colorEstilo = '#8A2BE2'; // Admin - Morado/Purpura
    $text ='Administrador';
    $logo= 'img/Administrador.png';}
  else if  ($tipoUsuario == '1'){
    $colorEstilo = '#00CED1'; // Alum - Azul claro
    $text ='Alumno';
    $logo= 'img/Alumno.png';}
  else{
    $colorEstilo = '#FF4500'; // Prof - Rojo/Naranja
    $text ='Profesor';
    $logo= 'img/Profesor.png';}
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body{
            background-color: #1C1C1C;
        }

        /*----------------------------------------------------------------------------------------------BARRA DE NAVEGACIÓN*/

        header{
            background: /*black*/ <?php echo $colorEstilo;?>;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 85px;
            padding: 5px 10%;
            font-family: "Quicksand", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        .header .logo{
            position: relative;
            cursor: pointer;
        }

        .header .logo img{
            height: 70px;
            weight: auto;
            transition: all 0.3s;
            background-color: white;
            padding: 4px;
            border-radius: 50px;
        }

        .header .logo img:hover{
            transform: scale(1.1);
        }

        .info-usuario {
            position: absolute;
            top: 85px;
            left: 0;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            padding: 10px;
            width: 220px;
            z-index: 10;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 300ms ease;
        }

        .info-usuario::before {
            content: '';
            position: absolute;
            top: -12px;
            left: 20px;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 12px solid white;
        }

        .info-usuario li {
            list-style: none;
            padding: 8px 10px;
            border-bottom: 3px solid <?php echo $colorEstilo;?>;
            font-size: 14px;
            color: black;
        }

        .info-usuario li:last-child {
            border-bottom: none;
        }

        .logo:hover .info-usuario {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        nav{
            height: 100%;
        }

        nav > ul{
            height: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            padding: 0;
        }

        nav  ul  li{
            height: 100%;
            list-style: none;
            position: relative;
            margin: 0 10px;
            flex-grow: 1;
        }

        nav > ul > li > a{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: /*white*/ <?php echo ($tipoUsuario == '0') ? 'white' : (($tipoUsuario == '1') ? 'black' : 'white'); ?>;
            text-transform: uppercase;
            font-size: 18px;
            transition: all 300ms ease;
            text-decoration: none;
        }

        nav > ul > li > a:hover{
            transform: scale(1.1);
            color: white;
            background: /*<?php echo $colorEstilo; ?>*/ <?php echo ($tipoUsuario == '0') ? '#5C2A7A' : (($tipoUsuario == '1') ? '#004F50' : '#BF360C'); ?>;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
        }

        nav ul li ul{
            width: 200px;
            display: flex;
            flex-direction: column;
            background: white;
            position: absolute;
            top: 90px;
            left: -5px;
            padding: 14px 0px;
            visibility: hidden;
            opacity: 0;
            z-index: 10;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
            transition: all 300ms;
        }

        nav ul li:hover ul{
            visibility: visible;
            opacity: 1;
            top: 70px;
        }

        nav ul li ul:before{
            content: ' ';
            width: 0;
            height: 0;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 12px solid white;
            position: absolute;
            top: -12px;
            left: 20px;
        }

        nav ul li ul li a{
            display: block;
            color: black;
            padding: 6px;
            padding-left: 14px;
            margin-top: 10px;
            font-size: 14px;
            text-transform: uppercase;
            transition: all 300ms;
            text-decoration: none;
        }

        nav ul li ul li a:hover{
            background: /*<?php echo $colorEstilo; ?>*/ <?php echo ($tipoUsuario == '0') ? '#5C2A7A' : (($tipoUsuario == '1') ? '#004F50' : '#BF360C'); ?>;
            color: white;
            transform: scale(1.1);
            padding-left: 30px;
            font-size: 14px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
        }

        .header .btn button{
            font-weight: 700;
            color: #1b3039;
            font-size: 18px;
            padding: 12px 30px;
            background: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease 0s;
        }

        .header .btn button:hover{
            background-color: white;
            color: black;
            transform: scale(1.1);
        }

        /*------------------------------------------------------------------------------------------------------------------*/

        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
            padding: 20px;
        }

        .recuadro {
            position: relative;
            background: #2E2E2E;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 1;
        }

        .grande {
            grid-column: span 2;
            grid-row: span 2;
            min-height: 300px;
        }

        .mediano {
            grid-column: span 2;
            min-height: 150px;
        }

        .pequeno {
            min-height: 100px;
            display: flex; 
            justify-content: center; 
            align-items: center;
        }

        /*----------------------------------------------------------------------------------------------CARRUSEL*/

        .carrusel{
            position: relative;
            width: 100%;
            height: 100%;
            background-color: white;
            overflow: hidden;
            z-index: 1;/*evitar sobreposicion del carrusel con la barra de navegación"*/
        }

        .carruseles{
            width: 400%;/*depende del num de imagenes*/
            height: 100%;
            display: flex;
        }

        .slider{
            width: calc(100%/4);/*carrusel para 4 imagenes*/
            height: 100%;
        }

        .slider img{
            width: 100%;
            height: 100%;
            object-fit: cover;/*que las imagenes no pierdan su calidad*/
        }

        .bl,.br{/*botones del carrusel*/
            display: flex;
            position: absolute;
            top: 50%;
            font-size: 1.5rem;
            background-color: white;
            border-radius: 50%;
            padding: 5px;
            font-weight: 600;
            cursor: pointer;
            color: white;
            transform: translate(0,-50%);
            transition: 0.5s ease;
            user-select: none;
            border: 1px solid black;
        }

        ion-icon{
            color: black;
        }

        ion-icon:hover{
            color:white;
        }

        .bl{
            left: 10px;
        }

        .br{
            right: 10px;
        }

        .bl:hover,.br:hover{
            background-color: black;
            border: 1px solid white;
        }

        /*-------------------------------------------------------------------------------------------CALENDARIO*/

        .calendario{
            width: 99%;
            height: 99%;
            display: flex;
            flex-direction: column;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            color: white;
            font-family: "Exo 2", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        @media (max-height: 784px){
            .calendario{
                width: 99%;
                height: 99%;
                display: flex;
                flex-direction: column;
                padding: 10px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.3);
                color: white;
            }
        }

        .header-calendario{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .mes-year{
            text-align: center;
            font-weight: 600;
            width: 150px;
        }

        .header-calendario button{
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 50%;
            background: white;
            cursor: pointer;
            width: 40px;
            height: 40px;
            box-shadow: 0 0 4px rgba(0,0,0,0.2);
        }

        .dias{
            display: flex;
            flex-wrap: wrap;
        }

        .dia{
            flex: 1 0 10.28%; /* Cada día ocupa aproximadamente el 14.28% del ancho */
            text-align: center;
            padding: 10px;
            box-sizing: border-box; /* Asegura que el padding no afecte el ancho */
            margin: 2px; /* Espacio entre los días */
        }

        .fechas{
            display: grid;
            grid-template-columns: repeat(7,1fr);
            gap: 5px;
        }

        .fecha{
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 10px;
            margin: auto;
            cursor: pointer;
            font-weight: 600;
            border-radius: 50%;
            height: 40px;
            transition: 0.2s;
        }

        .fecha:hover,
        .fecha.active{
            background: <?php echo $colorEstilo; ?>;
            color: white; 
        }

        .fecha.inactive{
            color: #A9A9A9;
        }

        .fecha.inactive:hover{
            color: white;
        }

        /*-------------------------------------------------*/

        .anuncios {
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            height: 99%;
            display: flex;
            flex-direction: column;
            padding: 40px;
            font-size: 1.2rem;
            color: black;
            color: white;
            font-family: "Exo 2", sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
        }

        .anuncios > hr{
            margin: 6px 0px 20px 0px;
        }

        .anuncios > ul{
            margin-left: 3%; 
        }

        .anuncios > ul > li{
            margin: 30px 0px 10px 0px;
        }

        .anuncios > ul > li > label{
            color: #3498db;
        }

        @media (max-height: 784px){
            .anuncios {
                height: 99%;
                display: flex;
                flex-direction: column;
                padding: 40px;
                font-size: 1.2rem;
                color: black;
                color: white;
                font-family: "Exo 2", sans-serif;
                font-optical-sizing: auto;
                font-weight: <weight>;
                font-style: normal;
            }

            .anuncios > hr{
                margin: 5px 0px 10px 0px;
            }

            .anuncios > ul{
                margin-left: 2%; 
            }

            .anuncios > ul > li{
                margin: 0px 0px 15px 0px;
            }
        }

        /*---------------------------------------------------------------------------------------BOTONES*/
        .botones-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
            margin-top: 10px;
            font-family: "Exo 2", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        .button {
            --color: <?php echo $colorEstilo; ?>;
            padding: 0.8em 1.7em;
            background-color: transparent;
            border-radius: .3em;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: .5s;
            font-weight: 700;
            font-size: 17px;
            border: 1px solid;
            font-family: inherit;
            text-transform: uppercase;
            color: var(--color);
            z-index: 1;
        }

        .button > a{
            text-decoration: none;
            color: inherit;
        }

        .button::before, .button::after {
            content: '';
            display: block;
            width: 50px;
            height: 50px;
            transform: translate(-50%, -50%);
            position: absolute;
            border-radius: 50%;
            z-index: -1;
            background-color: var(--color);
            transition: 1s ease;
        }

        .button::before {
            top: -1em;
            left: -1em;
        }

        .button::after {
            left: calc(100% + 1em);
            top: calc(100% + 1em);
        }

        .button:hover::before, .button:hover::after {
            height: 410px;
            width: 410px;
        }

        .button:hover {
            color: rgb(10, 25, 30);
        }

        .button:active {
            filter: brightness(.8);
        }

        /*-----------------------------------------------------------------------------FRASES INSPIRADORAS*/
        .frase-inspiradora {
            color: white;
            display:flex;
            height: 99%;
            width: 99%;
            border-radius: 10px;
            padding: 20px;
            font-size: 1.2em;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            align-items: center;
            justify-content: center;
            text-align: center;
            font-family: "Exo 2", sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
        }

        /*----------------------------------------------------------------------------Musica*/
        .audio-container {
            height: 100px;
            margin: 20px auto;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="<?php echo $logo; ?>" alt="logo del usuario">
            <ul class="info-usuario">
                <li>Nombre de usuario: <?php echo $nombreUsuario; ?></li>
                <li>Matrícula: <?php echo $matri; ?></li>
                <li>Tipo de usuario: <?php echo $text; ?></li>
            </ul>
        </div>
        <nav>
            <ul>
                <?php if ($tipoUsuario == '0') : ?>
                    <li><a href="#">Usuarios</a>
                        <ul>
                            <li><a href="formulario_inserta_usuarios.php">Insertar Usuarios</a></li>
                            <li><a href="FormularioSalon.php">Insertar Salon</a></li>
                            <li><a href="Formulariomateria.php">Insertar Materia</a></li>
                            <li><a href="FormularioHorario.php">Insertar Horario</a></li>
                            <li><a href="FormularioCarrera.php">Insertar Carrera</a></li>
                            <li><a href="Formulario_grupos.php">Insertar Grupo</a></li>
                            <li><a href="FormularioCalificaciones.php">Insertar Califiaciones</a></li>
                            
                        </ul>
                    </li>
                    <li class="vista-admin"><a href="#">Control</a>
                        <ul>
                            <li><a href="tabla_delete.php">Eliminar Usuario</a></li>
                            <li><a href="tabla_update.php">Actualizar Usuario</a></li>
                            <li><a href="TablaSalon.php">Actualizar Salon</a></li>
                            <li><a href="TablaMateria.php">Actualizar Materia</a></li>
                            <li><a href="TablaHorario.php">Actualizar Horario</a></li>
                            <li><a href="TablaCarrera.php">Actualizar Carrera</a></li>
                            <li><a href="TablaGrupo.php">Actualizar Grupo</a></li>
                            <li><a href="Tabla_delete_grupo.php">Eliminar Grupo</a></li>
                            <li><a href="Tabla_delete_calificaciones.php">Eliminar Calificaciones</a></li>
                            <li><a href="Tabla_actualiza_calificaciones.php">Actualizar Calificaciones</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Incersión Masiva</a>
                            <ul>
                                <li><a href="TablaSalonMasiva.php">Salon</a></li>
                                <li><a href="TablaMateriaMasiva.php">Materia</a></li>
                                <li><a href="TablaHorarioMasiva.php">Horario</a></li>
                                <li><a href="TablaCarreraMasiva.php">Carrera</a></li>
                            </ul>
                    </li>
                    <li><a href="#">Consultas</a>
                            <ul>
                                <li><a href="ConsultaUsuarios.php">Usuarios</a></li>
                                <li><a href="ConsultaSalones.php">Salon</a></li>
                                <li><a href="ConsultaMaterias.php">Materias</a></li>
                                <li><a href="ConsultaHorarios.php">Horarios</a></li>
                                <li><a href="ConsultaCarreras.php">Carreras</a></li>
                                <li><a href="forms_buscar_grupos.php">Grupos</a></li>
                                <li><a href="Tabla_consulta_calificaciones.php">Calificaciones</a></li>
                            </ul>
                    </li>
                <?php endif; ?>

                <!-- ALUMNOS-->
                <?php if ($tipoUsuario == '1') : ?>
                    <li><a href="#">Consultas</a>
                            <ul>
                                <li><a href="ConsultaSalones.php">Salon</a></li>
                                <li><a href="ConsultaMaterias.php">Materias</a></li>
                                <li><a href="horario_alumno.php">Grupos</a></li>
                                <li><a href="consulta_calificacion_alumno.php">Calificaciones</a></li>
                            </ul>
                    </li>
                    <li><a href="#">Control</a>
                            <ul>
                                <li><a href="actualiza_alu_profe.php">Actualiza</a></li>
                            </ul>
                    </li>
                    <li><a href="cardex.php">Kardex</a></li>
                <?php endif; ?>

                <!-- PROFESORES -->
                <?php if ($tipoUsuario == '2') : ?>
                    <li><a href="#">Consultas</a>
                            <ul>
                                <li><a href="ConsultaUsuarios.php">Usuarios</a></li>
                                <li><a href="ConsultaSalones.php">Salon</a></li>
                                <li><a href="ConsultaMaterias.php">Materias</a></li>
                                <li><a href="ConsultaCarreras.php">Carreras</a></li>
                            </ul>
                    </li>
                    <li><a href="#">Control</a>
                            <ul>
                                <li><a href="actualiza_nulos_tabla.php">Actualiza Calificaciones</a></li>
                                <li><a href="actualiza_alu_profe.php">Actualiza Info</a></li>
                            </ul>
                    </li>
                    <li><a href="formalumno.php">Kardex Profesores</a></li>
                    <li><a href="#">Grupos</a>
                        <ul>
                            <li><a href="Grupos_profes.php">Grupos Asignados</a></li>
                            <li><a href="consulta_rara.php">Resumen</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li><a href="Contacto.html">Contacto</a></li>
            </ul>
        </nav>
        <a href="action_salir.php" class="btn"><button>Salir</button></a>
    </header>

    <div class="container">
        <div class="recuadro grande">
            <div class="carrusel">
                <div class="carruseles" id="slider1">
                    <section class="slider"><img src="img/Carrusel1.png" alt=""></section>
                    <section class="slider"><img src="img/Carrusel2.png" alt=""></section>
                    <section class="slider"><img src="img/Carrusel3.png" alt=""></section>
                    <section class="slider"><img src="img/Carrusel4.png" alt=""></section>
                </div>
                <div class="bl"><ion-icon name="caret-back-outline"></ion-icon></div>
                <div class="br"><ion-icon name="caret-forward-outline"></ion-icon></div>
            </div>
        </div>
        <div class="recuadro mediano">
            <div class="seccion anuncios">
                <h2>Recordatorios de Fechas Importantes</h2>
                <hr>
                <ul>
                    <li><label>Exámenes finales:</label> Exámenes finales: 30 de noviembre - 6 de diciembre.</li>
                    <li><label>Exámenes extraordinarios:</label> 9 de diciembre - 14 de diciembre.</li>
                    <li><label>Exámenes de regularización:</label> 16 de diciembre - 18 de diciembre.</li>
                </ul>
            </div>
        </div>
        <div class="recuadro mediano">
            <div class="seccion calendario">
                <div class="header-calendario">
                    <button id="prevBtn">◀</button>
                    <div class="mes-year" id="mesYear"></div>
                    <button id="nextBtn">▶</button>
                </div>
                <div class="dias">
                    <div class="dia">Lun</div>
                    <div class="dia">Mar</div>
                    <div class="dia">Mié</div>
                    <div class="dia">Jue</div>
                    <div class="dia">Vie</div>
                    <div class="dia">Sáb</div>
                    <div class="dia">Dom</div>
                </div>
                <div class="fechas" id="fechas"></div>
            </div>
        </div>
        <div class="recuadro pequeno">
            <div class="botones-container">
                <button class="button"><a href="https://www.youtube.com/c/UPSLPoficial2001">Youtube</a></button>
                <button class="button"><a href="https://www.facebook.com/upslp">Facebook</a></button>
                <button class="button"><a href="https://www.instagram.com/upslp_oficial/?hl=es-la">Instagram</a></button>
                <button class="button"><a href="https://www.upslp.edu.mx/upslp/">Pagina web</a></button>
            </div>
        </div>
        <div class="recuadro pequeño">
            <div class="frase-inspiradora">
                <p id="frase"></p>
            </div>
        </div>
        <div class="recuadro mediano">
            <div class="audio-container">
                <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DWWfxnl2EyBbd?utm_source=generator&theme=0" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        //-----------------------------------------------------------------------------------------------------
        /*Carrusel de imagenes*/
        const botonIzq = document.querySelector(".bl");
        const botonDer = document.querySelector(".br");
        const slideer = document.querySelector("#slider1");
        const sliderSection = document.querySelectorAll(".slider");
        let op = 0;
        let counter = 0;
        // botones
        botonIzq.addEventListener("click", moverIzq);
        botonDer.addEventListener("click", moverDer);
        // cambiar imagen cada 5s
        setInterval(moverDer, 5000);
        // Mover la imagen a la derecha
        function moverDer() {
            if (counter >= sliderSection.length - 1) {
                op = 0;
                counter = 0;
            } else {
                counter++;
                op += 100 / sliderSection.length;
            }
            slideer.style.transform = `translateX(-${op}%)`;
            slideer.style.transition = "transform 0.6s ease";
        }
        // Mover la imagen a la izquierda
        function moverIzq() {
            if (counter <= 0) {
                counter = sliderSection.length - 1;
                op = 100 - (100 / sliderSection.length);
            } else {
                counter--;
                op -= 100 / sliderSection.length;
            }
            slideer.style.transform = `translateX(-${op}%)`;
            slideer.style.transition = "transform 0.6s ease";
        }

            
        //----------------------------------------------------------CALENDARIO-------------------------------------------------------------------------
        const mesYearElement = document.getElementById('mesYear');
        const fechas = document.getElementById('fechas');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        let currentFecha = new Date();

        const actualizarCalendario = () => {
            const currentYear = currentFecha.getFullYear();
            const currentMes = currentFecha.getMonth();

            const primerDia = new Date(currentYear, currentMes, 0);
            const ultimoDia = new Date(currentYear, currentMes + 1, 0);
            const totalDia = ultimoDia.getDate();
            const primerDiaIndex = primerDia.getDay();
            const ultimoDiaIndex = ultimoDia.getDay();

            const monthYearString = currentFecha.toLocaleString('default', { month: 'long', year: 'numeric' });
            mesYearElement.textContent = monthYearString;

            let fechaHTML = '';

            for (let i = primerDiaIndex; i > 0; i--) {
                const anteriorFecha = new Date(currentYear, currentMes, 0 - i + 1);
                fechaHTML += `<div class="fecha inactive">${anteriorFecha.getDate()}</div>`;
            }

            for (let i = 1; i <= totalDia; i++) {
                const fecha = new Date(currentYear, currentMes, i);
                const activeClass = fecha.toDateString() === new Date().toDateString() ? 'active' : '';
                fechaHTML += `<div class="fecha ${activeClass}">${i}</div>`;
            }

            for (let i = 1; i <= 7-ultimoDiaIndex; i++) {
                const siguienteFecha = new Date(currentYear, currentMes + 1, i);
                fechaHTML += `<div class="fecha inactive">${siguienteFecha.getDate()}</div>`;
            }

            fechas.innerHTML = fechaHTML;
        };

        prevBtn.addEventListener('click', () => {
            currentFecha.setMonth(currentFecha.getMonth() - 1);
            actualizarCalendario();
        });

        nextBtn.addEventListener('click', () => {
            currentFecha.setMonth(currentFecha.getMonth() + 1);
            actualizarCalendario();
        });

        actualizarCalendario();

        /*--------------------------------------------------------FRASES-------------------------------------------*/
        const frases = [
            "El éxito es la suma de pequeños esfuerzos repetidos día tras día.",
            "Nunca es tarde para aprender algo nuevo.",
            "La disciplina supera al talento.",
            "El futuro pertenece a quienes creen en la belleza de sus sueños.",
            "La única forma de hacer un gran trabajo es amar lo que haces.",
            "No cuentes los días, haz que los días cuenten.",
            "El único límite a nuestros logros de mañana son nuestras dudas de hoy.",
            "El fracaso es simplemente la oportunidad de comenzar de nuevo, esta vez de forma más inteligente.",
            "La vida es 10% lo que me sucede y 90% cómo reacciono a ello.",
            "No te detengas hasta estar orgulloso.",
            "Cree que puedes y ya estás a mitad de camino.",
            "La perseverancia es el camino del éxito."
        ];

        document.getElementById("frase").textContent = frases[Math.floor(Math.random() * frases.length)];
    </script>
  </body>
</html>