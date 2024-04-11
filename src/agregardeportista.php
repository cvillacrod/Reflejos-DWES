<?php include '../public/conbbdd.php'; ?>
<?php
    include '../clases/Deportista.php';
    use Google\Cloud\Core\Timestamp;

    $db = conectarBD();
    if ($db !== null)
    {       
        //comprueba si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            // Obtener los datos del formulario
            $nombre = $_POST["nombre"];
            $apellido1 = $_POST["apellido1"];
            $apellido2 = $_POST["apellido2"];
            $deporte = $_POST["deporte"];
            $club = $_POST["club"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            //convierte la fecha de nacimiento a un objeto DateTime
            $fecha_nacimiento_datetime = new DateTime($fecha_nacimiento);
            $timestamp = new \Google\Cloud\Core\Timestamp($fecha_nacimiento_datetime);
            $entrenador_uid = $_POST["entrenador"];

            //crea un objeto Deportista
            $deportista = new Deportista($nombre, $apellido1, $apellido2, $fecha_nacimiento, $club, $deporte, $entrenador_uid);
        
            //crea el array de datos del deportista
            $nuevoDeportista = [
                'nombre' => $deportista->getNombre(),
                'apellido1' => $deportista->getApellido1(),
                'apellido2' => $deportista->getApellido2(),
                'deporte' => $deportista->getDeporte(),
                'club' => $deportista->getClub(),
                'fechanacimiento' => $timestamp,
                'entrenador' => $db->document('users/' . $deportista->getEntrenadorEmail())
            ];

            //añade el nuevo deportista a  'deportistas'
            $db->collection('deportistas')->add($nuevoDeportista);

            //redirije con un mensaje de éxito
            header("Location: masdeportistas.php?mensaje=Deportista agregado correctamente");
            exit;
        } else {
            header("Location: masdeportistas.php?mensaje=Error al procesar el formulario");
            exit;
        }

    }


?>
