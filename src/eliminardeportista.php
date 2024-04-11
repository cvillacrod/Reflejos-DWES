<?php include '../public/conbbdd.php'; ?>
       
    <?php

        $db = conectarBD();
        if ($db !== null)
        { 
            //comprueba si se ha proporcionado el ID del deportista a eliminar
            if (isset($_GET['id'])) {
                $deportistaId = $_GET['id'];

                //deportista que se va a eliminar
                $deportistaRef = $db->collection('deportistas')->document($deportistaId);

                //eliminar el documento del deportista
                $deportistaRef->delete();

                //redirije con un mensaje ok
                header("Location: deportistas.php?mensaje=Deportista eliminado correctamente");
                exit;
            } else 
            {
                header("Location: deportistas.php?mensaje=Error al eliminar el deportista");
                exit;
            }
        } 
?>
