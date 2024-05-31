<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../CSS/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Página Principal</title>
    </head>
    <body>
        <?php
        include_once './Negocio.php';
        $obj = new Negocio();
        $cod = $_REQUEST["id"];
        $noma = $_REQUEST["nom"];
        $vector = $obj->listadoViajesChofer($cod);
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
        <h1>Viajes realizados por: <?= $noma ?></h1>
        <table class="table table-hover">
            <thead>
                <tr class="text-white bg-black">
                    <th>Código de Viaje</th>
                    <th>Ruta</th>
                    <th>Fecha</th>
                    <th>Costo</th>
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
