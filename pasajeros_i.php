<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../CSS/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Lista de Pasajeros</title>
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
        $costo = $_REQUEST["costo"];
        $vector = $obj->listadoPasajeros($cod);
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
        <h1>Lista de Pasajeros del Viaje Nro: <?= $cod ?></h1>
        <table>
            <thead>
                <tr>
                    <th>Boleto</th>
                    <th>Nombre</th>
                    <th>Asiento</th>
                    <th>Pago</th>
                    <th>Herramientas</th>
                </tr>
            </thead>
            <?php
            foreach ($vector as $key => $dato) {
                echo "<tr><td>$dato[0]</td><td>$dato[1]</td><td>$dato[2]</td><td>S/.$dato[3]</td>";
                ?>
                <td>
                    <button class="btn btn-amarillo">Actualizar</button>
                    <button class="btn btn-rojo">Eliminar</button>
                </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </center>
</body>
</html>
