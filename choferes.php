<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../CSS/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Lista de Choferes</title>
    </head>
    <body>
        <?php
        include_once './Negocio.php';
        $obj = new Negocio();
        $vector = $obj->listadoChoferes();
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
        <h1>Lista de Choferes</h1>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Código de Chofer</th>
                    <th>Nombre</th>
                    <th>Fecha de Ingreso</th>
                    <th>Categoría</th>
                    <th>Foto</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <?php
            foreach ($vector as $key => $dato) {
                echo "<tr><td>$dato[0]</td><td>$dato[1]</td><td>$dato[2]</td><td>$dato[3]</td><td><img src='../FOTOS/Choferes/$dato[0].jpg' width=100 height=100></td>";
                ?>
                <td><a href="viajes_chofer.php?id=<?= $dato[0] ?>&nom=<?= $dato[1] ?>">Ver</a></td></tr>
                <?php
            }
            ?>
        </table>
    </center>
</body>
</html>
