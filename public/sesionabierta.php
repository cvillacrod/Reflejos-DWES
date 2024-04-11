<?php
    session_start();
    //verifica si el usuario está autenticado (si la variable de sesión email está definida)
    if (isset($_SESSION["email"])) {
        $email = $_SESSION["email"];
        
        echo '<div style="text-align: right;">';
            //contenedor para alinear horizontalmente el enlace y la imagen
            echo '<div style="display: inline-block; vertical-align: middle;">';
                //ágrega un enlace para cerrar sesión que redirige a index.php
                echo '<a href="index.php" style="vertical-align: middle;">Cerrar sesión</a>';
                //aade una imagen como icono de usuario
                echo '<img src="../imagenes/usuario.png" alt="' . $email . '" title="' . $email . '" style="width: 3%; vertical-align: middle;">';
            echo '</div>';
        echo '</div>';

    } else {
        //si no está autenticado, redirige a la página de inicio de sesión
        header("Location: index.php");
        exit(); 
    }
?>

