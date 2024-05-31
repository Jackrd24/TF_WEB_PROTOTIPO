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
        <h1>ACTUALIZAR CHOFER: <?= $cod ?></h1>
        <form method="post" id="formulario" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nombre de Chofer</td>
                    <td><input name="nombre" required></td>
                </tr>
                <tr>
                    <td>Fecha de Ingreso</td>
                    <td><input type="date" name="fecha" required></td>
                </tr>
                <tr>
                    <td>Categoría de Chofer</td>
                    <td>
                        <select name="categoria">
                            <option>F</option>
                            <option>C</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Pago de Chofer</td>
                    <td><input name="sba" required></td>
                </tr>
                <tr>
                    <td>Imagen de Chofer</td>
                    <td><input type="file" name="imagen" accept=".jpg" required></td>
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
        $nombre = $_REQUEST["nombre"];
        $pago = $_REQUEST["sba"];

        // Procesar la imagen
        $nombreImagen = $_FILES["imagen"]["name"];
        $rutaTemporal = $_FILES["imagen"]["tmp_name"];
        $extension = pathinfo($nombreImagen, PATHINFO_EXTENSION);
        $nombreImagenGuardada = $cod . "." . $extension;
        $directorioDestino = "../FOTOS/Choferes/"; // Directorio donde se guardarán las imágenes

        if (move_uploaded_file($rutaTemporal, $directorioDestino . $nombreImagenGuardada)) {
            // La imagen se ha guardado correctamente
            $obj->actualizarChofer($cod, $nombre, $_REQUEST["fecha"], $_REQUEST["categoria"], $pago);
            header("location:choferes_i.php");
        } else {
            // Hubo un error al guardar la imagen
            echo "<script>alert('Error al subir la imagen.');</script>";
        }
    }
    ?>
</body>
</html>
