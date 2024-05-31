<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../CSS/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Lista de Pasajeros</title>
    </head>
    <body>
        <?php
        include_once './Negocio.php';
        $obj = new Negocio();
        $cod = $_REQUEST["id"];
        $costo = $_REQUEST["costo"];
        $vector = $obj->listadoPasajeros($cod);
        ?>
        <nav>
            <div class="logo">
                <a href="index.php">
                    <img src="../FOTOS/LOGO/logo.jpg" alt="Logo"/>
                </a>
            </div>
            <ul class="menu">
                <li><a href="rutas.php">Rutas</a></li>
                <li><a href="choferes.php">Choferes</a></li>
                <li><a href="inicio_sesion.php">Iniciar Sesión</a></li>
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
                </tr>
            </thead>
            <?php
            foreach ($vector as $key => $dato) {
                echo "<tr><td>$dato[0]</td><td>$dato[1]</td><td>$dato[2]</td><td>S/.$dato[3]</td>";
            }
            ?>
        </table>
    </center>
</body>
</html>
