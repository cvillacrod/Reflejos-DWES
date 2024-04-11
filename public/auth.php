<?php
    require_once '../vendor/autoload.php';

    use Kreait\Firebase\Factory;

    $error_message = ""; // variable para el mensaje de error
    if (!defined('DIR')) {
        define('DIR', __DIR__ . '/');
    }
    $credentialsPath = DIR . '../bbdd_key/key.json';

    $firebase = (new Factory)->withServiceAccount($credentialsPath);
    $auth = $firebase->createAuth();
    session_start();
    session_destroy();  //elimina las variables de sesion( al cerrar sesion , vuelve a index)

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $signInResult = $auth->signInWithEmailAndPassword($email, $password);
            //usuario autenticado correctamente, redirige al main
            // $error_message = "CORRECTO";        
            session_start();
            $_SESSION["email"] = $_POST["email"];
            header("Location: main.php");

            exit();

        } catch (Exception $e) 
        {
            if ($e->getMessage() === 'INVALID_LOGIN_CREDENTIALS') 
            {
                $error_message = "Verifica tu correo electrónico y contraseña.";
            } elseif ($e->getMessage() === 'TOO_MANY_ATTEMPTS_TRY_LATER') 
            {
                $error_message = "Intentelo mas tarde";
            } elseif ($e->getMessage() === 'A password must be a string with at least 6 characters.') 
            {
                $error_message = "La contraseña debe tener al menos 6 caracteres";
            } elseif ($e->getMessage() === 'The email address is invalid.') 
            {
                $error_message = "El email es incorrecto";
            } else {
                $error_message = "Verifica tu correo electrónico y contraseña." . $e->getMessage();
            }
        }
    }
?>
