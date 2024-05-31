<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../CSS/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Iniciar Sesión</title>
    </head>
    <body>
        <?php
        include_once './Negocio.php';
        $obj = new Negocio();
        ?>
        <div class="login-container">
            <center>
                <img src="../FOTOS/LOGO/logo.jpg" width="250" height="60" alt="Logo"/>
                <br><br>
                <h2>Iniciar Sesión</h2>
                <br>
                <form method="post">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" placeholder="Ingrese su usuario" required>

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>

                    <button type="submit" name="Enviar">Iniciar Sesión</button>
                </form>
                <br>
                <a href="index.php">Regresar a la Página Principal</a>
                <br><br>
                <?php
                if (isset($_REQUEST["error"])) {
                    $mensaje_error = $_REQUEST["error"];
                    echo "<p style='color: red'>$mensaje_error</p>";
                }
                if (isset($_REQUEST["Enviar"])) {
                    $obj->iniciarSesion($_REQUEST["username"], $_REQUEST["password"]);
                }
                ?>
            </center>
        </div>
    </body>
</html>
