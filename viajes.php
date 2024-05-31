<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../CSS/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Lista de Viajes por Ruta</title>
    </head>
    <body>
        <?php
        include_once './Negocio.php';
        $obj = new Negocio();
        $cod = $_REQUEST["id"];
        $noma = $_REQUEST["nom"];
        $vector = $obj->listadoViajes($cod);
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
        <h1>Lista de Viajes de <?= $noma ?></h1>
        <br>
        <img src='../FOTOS/turismo/<?= $noma ?>.jpg' width=300 height=300>
        <table>
            <thead>
                <tr>
                    <th>Código de Viaje</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Costo</th>
                    <th>Pasajeros</th>
                    <th>Boletos</th>
                </tr>
            </thead>
            <?php
            foreach ($vector as $key => $dato) {
                echo "<tr><td>$dato[0]</td><td>$dato[1]</td><td>$dato[2]</td><td>S/.$dato[3]</td>";
                ?>
                <td><a href="pasajeros.php?id=<?= $dato[0] ?>&costo=<?= $dato[3] ?>">Ver</a></td><td><a href="inicio_sesion.php">Comprar</a></td></tr>
                <?php
            }
            ?>
        </table>
    </center>
</body>
</html>
