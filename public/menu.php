 <div class="barra-navegacion">
    <div class="barra-navegacion-container">
        <nav >

                <ul class="opc-barra-navegacion">                 
                        <li>
                            <a href="main.php">Inicio</a>
                        </li>
                        <li>
                            <a href="deportistas.php">Deportistas</a>
                            <!-- Submenu para "Deportistas" -->
                            <div class="submenu">
                                <a href="deportistas.php">Ver Deportistas</a>
                                <a href="masdeportistas.php">Añadir Deportista</a>
                            </div>
                        </li>
                        <li>
                            <a href="programas.php">Programas</a>
                            <!-- Submenu para "Programas" -->
                            <div class="submenu">
                                <a href="programas.php">Ver Programas</a>
                                <a href="masprogramas.php">Añadir Programas</a>
                            </div>
                        </li>            
                </ul>

        </nav>
        </div>
        <div class="cierrsesion">
            <?php
                session_start();
                //verifica si el usuario está autenticado (si la variable de sesión email está definida)
                if (isset($_SESSION["email"])) {
                    $email = $_SESSION["email"];
                    echo '<a href="index.php">Cerrar sesión</a>';               
                    echo '<img src="../imagenes/usuario_blanco.png" alt="' . $email . '" title="' . $email . '" >';
                } else {
                    header("Location: index.php");
                    exit(); 
                }
            ?>
        </div>
</div>
