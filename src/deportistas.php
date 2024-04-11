<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>REFLEJOS-DEPORTISTAS</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
    
        <script>
            //función para confirmar que se elimina el deportista
            function confirmarEliminacion(id) {
                //ventana emergente de confirmación
                var confirmacion = confirm("¿Está seguro de borrar este deportista?");
                if (confirmacion) {
                    //si se confirma la eliminación, redireccionar a eliminardeportista.php con el ID del deportista
                    window.location.href = "eliminardeportista.php?id=" + id;
                }else
                {
                    window.location.href ="Location: deportistas.php";
                }
            }
        </script>
    </head>
 

    <body class="fondo-home">
         
    <?php include '../public/menu.php'; ?>

        <div class="contenedor-titulo">
            <h1 class="titulo">REFLEJOS</h1>   
        </div>            

        <?php include '../public/conbbdd.php'; ?>

        <?php

            include '../clases/Deportista.php';
            include '../clases/Entrenador.php';
            //establece la conexión a la base de datos
            $db = conectarBD();
            if ($db !== null)
            {                        
                echo "<br></br>";
                //obtiene la colección 'deportistas'
                $deportistasRef = $db->collection('deportistas');
                //var_dump($deportistasRef);

                //obtiene los documentos de la colección 'deportistas'
                $query = $deportistasRef->documents();

                echo '<div class="card-container">';
                //recorre sobre cada documento en la colección 'deportistas'
                foreach ($query as $document) {
                    $deportistaData = $document->data();
                

                    //obtiene el ID del entrenador y su email
                    $entrenadorRef = $deportistaData['entrenador']->path();
                    $entrenadorId = substr($entrenadorRef, strrpos($entrenadorRef, '/') + 1);
                    $entrenadorDoc = $db->document($entrenadorRef)->snapshot();
                    $entrenadorData = $entrenadorDoc->data();
                    $entrenadorEmail = $entrenadorData['email'];
                    //crea una instancia de Entrenador
                    $entrenador = new Entrenador($entrenadorId, $entrenadorEmail);



                    //crea una instancia de Deportista
                    $deportista = new Deportista(
                        $deportistaData['nombre'],
                        $deportistaData['apellido1'],
                        $deportistaData['apellido2'],
                        $deportistaData['fechanacimiento']->get()->getTimestamp(),
                        $deportistaData['club'],
                        $deportistaData['deporte'],
                        //obtiene el email del entrenador del deportista
                        $entrenadorEmail=$entrenador->getEmail()

                    );
                
                    // muestra los datos del deportista 
                    echo '<div class="card">';
                        echo '<img src="../imagenes/usuario.png" alt="Usuario" class="user-image">';

                        echo '<div class="nombre">';
                             echo '<span class="name">' . $deportista->getNombre() . ' ' . $deportista->getApellido1() . ' ' . $deportista->getApellido2() . '</span>';
                        echo '</div>'; //cierra el del div "nombre"

                        echo '<div class="info">';
                            echo '<p><strong>Fecha de nacimiento:</strong> ' . date('d-m-Y', $deportista->getFechaNacimiento()) . '</p>';
                            echo '<p><strong>Club:</strong> ' . $deportista->getClub() . '</p>';
                            echo '<p><strong>Deporte:</strong> ' . $deportista->getDeporte() . '</p>';
                            echo '<p><strong>Email del entrenador:</strong> ' . $deportista->getEntrenadorEmail() . '</p>';
                        echo '</div>'; //cierra el div "info"

                        echo '<div class="button-container">';
                             echo '<button type="submit" class="modificarButton" onclick="location.href=\'modificardeportista.php?id=' . $document->id() . '\'">Modificar</button>';
                        echo '</div>'; //cierra el div "button-container"
                        
                        echo '<button type="button" class="eliminarButton" onclick="confirmarEliminacion(\'' . $document->id() . '\')">';
                            echo '<img src="../imagenes/trash.png" alt="Eliminar">';
                        echo '</button>';

                    echo '</div>'; //cierra el del div "card"
                }

                echo '</div>'; //cierra el del div "card-container"

            }   

        ?>

    

    </body>

</html>
















