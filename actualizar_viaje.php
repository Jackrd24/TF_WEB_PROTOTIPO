<html>
    <head>
        <meta charset="UTF-8">
        <link href="../CSS/estilos.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <?php
        session_start();

        // Verificar si el usuario hizo clic en "Cerrar Sesión"
        if (isset($_GET["logout"])) {
            // Destruir la sesión y borrar todos los datos de $_SESSION
            session_destroy();

            // Redirigir al usuario a la página principal.php
            header("Location: principal.php");
            exit; // Asegurarse de que el script se detenga después de redirigir
        }

        $nombre = isset($_SESSION["user_nombre"]) ? $_SESSION["user_nombre"] : "Invitado";
        include_once './Negocio.php';
        $obj = new Negocio();
        $cod = $_REQUEST["id"];
        $coda = $_REQUEST["coda"];
        $noma = $_REQUEST["nom"];
        $vec1 = $obj->listadoBus();
        $vec2 = $obj->listadoRutas();
        $vec3 = $obj->listadoChoferes();
        ?>
        <nav>
            <div class="logo">
                <a href="principal_i.php">
                    <img src="../FOTOS/LOGO/logo.jpg" alt="Logo"/>
                </a>
            </div>
            <p style="color: white; font-size: 30px">Bienvenido, <?= $nombre ?></p>
            <ul class="menu">
                <li><a href="rutas_i.php">Rutas</a></li>
                <li><a href="choferes_i.php">Choferes</a></li>
                <li><a href="inicio_sesion.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    <center>
        <br>
        <h1>ACTUALIZAR VIAJE: <?= $coda ?></h1>
        <form method="post" id="formulario">
            <table>
                <tr>
                    <td>Bus</td>
                    <td>
                        <select name="bus" required>
                            <?php
                            foreach ($vec1 as $key => $dato) {
                                echo "<option>$dato[0]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ruta</td>
                    <td>
                        <select name="ruta" required>
                            <?php
                            foreach ($vec2 as $key => $dato) {
                                echo "<option>$dato[0]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Chofer</td>
                    <td>
                        <select name="chofer" required>
                            <?php
                            foreach ($vec3 as $key => $dato) {
                                echo "<option>$dato[0]</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td><input type="date" name="fecha" required></td>
                </tr>
                <tr>
                    <td>Hora</td>
                    <td><input type="time" name="hora" required></td>
                </tr>
                <tr>
                    <td>Costo</td>
                    <td><input type="text" name="costo" required></td>
                </tr>
                <tr>
                    <td><input name="Enviar" value="Enviar" type="submit"></td>
                    <td><input name="Restablecer" value="Restablecer" type="button" onclick="limpiarFormulario()"></td>
                </tr>
            </table>
        </form>
    </center>
    <?php
    if (isset($_REQUEST["Enviar"])) {
        $obj->actualizarViaje($cod, $_REQUEST["bus"], $_REQUEST["ruta"], $_REQUEST["chofer"], $_REQUEST["hora"], $_REQUEST["fecha"], $_REQUEST["costo"]);
        header("location:viajes_i.php?id=$coda&nom=$noma");
    }
    ?>
</body>
</html>
