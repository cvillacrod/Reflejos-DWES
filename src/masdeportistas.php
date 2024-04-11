

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>REFLEJOS-AÑADIR DEPORTISTAS</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body class="fondo-home">
         
        <?php include '../public/menu.php'; ?>

        <div class="contenedor-titulo">
            <h1 class="titulo">REFLEJOS</h1>   
        </div>            
  
        <?php include '../public/conbbdd.php'; ?>
       

    <form id="formulario-deportista" method="post" action="agregardeportista.php">
        <h2 class="titulo-formulario">AÑADIR DEPORTISTA</h2> 

            <?php
                //muestra mensaje de ok o error
               if (isset($_GET['mensaje'])) {
                    $mensaje = $_GET['mensaje'];
                    echo '<div style="color: ' . ($mensaje === 'Deportista agregado correctamente' ? 'green' : 'red') . ';">' . $mensaje . '<br></br></div>';
                }
            ?>
    
            <label for="nombre" >Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Su nombre" required>
            
            <label for="apellido1">Apellido:</label>

            <input type="text" id="apellido1" placeholder="Primer apellido" name="apellido1" required style="display: inline-block; width: 45%; margin-right: 10px;">
            <input type="text" id="apellido2" placeholder="Segundo apellido" name="apellido2" required style="display: inline-block; width: 45%;">

            <label for="deporte">Deporte:</label>
            <input type="text" id="deporte" placeholder="¿Cuál practica?" name="deporte" required>
            
            <label for="club">Club:</label>
            <input type="text" id="club" name="club" placeholder="Club al que pertenece" required>
            
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            

            <?php
                $db = conectarBD();
                
                //obtiene la colección de usuarios de Firestore
                $usersCollection = $db->collection('users');
                //var_dump($usersCollection);

                //obtiene todos los documentos de la colección de usuarios
                $documents = $usersCollection->documents();
                //var_dump($documents);
            
                //empieza el select de entrenadores
                echo '<label for="entrenador">Entrenador:</label>';
                echo '<select id="entrenador" name="entrenador">';
                    echo '<option value="">Seleccione entrenador</option>';

                    //recorre sobre los documentos de la colección de usuarios
                    foreach ($documents as $userDoc) 
                    {
                        //obtiene los datos del documento
                        $userData = $userDoc->data();
                        //obtiene el correo electrónico del usuario
                        $email = $userData['email'];
                        //obtiene el UID del usuario
                        $uid = $userDoc->id();
                        //agrega opciónes al select con el email y el uid como valor
                        echo '<option value="' . $uid . '">' . $email .'</option>';
                    }
                
                echo '</select>'; //cierre el select de entrenadores
            ?>

            <button type="submit" class="agregarButton">Agregar</button>

        </form>

    </body>

</html>


