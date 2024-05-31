<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../CSS/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Lista de Viajes por Ruta</title>
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
        $noma = $_REQUEST["nom"];
        $vector = $obj->listadoViajes($cod);
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
        <h1>Lista de Viajes de <?= $noma ?></h1>
        <br>
        <img src='../FOTOS/turismo/<?= $noma ?>.jpg' width=300 height=300>
        <br><br>
        <a href="agregar_viaje.php?id=<?= $cod ?>&nom=<?= $noma ?>"><button class="btn btn-verde">Agregar</button></a>
        <table>
            <thead>
                <tr>
                    <th>Código de Viaje</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Costo</th>
                    <th>Pasajeros</th>
                    <th>Boletos</th>
                    <th>Herramientas</th>
                </tr>
            </thead>
            <?php
            foreach ($vector as $key => $dato) {
                echo "<tr><td>$dato[0]</td><td>$dato[1]</td><td>$dato[2]</td><td>S/.$dato[3]</td>";
                ?>
                <td><a href="pasajeros_i.php?id=<?= $dato[0] ?>&costo=<?= $dato[3] ?>">Ver</a></td><td><a href="comprar_boleto.php?id=<?= $dato[0] ?>&nom=<?= $noma ?>&cod=<?= $cod ?>">Comprar</a></td>
                <td>
                    <a href="actualizar_viaje.php?id=<?= $dato[0] ?>&nom=<?= $noma ?>&coda=<?= $cod ?>"><button class="btn btn-amarillo">Actualizar</button></a>
                    <a href="eliminar_viaje.php?id=<?= $dato[0] ?>&nom=<?= $noma ?>&coda=<?= $cod ?>"><button class="btn btn-rojo">Eliminar</button></a>
                </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </center>
</body>
</html>
