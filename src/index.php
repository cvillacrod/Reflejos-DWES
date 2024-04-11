<?php include '../public/auth.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REFLEJOS-LOGIN</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    
</head>
<body class="fondo-login">
            <div class="contenedor-login">
                <div id="login">
                    <div class="titulo">
                        REFLEJOS
                    </div>
                        <form id="loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div>
                                <label for="email">Correo electrónico:</label>
                                <input type="email" id="email" name="email" placeholder="email" required>
                            </div>
                            <div>
                                <label for="password">Contraseña:</label>
                                <input type="password" id="password" name="password" placeholder="pass" required>
                            </div>
                            <button type="submit">Iniciar sesión</button>
                            <br></br>
                            <?php if ($error_message != ""): ?>
                                
                            <div style="color: red;"><?php echo $error_message; ?></div>
                            <?php endif; ?> 

                        </form>                        
                </div>
            </div>
   </body>

</html>



