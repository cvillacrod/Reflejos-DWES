<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>REFLEJOS-MODIFICAR DEPORTISTA</title>
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
            include '../clases/Deportista.php';
            use Google\Cloud\Core\Timestamp;

            //establece la conexión a la base de datos
            $db = conectarBD();
            if ($db !== null)
            {             
                //obtiene el id del deportista a modificar de la URL
                if(isset($_GET['id'])) {
                    $deportistaId = $_GET['id'];

                    //consulta para obtener los datos del deportista con el id
                    $deportistaRef = $db->collection('deportistas')->document($deportistaId);
                    $deportistaDoc = $deportistaRef->snapshot();
                    $deportistaData = $deportistaDoc->data();

                    //guarda los datos del deportista buscado, para crear el objeto deportista
                    $nombre = $deportistaData['nombre'];
                    $apellido1 = $deportistaData['apellido1'];
                    $apellido2 = $deportistaData['apellido2'];
                    $deporte = $deportistaData['deporte'];
                    $club = $deportistaData['club'];
                    //convierte la fecha de nacimiento a un formato compatible con el input tipo date                    
                    $fecha_nacimiento=$deportistaData['fechanacimiento'];
                    $entrenador_uid = $deportistaData['entrenador']->id();
            //} se cierra bajo el php
          
                    //crea un objeto Deportista
                    $deportista = new Deportista($nombre, $apellido1, $apellido2, $fecha_nacimiento, $club, $deporte, $entrenador_uid);
                    
        ?>    

                    <form id="formulario-deportista" method="post" action="guardardeportista.php">
                        <h2 class="titulo-formulario">MODIFICAR DEPORTISTA</h2>

                            <?php
                                //mostrar mensaje de ok o error
                                if (isset($_GET['mensaje'])) {
                                    $mensaje = $_GET['mensaje'];
                                    echo '<div style="color: ' . ($mensaje === 'Deportista modificado correctamente' ? 'green' : 'red') . ';">' . $mensaje . '<br></br></div>';
                                }

                            ?>

                            <input type="hidden" name="id" value="<?php echo $deportistaId; ?>">

                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $deportista->getNombre();?>" required>

                            <label for="apellido1">Apellido:</label>
                            <input type="text" id="apellido1" placeholder="Primer apellido" name="apellido1" value="<?php echo $deportista->getApellido1(); ?>" required style="display: inline-block; width: 45%; margin-right: 10px;">
                            <input type="text" id="apellido2" placeholder="Segundo apellido" name="apellido2" value="<?php echo $deportista->getApellido2(); ?>" required style="display: inline-block; width: 45%;">

                            <label for="deporte">Deporte:</label>
                            <input type="text" id="deporte" placeholder="¿Cuál practica?" name="deporte" value="<?php echo $deportista->getDeporte(); ?>" required>

                            <label for="club">Club:</label>
                            <input type="text" id="club" name="club" placeholder="Club al que pertenece" value="<?php echo $deportista->getClub(); ?>" required>

                            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                            
                        
                            <?php   //convierte la fecha de nacimiento
                                $fecha_nacimiento=$deportista->getFechaNacimiento(); 
                                $fecha_nacimiento_timestamp =  $fecha_nacimiento->get()->getTimestamp();                                
                                $fecha_nacimiento = date('Y-m-d', $fecha_nacimiento_timestamp);
                            ?>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" required>

                            
                            <label for="entrenador">Entrenador:</label>
                        <select id="entrenador" name="entrenador">
                            <option value="">Seleccione entrenador</option>
                            <?php
                                $entrenador_uid=$deportista->getEntrenadorEmail();
                                //obtiene  la colección de usuarios
                                $usersCollection = $db->collection('users');
                                $documents = $usersCollection->documents();
                                //recorre sobre los documentos de la colección de usuarios
                                foreach ($documents as $userDoc) {
                                    $userData = $userDoc->data();
                                    $email = $userData['email'];
                                    $uid = $userDoc->id();
                                    //si el id coincide con el id del entrenador del deportista, se queda seleccionado
                                    $selected = ($entrenador_uid == $uid) ? 'selected' : '';
                                    echo '<option value="' . $uid . '" ' . $selected . '>' . $email .'</option>';
                                }
                            ?>
                        </select>

                        <div class="guardar-container">
                            <button type="submit" class="guardarButton" onclick="location.href=\'guardadeportista.php?id=' . $deportistaId . '\'">Guardar</button>         
                        </div>


                        </form>
                        <?php
                } else 
                {
                    echo "No se proporcionó el ID del deportista a modificar.";
                }

            }

?>


    </body>

</html>



