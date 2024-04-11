<?php include '../public/conbbdd.php'; ?>
       
    <?php
        include '../clases/Programa.php';
        use Google\Cloud\Core\Timestamp;
        
            $db = conectarBD();
            if ($db !== null)
            { 
                //comprueba si se ha enviado el formulario
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    //obtiene el id del programa a modificar
                    $programaId = $_POST['id'];

                    //obtiene los datos del formulario
                    $distancia = $_POST["distancia"];
                    $nciclos = $_POST["nciclos"];
                    $tejercicio = $_POST["tejercicio"];
                    $tdescanso = $_POST["tdescanso"];
                    $tipo = $_POST["tipo"];
                    $entrenador_uid = $_POST["entrenador"];
                    $descripcion = $_POST["descripcion"];


                    //crea un objeto Programa
                    $programa = new Programa($tipo, $distancia, $nciclos, $tejercicio, $tdescanso, $entrenador_uid, $descripcion);
                
                    //crea un nuevo documento
                    $datosModifPrograma = [
                        'distancia' => $programa->getDistancia(),
                        'nciclos' => $programa->getNCiclos(),
                        'tejercicio' => $programa->getTEjercicio(),
                        'tdescanso' => $programa->getTDescanso(),
                        'tipo' => "/categorias/".$programa->getTipo(),
                        'entrenador' => $db->document('users/' . $programa->getEntrenador()), 
                        'descripcion' => $programa->getDescripcion()
                    ];

                    //programa que se va a modificar
                    $programaRef = $db->collection('programas')->document($programaId);

                    //actualiza los datos
                    $programaRef->set($datosModifPrograma, ['merge' => true]);

                    // redirije con un mensaje de ok
                    header("Location: modificarprograma.php?id=$programaId&mensaje=Programa modificado correctamente");
                    exit;
                } else 
                {
                    header("Location: modificarprograma.php?id=$programaId&mensaje=Error al procesar el formulario");
                    exit;
                }

            } 
?>
