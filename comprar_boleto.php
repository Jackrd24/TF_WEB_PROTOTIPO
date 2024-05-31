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
        $coda = $_REQUEST["cod"];
        $noma = $_REQUEST["nom"];
        $vec = $obj->listadoPasajeros($cod);
        // Verificar si el formulario ha sido enviado
        if (isset($_REQUEST["Enviar"])) {
            // Obtener el asiento seleccionado
            $asiento = $_REQUEST["asiento"];

            // Validar que el asiento esté disponible
            $asientoDisponible = true;
            foreach ($vec as $dato) {
                if ($asiento == $dato[2]) {
                    $asientoDisponible = false;
                    break;
                }
            }

            // Si el asiento está disponible, se procede a registrar el pasajero
            if ($asientoDisponible) {
                $tipo = "";
                $pago = 0;
                if ($_REQUEST["tipo"] == "Niño") {
                    $tipo = "N";
                    $pago = $_REQUEST["pago"] * 0.5;
                } else if ($_REQUEST["tipo"] == "Estudiante") {
                    $tipo = "E";
                    $pago = $_REQUEST["pago"] * 0.7;
                } else if ($_REQUEST["tipo"] == "Adulto") {
                    $tipo = "A";
                    $pago = $_REQUEST["pago"];
                }

                $obj->registroPasajeros($cod, $nombre, $asiento, $tipo, $pago);
                header("location:viajes_i.php?id=$coda&nom=$noma");
                exit; // Importante para detener la ejecución del script después de la redirección
            } else {
                echo "<script>alert('El asiento seleccionado no está disponible.');</script>";
            }
        }
        ?>
    <center>
        <h1>COMPRA DE BOLETO</h1>
        <form method="post" id="formulario">
            <table>
                <tr>
                    <td>Asiento</td>
                    <td colspan="7">
                        <div class="bus-seats">
                            <?php
                            for ($index = 1; $index <= 40; $index++) {
                                $existe = false;
                                foreach ($vec as $dato) {
                                    if ($index == $dato[2]) {
                                        $existe = true;
                                        break;
                                    }
                                }
                                $estado = $existe ? 'ocupado' : 'disponible';
                                echo "<div class='seat $estado' data-asiento='$index'>$index</div>";
                            }
                            ?>
                        </div>
                        <input type="hidden" name="asiento" id="asiento" value="">
                    </td>
                </tr>
                <tr>
                    <td>Tipo de Pasajero</td>
                    <td>
                        <select name="tipo" required>
                            <option>Niño</option>
                            <option>Estudiante</option>
                            <option>Adulto</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Pago del viaje</td>
                    <td><input name="pago" required></td>
                </tr>
                <tr>
                    <td><input name="Enviar" value="Enviar" type="submit"></td>
                    <td><input name="Restablecer" value="Restablecer" type="button" onclick="limpiarFormulario()"></td>
                </tr>
            </table>
        </form>
    </center>
</body>
<script>
    function limpiarFormulario() {
        document.getElementById("formulario").reset();
    }

    // Capturar el clic en un asiento
    const seats = document.querySelectorAll('.seat.disponible');
    seats.forEach(seat => {
        seat.addEventListener('click', function () {
            // Deshabilitar otros asientos seleccionables
            seats.forEach(otherSeat => {
                if (otherSeat !== seat) {
                    otherSeat.classList.remove('selected');
                }
            });

            document.querySelector('#asiento').value = this.textContent;
            this.classList.toggle('selected');
        });
    });
</script>
</html>
