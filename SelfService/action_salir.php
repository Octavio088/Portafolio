<?php
    // Borrar las cookies
    setcookie("nombreUsuario", "", time() - 3600);
    setcookie("tipoUsuario", "", time() - 3600);

    // Enviar al login
    header("Location: index.php");
?>