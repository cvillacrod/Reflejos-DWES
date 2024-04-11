<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>REFLEJOS-LOGIN</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body class="fondo-home">
         
        <?php include '../public/menu.php'; ?>

        <div class="contenedor-titulo">
            <h1 class="titulo">REFLEJOS</h1>   
        </div>            
  
        <?php include '../public/conbbdd.php'; ?>

        <?php

            use Google\Cloud\Core\Timestamp;
            include '../clases/Programa.php';
            include '../clases/Entrenador.php';
            include '../clases/Categoria.php';
            //establece la conexión a la base de datos
            $db = conectarBD();
            if ($db !== null)
            { 
                //obtiene la colección 'programas'
                $programasRef = $db->collection('programas');
                //var_dump($programasRef);
                
                //obtiene los documentos de la colección 'programas'
                $query = $programasRef->documents();

                echo '<div class="card-container">';
                //recorre cada documento en la colección 'programas'
                /*foreach ($query as $document) 
                {
                    $programaData = $document->data();

                    //muestra los datos del programa tipo card
                    echo '<div class="card">';
                    echo '<img src="../imagenes/programa2.png" alt="Programa" class="user-image">';
                    
                
                    //mostrar el tipo del programa
                        $tipoId=$programaData['tipo'];
                        //echo $tipoId;
                        //extraer el ID de la categoría de la ruta completa
                        $tipoId = substr($tipoId, strrpos($tipoId, '/') + 1);
                        //echo $tipoId;
                        //obtiene el documento de la categoría
                        $tipoDoc = $db->document('categorias/' . $tipoId)->snapshot();

                        //obtiene el nombre del primer campo del documento de la categoría
                        $tipoNombre = array_keys($tipoDoc->data())[0];
                        //muestra el nombre del primer campo de la categoría

                        echo '<div class="nombre">';
                                echo '<span class="name">' .  $tipoNombre . '</span>';
                            echo '</div>';

                    echo '<p>Distancia: ' . $programaData['distancia'] . '</p>';
                    echo '<p>Número de ciclos: ' . $programaData['nciclos'] . '</p>';
                    echo '<p>Tiempo de ejercicio (en segundos): ' . $programaData['tejercicio'] . '</p>';
                    echo '<p>Tiempo de descanso (en segundos): ' . $programaData['tdescanso'] . '</p>';
                    
                    //obtiene el ID del entrenador y su email
                    $entrenadorRef = $programaData['entrenador']->path();
                    $entrenadorId = substr($entrenadorRef, strrpos($entrenadorRef, '/') + 1);
                    $entrenadorDoc = $db->document($entrenadorRef)->snapshot();
                    $entrenadorData = $entrenadorDoc->data();
                    $entrenadorEmail = $entrenadorData['email'];

                    echo '<p>Entrenador: ' . $entrenadorEmail . '</p>';
                    echo '<textarea style="width: 96%;">'.$programaData['descripcion'].'</textarea>';
                    
                 
                    echo '<div class="button-container">';
                        echo '<button type="submit" class="agregarButton" onclick="location.href=\'modificarprograma.php?id=' . $document->id() . '\'">Modificar</button>';

                    echo '</div>'; //cierra el div "button-container"
                        
                    echo '<button type="button" class="eliminarButton" onclick="confirmarEliminacion(\'' . $document->id() . '\')">';
                        echo '<img src="../imagenes/trash.png" alt="Eliminar">';
                    echo '</button>';
                        echo '</div>'; //cierra el div "programa"

                }*/

                foreach ($query as $document) {
                    $programaData = $document->data();
                
                    // Obtener el ID del entrenador y su email
                    $entrenadorRef = $programaData['entrenador']->path();
                    $entrenadorId = substr($entrenadorRef, strrpos($entrenadorRef, '/') + 1);
                    $entrenadorDoc = $db->document($entrenadorRef)->snapshot();
                    $entrenadorData = $entrenadorDoc->data();
                    $entrenadorEmail = $entrenadorData['email']; 
                    // Crear una instancia de Entrenador con los datos del entrenador
                    $entrenador = new Entrenador($entrenadorId, $entrenadorEmail);


                    //mostrar el tipo del programa
                    $tipoId=$programaData['tipo'];
                    //extraer el ID de la categoría de la ruta completa
                    $tipoId = substr($tipoId, strrpos($tipoId, '/') + 1);
                    //obtiene el documento de la categoría
                    $categoriaDoc = $db->document('categorias/' . $tipoId)->snapshot();
                    //obtiene el nombre del primer campo del documento de la categoría
                    //$tipoNombre = array_keys($tipoDoc->data())[0];
                    $categoriaData = $categoriaDoc->data();
                    $categoria = new Categoria($tipoId, array_keys($categoriaData)[0]); //obtiene el nombre del primer campo del documento de la categoría
                    $tipoNombre = $categoria->getNombre();
                    
                
                
                    // Crear una instancia de Programa con los datos del documento
                    $programa = new Programa(
                        //$programaData['tipo'],
                        $tipoNombre,    
                        $programaData['distancia'],
                        $programaData['nciclos'],
                        $programaData['tejercicio'],
                        $programaData['tdescanso'],
                        $entrenadorEmail=$entrenador->getEmail(),
                        $programaData['descripcion']
                    );
                
                    // Mostrar los detalles del programa utilizando los métodos getters de la clase Programa
                    echo '<div class="card">';
                        echo '<img src="../imagenes/programa2.png" alt="Programa" class="user-image">';
                        
                        echo '<div class="nombre">';
                            echo '<span class="name">' . $programa->getTipo() . '</span>';
                        echo '</div>'; //cierra el del div "nombre"
                        
                        echo '<p><strong>Distancia:</strong> ' . $programa->getDistancia() . '</p>';
                        echo '<p><strong>Número de ciclos:</strong> ' . $programa->getNCiclos() . '</p>';
                        echo '<p><strong>Tiempo de ejercicio:</strong> ' . $programa->getTEjercicio() . " segundos".'</p>';
                        echo '<p><strong>Tiempo de descanso:</strong> ' . $programa->getTDescanso() . " segundos".'</p>';
                        echo '<p><strong>Entrenador:</strong> ' . $programa->getEntrenador() . '</p>';
                        echo '<textarea style="width: 96%;">' . $programa->getDescripcion() . '</textarea>';
                        
                        echo '<div class="button-container">';
                            echo '<button type="submit" class="agregarButton" onclick="location.href=\'modificarprograma.php?id=' . $document->id() . '\'">Modificar</button>';
                        echo '</div>'; //cierra el div "button-container"
                        
                        echo '<button type="button" class="eliminarButton" onclick="confirmarEliminacion(\'' . $document->id() . '\')">';
                            echo '<img src="../imagenes/trash.png" alt="Eliminar">';
                        echo '</button>';
                    echo '</div>'; //cierra el del div "programa"
                }

                echo '</div>'; //cierra el div "programas-container"

            } 


?>
    </body>

</html>

