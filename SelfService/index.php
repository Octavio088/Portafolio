<?php
	if (isset($_COOKIE['nombreUsuario'])) {
		header("Location: Menu.php");
	}
?>
<?php
include('main/header.php'); 
?>
<script src="js/load_captcha.js"></script> 
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>

        :root{
            --fondo-body:rgb(0, 0, 0);
            --fondo-contenedor: rgb(34, 34, 34);
            --fondo-contenedor-input: rgb(15, 15, 15);
            --color-particula: rgb(0, 22, 48);
            --color-particula-sombra: rgb(21, 126, 224);
            --color-boton: hsl(207, 100%, 53%);
            --color-boton-particula: hsl(207, 100%, 53%);
            --color-texto-boton: #000000;
            --color-text-form: rgb(255, 255, 255);
        }

        /*----------------------------------------------------------------------------BODY*/
        body {
            background-color: var(--fondo-body);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /*----------------------------------------------------------------------------CONTENEDOR*/
        .contenedor{
            background-color: var(--fondo-contenedor);
            width: 90vw;
            height: 75vh;
            border-radius: 20px;
            display: flex; /* Usar Flexbox para alinear los elementos */
            justify-content: space-between; /* Asegura que la imagen y el formulario se distribuyan correctamente */
            align-items: center; /* Centra los elementos verticalmente */
            box-sizing: border-box; /* Asegura que el padding se incluya en el tamaño total */
            z-index: 2;
        }

        /*----------------------------------------------------------------------------IMAGEN CONTENEDOR*/
        .contenedor img {
            width: 50%; /* La imagen ocupa el 50% del ancho del contenedor */
            height: 100%; /* La imagen ocupa toda la altura del contenedor */
            object-fit: cover; /* Ajusta la imagen para que no se deforme */
            border-radius: 20px 0px 0px 20px;
        }

        /*---------------------------------------------------------------------------FORMULARIO*/

        .contenedor form {
            width: 50%;
            padding: 20px;
            margin: 15px;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        .contenedor form h1{
            color: var(--color-text-form);
            text-align: center;
            font-size: clamp(5px, 2.2vw, 48px);
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        .contenedor form p{
            color: var(--color-text-form);
            text-align: center;
            font-size: clamp(5px, 1.6vw, 40px);
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }

        .contenedor form .linea{
            display: flex;
            justify-content: space-between; /* Se alinean los campos a la izquierda y derecha */
            gap: 10px; /* Espacio entre los campos */
        }

        .contenedor form .linea .l1{
            flex: 1;
        }

        .contenedor form label {
            color: var(--color-text-form);
            font-size: 18px;
            margin-bottom: 8px;
            font-weight: bold;
            font-family: "Signika", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings: "GRAD" 0;
        }

        .contenedor form input {
            margin-top: 15px;
            color: var(--color-text-form);
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid white;
            width: 100%; /* El campo de texto ocupa todo el ancho disponible */
            box-sizing: border-box;
            font-family: 'calibri';
            background: var(--fondo-body);
        }

        .contenedor form input:focus {
            border-color: #3498db; /* Cambia el color del borde al hacer foco */
            outline: none; /* Elimina el contorno del campo cuando está en foco */
        }

        @media (min-height: 945px){
            .contenedor form input {
                margin-top: 15px;
                color: var(--color-text-form);
                padding: 10px;
                margin-bottom: 15px;
                font-size: 16px;
                border-radius: 5px;
                border: 1px solid white;
                width: 100%; /* El campo de texto ocupa todo el ancho disponible */
                box-sizing: border-box;
                font-family: 'calibri';
                background: var(--fondo-contenedor-input);
            }

            .contenedor form input:focus {
                border-color: #3498db; /* Cambia el color del borde al hacer foco */
                outline: none; /* Elimina el contorno del campo cuando está en foco */
            }
        }
        /*--------------------------------------------------------------------------------------------BOTON*/

        form > button{
            border: none;
            margin: 12px 0px;
            padding: 10px 22px;
            width: 140px;
            height: 50px;
            font-size: 16px;
            font-weight: 400;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: var(--color-texto-boton);
            background: white;
            cursor: pointer;
            border-radius: 7px;
            transition: transform 0.2s ease;
            box-shadow: 0 5px 10px rgb(0, 0, 0, 0.1);
        }

        .button {
            position: relative;
            padding: 10px 22px;
            border-radius: 6px;
            border: none;
            color: var(--color-texto-boton);
            cursor: pointer;
            background-color: var(--color-boton);
            transition: all 0.2s ease;
        }
        
        .button:active {
            transform: scale(1);
        }

        .button:hover{
            transform: scale(1.1);
            background: rgb(0, 0, 95);
            color: white;
        }
        
        .button:before,
        .button:after{ 
            transform: scale(2);
            position: absolute;
            content: "";
            width: 150%;
            left: 50%;
            height: 100%;
            transform: translateX(-50%);
            z-index: -1000;
            background-repeat: no-repeat;
        }
        
        .button:hover:before {
            top: -70%;
            background-image: radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, transparent 20%, var(--color-boton-particula) 20%, transparent 30%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, transparent 10%, var(--color-boton-particula) 15%, transparent 20%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%);
            background-size: 10% 10%, 20% 20%, 15% 15%, 20% 20%, 18% 18%, 10% 10%, 15% 15%,
            10% 10%, 18% 18%;
            background-position: 50% 120%;
            animation: greentopBubbles 0.6s ease;
        }
        
        @keyframes greentopBubbles {
            0% {
            background-position: 5% 90%, 10% 90%, 10% 90%, 15% 90%, 25% 90%, 25% 90%,
                40% 90%, 55% 90%, 70% 90%;
            }
        
            50% {
            background-position: 0% 80%, 0% 20%, 10% 40%, 20% 0%, 30% 30%, 22% 50%,
                50% 50%, 65% 20%, 90% 30%;
            }
        
            100% {
            background-position: 0% 70%, 0% 10%, 10% 30%, 20% -10%, 30% 20%, 22% 40%,
                50% 40%, 65% 10%, 90% 20%;
            background-size: 0% 0%, 0% 0%, 0% 0%, 0% 0%, 0% 0%, 0% 0%;
            }
        }
        
        .button:hover::after {
            bottom: -70%;
            background-image: radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, transparent 10%, var(--color-boton-particula) 15%, transparent 20%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%),
            radial-gradient(circle, var(--color-boton-particula) 20%, transparent 20%);
            background-size: 15% 15%, 20% 20%, 18% 18%, 20% 20%, 15% 15%, 20% 20%, 18% 18%;
            background-position: 50% 0%;
            animation: greenbottomBubbles 0.6s ease;
        }
        
        @keyframes greenbottomBubbles {
            0% {
            background-position: 10% -10%, 30% 10%, 55% -10%, 70% -10%, 85% -10%,
                70% -10%, 70% 0%;
            }
        
            50% {
            background-position: 0% 80%, 20% 80%, 45% 60%, 60% 100%, 75% 70%, 95% 60%,
                105% 0%;
            }
        
            100% {
            background-position: 0% 90%, 20% 90%, 45% 70%, 60% 110%, 75% 80%, 95% 70%,
                110% 10%;
            background-size: 0% 0%, 0% 0%, 0% 0%, 0% 0%, 0% 0%, 0% 0%;
            }
        }
        
        /*-------------------------------------------------------------CAPTCHA*/
        #captcha {
            width: 300px;
            height: 100px;
            border-radius: 0px;
        }

        #reloadCaptcha {
            margin-left: 10px;
            color: white;
            text-decoration: none;
        }

        .col-md-4 {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .control-label {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
        }

        .form-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        a{
            font-family: 'Poppins', sans-serif;
        }

        /*-------------------------------------------------------------------PARTICULAS*/
        .particles-container {
            position: absolute;
            width: 100%;
            height: 98vh;
            overflow: hidden;
            z-index: 0;
        }

        .particula {
            position: absolute;
            width: 12px;
            height: 12px;
            background-color: var(--color-particula);
            border-radius: 50%;
            filter: drop-shadow(0 0 10px var(--color-particula-sombra));
            z-index: 1;
        }

        /*----------------------------------------------------------------------------------------------*/
        .contra{
            display:flex;
            align-items:center;
        }

        .contra ion-icon{
            font-size: 30px;
            padding: 5px;
            cursor: pointer;
            color: var(--color-text-form);
            border-radius: 5px;
            border: 1px solid white;
            width: 10%; /* El campo de texto ocupa todo el ancho disponible */
            box-sizing: border-box;
            font-family: 'calibri';
            background: var(--fondo-body);
        }
    </style>
</head>
<body>
<div class="contenedor">
        <img src="img/Login.png">
        <form action="action_login.php" method="post">
            <h1>Self-Service</h1>
            <p>Universidad Politécnica de San Luis Potosí</p>
            <div class="linea">
                <div class="l1">
                    <label for="uname"><b>Usuario</b></label>
                    <input type="text" placeholder="Escribe tu matr&iacute;cula" name="varUser" required>
                </div>
                <div class="l1">
                    <label for="psw"><b>Contrase&ntilde;a</b></label>
                    <div class="contra">
                        <input type="password" placeholder="Contrase&ntilde;a" name="varPass" id="passw" required>
                        <ion-icon name="eye-outline" id="eye"></ion-icon>
                    </div>
                </div>
            </div>
            <label><b>Inserta codigo de seguridad</b></label>
            <input type="text" name="securityCode" id="securityCode" class="form-control" placeholder="Código de seguridad">
            <div class="form-container">
                <label class="col-md-4 control-label">
                    <img style="border: 1px solid #D3D0D0" src="get_captcha.php?rand=<?php echo rand(); ?>" id='captcha'>
                </label>
                <a href="javascript:void(0)" id="reloadCaptcha">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Recargar código
                </a>
            </div>
            <button class="button" type="submit">Acceso</button>
        </form>
    </div>
    <div class="particles-container"></div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function crearParticulas(numParticulas) {
            const particlesContainer = document.querySelector(".particles-container");

            for (let i = 0; i < numParticulas; i++) {
                let particula = document.createElement("div");
                particula.classList.add("particula");
                particlesContainer.appendChild(particula);
            }
        }

        function createParticleStyles() {
            let styles = '';
            const containerWidth = document.querySelector('.particles-container').offsetWidth;
            const containerHeight = document.querySelector('.particles-container').offsetHeight;

            for (let i = 1; i <= 200; i++) {
                const opacity = (Math.random() * 0.5 + 0.5).toFixed(2);
                const startX = Math.floor(Math.random() * containerWidth);  // Posición inicial X dentro del contenedor
                const startY = containerHeight + Math.floor(Math.random() * 20); // Iniciar justo debajo del contenedor
                const endX = Math.floor(Math.random() * containerWidth);    // Posición final X
                const endY = -20; // Terminan justo fuera del contenedor hacia arriba
                const duration = Math.random() * 8 + 12; // Duración entre 12s y 20s (más rápida)
                const scale = (Math.random() * 0.5 + 1.9).toFixed(2); // Escala entre 1.2 y 1.7 (más grande)

                styles += `
                .particula:nth-child(${i}) {
                    opacity: ${opacity};
                    transform: translate(${startX}px, ${startY}px) scale(${scale});
                    animation: subir-${i} ${duration}s linear infinite;
                }
                
                @keyframes subir-${i} {
                    90% {
                        opacity: 1; /* Totalmente visible */
                    }
                    100% {
                        transform: translate(${endX}px, ${endY}px) scale(${scale});
                        opacity: 0; /* Desaparece al final */
                    }
                }
                `;
            }
            const styleElement = document.createElement('style');
            styleElement.innerHTML = styles;
            document.head.appendChild(styleElement);
        }

        crearParticulas(200);
        createParticleStyles();

    /*----------------------------------------------------------------------------CONTRASEÑA*/
        let eye = document.getElementById("eye");
        let password = document.getElementById("passw");

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