<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>REFLEJOS-MODIFICAR PROGRAMA</title>
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
            include '../clases/Programa.php';
            use Google\Cloud\Core\Timestamp;

            //establece la conexión a la base de datos
            $db = conectarBD();
            if ($db !== null)
            { 
                // Obtener el ID del programa a modificar de la URL
                if(isset($_GET['id'])) {
                    $programaId = $_GET['id'];

                    //consulta para obtener los datos del programa con el ID proporcionado
                    $programaRef = $db->collection('programas')->document($programaId);
                    $programaDoc = $programaRef->snapshot();
                    $programaData = $programaDoc->data();

                    //guarda los datos del programa
                    $descripcion = $programaData['descripcion'];
                    $distancia = $programaData['distancia'];
                    $nciclos = $programaData['nciclos'];
                    $tdescanso = $programaData['tdescanso'];
                    $tejercicio = $programaData['tejercicio'];
                    $tipo = $programaData['tipo'];        
                    $entrenador = $programaData['entrenador']->id();
                //} se cierra bajo el php

                    // Crear un nuevo objeto Programa con los datos del f($tipo, $distancia, $nciclos, $tejercicio, $tdescanso, $entrenador, $descripcion)ormulario
                    $programa = new Programa($tipo, $distancia, $nciclos, $tejercicio, $tdescanso, $entrenador, $descripcion);
                ?>


                    <form id="formulario-programa" method="post" action="guardarprograma.php">
                        <h2 class="titulo-formulario">MODIFICAR PROGRAMA</h2> 
                        <input type="hidden" name="id" value="<?php echo $programaId; ?>">

                            <?php
                                // Mostrar mensaje de éxito o error
                                if (isset($_GET['mensaje'])) {
                                    $mensaje = $_GET['mensaje'];
                                    echo '<div style="color: ' . ($mensaje === 'Programa modificado correctamente' ? 'green' : 'red') . ';">' . $mensaje . '<br></br></div>';
                                }
                            ?>

                            <div style="display: flex; flex-direction: column;">
                                <div style="display: flex; flex-direction: row; align-items: center;">
                                    <label for="distancia">Distancia:</label>
                                    <input type="number" min="0" id="distancia" name="distancia" value="<?php echo $programa->getDistancia(); ?>" required style="margin-left: auto;">
                                </div>
                                <div style="display: flex; flex-direction: row; align-items: center;">
                                    <label for="nciclos">Número de ciclos:</label>
                                    <input type="number" min="0" id="nciclos" name="nciclos" value="<?php echo $programa->getNCiclos(); ?>" required style="margin-left: auto;">
                                </div>
                                <div style="display: flex; flex-direction: row; align-items: center;">
                                    <label for="tejercicio">Tiempo de ejercicio (en segundos):</label>
                                    <input type="number" min="0" id="tejercicio" name="tejercicio" value="<?php echo $programa->getTEjercicio(); ?>" required style="margin-left: auto;">
                                </div>
                                <div style="display: flex; flex-direction: row; align-items: center;">
                                    <label for="tdescanso">Tiempo de descanso (en segundos):</label>
                                    <input type="number" id="tdescanso" name="tdescanso" value="<?php echo $programa->getTDescanso(); ?>" required style="margin-left: auto;">
                            </div>
            
                        <?php
                            //obtiene  el tipo y nombre  que es y dejarlo seleccionado
                            $tipo=$programa->getTipo();          
                            $tipoId = substr($tipo, strrpos($tipo, '/') + 1);
                            //obtieneel documento de la categoría
                            $tipoDoc = $db->document('categorias/' . $tipoId)->snapshot();
                            //obtiene el nombre del primer campo del documento de la categoría
                            $tipoNombre = array_keys($tipoDoc->data())[0];


                            //obtiene la referencia a la colección de categorías
                            $categoriasCollection = $db->collection('categorias');

                            //obtiene una lista de todos los documentos en la colección de categorías
                            $documentRefs = $categoriasCollection->listDocuments();

                            //comienza el select del tipo de programa
                            echo '<label for="tipo">Tipo:</label>';
                            echo '<select id="tipo" name="tipo">';
                                echo '<option value="">Seleccione un tipo</option>';

                                //recorre los documentos de las categorías
                                foreach ($documentRefs as $documentRef) {
                                    //obtiene la instantánea del documento
                                    $snapshot = $documentRef->snapshot();
                                    //obtiene los datos del documento
                                    $data = $snapshot->data();
                                    //obtiene el id del documento
                                    $nombreCategoria = $documentRef->id();
                                    
                                    //comprueba si este es el tipo seleccionado
                                    if (key($data) == $tipoNombre) {
                                        //si es el mismo, se pone como opción seleccionada
                                        echo '<option value="' . $nombreCategoria . '" selected>' . key($data) . '</option>';
                                    } else {
                                        echo '<option value="' . $nombreCategoria . '">' . key($data) . '</option>';
                                    }
                                }
                            // cierra el select de entrenadores
                            echo '</select>';
                        ?>

                            <label for="entrenador">Entrenador:</label>
                            <select id="entrenador" name="entrenador">
                                <option value="">Seleccione entrenador</option>
                                <?php
                                    //obtiene la colección de usuarios de Firestore
                                    $usersCollection = $db->collection('users');
                                    $documents = $usersCollection->documents();
                                    //recorre los documentos de los usuarios
                                    foreach ($documents as $userDoc) {
                                        $userData = $userDoc->data();
                                        $email = $userData['email'];
                                        $uid = $userDoc->id();
                                        //si es el mismo, se pone como email del entrenador seleccionado
                                        $selected = ($entrenador == $uid) ? 'selected' : '';
                                        echo '<option value="' . $uid . '" ' . $selected . '>' . $email .'</option>';

                                    }
                                ?>
                            </select>

                            <textarea style="width: 96%;" name="descripcion"><?php echo $programa->getDescripcion();  ?></textarea>

                        <div class="guardar-container">
                            <button type="submit" class="guardarButton" onclick="location.href=\'guardaprograma.php?id=' . $programaId . '\'">Guardar</button>         
                        </div>

                    </form>

            <?php
                } else 
                {
                    echo "No se proporcionó el ID del programa a modificar.";
                }

            } 

            ?>


    </body>

</html>



