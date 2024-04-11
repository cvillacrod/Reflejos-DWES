<?php include '../public/conbbdd.php'; ?>
       
<?php
    include '../clases/Programa.php';
    use Google\Cloud\Core\Timestamp;

    $db = conectarBD();
    if ($db !== null)
    { 

        //comprueba si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //obtiene los datos del formulario
            $distancia = $_POST['distancia'];
            $nciclos = $_POST['nciclos'];
            $tejercicio = $_POST['tejercicio'];
            $tipo = $_POST['tipo'];
            $tdescanso = $_POST['tdescanso'];
            $descripcion = $_POST['descripcion'];
            $entrenador =$_POST["entrenador"];  
            
            //crea un  objeto Programa
            $programa = new Programa($tipo, $distancia, $nciclos, $tejercicio, $tdescanso, $entrenador, $descripcion);

            //crea un array con los datos del programa a agregar
            $nuevoPrograma = [
                "distancia" => $programa->getDistancia(),
                "nciclos" => $programa->getNCiclos(),
                "tejercicio" => $programa->getTEjercicio(),
                "tipo" => '/categorias/' . $programa->getTipo(), //añadimos esa cadena para añadirlo correctamente a la bbdd
                "tdescanso" => $programa->getTDescanso(),
                "descripcion" => $programa->getDescripcion(),
                "entrenador" => $db->document('users/' . $programa->getEntrenador()) //uid del entrenador 
            ];
                    
            //añade el nuevo programa a la colección 'programas'
            $db->collection('programas')->add($nuevoPrograma);

            //redirije con un mensaje ok
            header("Location: masprogramas.php?mensaje=Programa agregado correctamente");
            exit();
            
        } else {
            header("Location: masprogramas.php?mensaje=Error al procesar el formulario");
            exit();
        }
    } 
?>

