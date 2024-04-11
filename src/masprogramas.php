<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>REFLEJOS-AÑADIR PROGRAMAS</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body class="fondo-home">
         
        <?php include '../public/menu.php'; ?>

        <div class="contenedor-titulo">
            <h1 class="titulo">REFLEJOS</h1>   
        </div>            

        <?php include '../public/conbbdd.php'; ?>
       
        <form id="formulario-programa" method="post" action="agregarprograma.php">
        <h2 class="titulo-formulario">AÑADIR PROGRAMA</h2> 

            <?php
                //muestra mensaje de éxito o error
                if (isset($_GET['mensaje'])) {
                    $mensaje = $_GET['mensaje'];
                    echo '<div style="color: ' . ($mensaje === 'Programa agregado correctamente' ? 'green' : 'red') . ';">' . $mensaje . '<br></br></div>';
                }
            ?>
    
            <div style="display: flex; flex-direction: column;">
            <div style="display: flex; flex-direction: row; align-items: center;">
                <label for="distancia">Distancia:</label>
                <input type="number" min="0" id="distancia" name="distancia" required style="margin-left: auto;">
            </div>
            <div style="display: flex; flex-direction: row; align-items: center;">
                <label for="nciclos">Número de ciclos:</label>
                <input type="number" min="0" id="nciclos" name="nciclos" required style="margin-left: auto;">
            </div>
            <div style="display: flex; flex-direction: row; align-items: center;">
                <label for="tejercicio">Tiempo de ejercicio (en segundos):</label>
                <input type="number" min="0" id="tejercicio" name="tejercicio" required style="margin-left: auto;">
            </div>
            <div style="display: flex; flex-direction: row; align-items: center;">
                <label for="tdescanso">Tiempo de descanso (en segundos):</label>
                <input type="number" id="tdescanso" name="tdescanso" required style="margin-left: auto;">
            </div>
        </div>

        <?php
        //recupera las categorias, que son los tipo de programas
            $db = conectarBD();
            //obtiene colección de categorías
            $categoriasCollection = $db->collection('categorias');

            //obtiene una lista de los documentos  de categorías
            $documentRefs = $categoriasCollection->listDocuments();

            //empieza el select del tipo de programa
            echo '<label for="tipo">Tipo:</label>';
            echo '<select id="tipo" name="tipo">';
                echo '<option value="">Seleccione un tipo</option>';

                //recorre los documentos de la colección de categorías
                foreach ($documentRefs as $documentRef) 
                {
                    $snapshot = $documentRef->snapshot();
                    //obtiene los datos
                    $data = $snapshot->data();
                    //obtiene el id del documento
                    $nombreCategoria = $documentRef->id();        

                    echo '<option value="' . $nombreCategoria . '">' .key($data).'</option>';
                }
            
            echo '</select>';//cierra el select de entrenadores

        ?>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>


           <?php
            //recupera los entrenadores          
                //obtiene la colección de usuarios
                $usersCollection = $db->collection('users');
                //var_dump($usersCollection);

                //obtiene todos los documentos de users
                $documents = $usersCollection->documents();
                //var_dump($documents);
            
                //empieza el select de entrenadores
                echo '<label for="entrenador">Entrenador:</label>';
                echo '<select id="entrenador" name="entrenador">';
                    echo '<option value="">Seleccione entrenador</option>';

                    //recorre  los documentos de los usuarios
                    foreach ($documents as $userDoc) 
                    {
                        //obtiene los datos del documento
                        $userData = $userDoc->data();
                        //obtiene el correo electrónico del usuario
                        $email = $userData['email'];
                        //obtiene el UID del usuario
                        $uid = $userDoc->id();
                        //agrega opciónes con el email y el uid como valor
                        echo '<option value="' . $uid . '">' . $email .'</option>';
                    }
                
                echo '</select>';//cierra el select de entrenadores

            ?>          

            <button type="submit" class="agregarButton">Agregar</button>

        </form>

    </body>

</html>


















<?php



    // Crea el cliente de Firestore con las credenciales JSON
    /*$db = new FirestoreClient([
        'keyFilePath' => '../bbdd_key/key.json',
        'projectId' => 'reflejosdews', // Asegúrate de reemplazar 'reflejosdews' con tu ID de proyecto
        'region' => 'nam5', // Cambia 'us-central1' por la región que corresponde a 'nam5'
    ]);*/


    // Referencia a la colección "deportistas" en Cloud Firestore
    /*$deportistasRef = $db->collection('deportistas');

    //obtiene todos los documentos de la colección "deportistas"
    $deportistasDocs = $deportistasRef->documents();

    // Mostrar los datos de los deportistas
    foreach ($deportistasDocs as $doc) {
        //obtiene los datos del documento
        $deportistaData = $doc->data();
        
        // Mostrar los datos del deportista
        echo '<pre>';
        print_r($deportistaData);
        echo '</pre>';
    }

    // Cerrar la conexión a Cloud Firestore
    $firestore->close();*/







     // Referencia a la colección 'deportistas'
   /* $deportistasRef = $db->collection('deportistas');

    // Obtiene todos los documentos de la colección 'deportistas'
    $snapshot = $deportistasRef->documents();

    // Recorre cada documento y muestra su contenido
    foreach ($snapshot as $deportista) {
        //obtiene los datos del deportista
        $deportistaData = $deportista->data();

        // Mostrar los datos del deportista
        echo "Nombre: " . $deportistaData['nombre'] . PHP_EOL;
        echo "Apellido: " . $deportistaData['apellido1'] . " " . $deportistaData['apellido2'] . PHP_EOL;
        echo "Club: " . $deportistaData['club'] . PHP_EOL;
        echo "Deporte: " . $deportistaData['deporte'] . PHP_EOL;
        echo PHP_EOL;
    }*/
    ?>