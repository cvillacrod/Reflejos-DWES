<?php include '../public/conbbdd.php'; ?>
       
    <?php

        $db = conectarBD();
        if ($db !== null)
        { 

            //comprueba si se ha proporcionado el ID del programa a eliminar
            if (isset($_GET['id'])) {
                $programaId = $_GET['id'];

                //programa que se va a eliminar
                $programaRef = $db->collection('programas')->document($programaId);

                 //eliminar el documento del programa
                $programaRef->delete();

                //redirije con un mensaje de éxito
                header("Location: programas.php?mensaje=Programa eliminado correctamente");
                exit;
            } else 
            {
                header("Location: programas.php?mensaje=Error al eliminar el programa");
                exit;
            }
        } 
?>
