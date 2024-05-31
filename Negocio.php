<?php

include_once './Conexion.php';

class Negocio {

    public function listadoRutas() {
        $obj = new Conexion();
        $sql = "SELECT RUTCOD, RUTNOM FROM ruta";
        $result = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $vector = array();

        while ($f = mysqli_fetch_array($result)) {
            $vector[] = $f;
        }

        return $vector;
    }

    public function listadoViajes($id) {
        $obj = new Conexion();
        $sql = "SELECT VIANRO, VIAFCH, VIAHRS, COSVIA FROM viaje WHERE RUTCOD='$id'";
        $result = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $vector = array();

        while ($f = mysqli_fetch_array($result)) {
            $vector[] = $f;
        }

        return $vector;
    }

    public function listadoBus() {
        $obj = new Conexion();
        $sql = "SELECT BUSNRO FROM bus";
        $result = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $vector = array();

        while ($f = mysqli_fetch_array($result)) {
            $vector[] = $f;
        }

        return $vector;
    }

    public function listadoPasajeros($id) {
        $obj = new Conexion();
        $sql = "SELECT BOLNRO, Nom_pas, Nro_asi, pago FROM pasajeros WHERE VIANRO='$id'";
        $result = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $vector = array();

        while ($f = mysqli_fetch_array($result)) {
            $vector[] = $f;
        }

        return $vector;
    }

    public function listadoChoferes() {
        $obj = new Conexion();
        $sql = "SELECT IDCOD, CHONOM, CHOFIN, CHOCAT FROM chofer";
        $result = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $vector = array();

        while ($f = mysqli_fetch_array($result)) {
            $vector[] = $f;
        }

        return $vector;
    }

    public function listadoViajesChofer($id) {
        $obj = new Conexion();
        $sql = "SELECT VIANRO, RUTNOM, VIAFCH, COSVIA FROM viaje v JOIN ruta r ON v.RUTCOD=r.RUTCOD WHERE IDCOD='$id'";
        $result = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $vector = array();

        while ($f = mysqli_fetch_array($result)) {
            $vector[] = $f;
        }

        return $vector;
    }

    public function registroPasajeros($id, $nombre, $asiento, $tipo, $pago) {
        $obj = new Conexion();
        $ultimo_boleto = $this->obtenerUltimoBoleto();
        $siguiente_boleto = str_pad($ultimo_boleto + 1, 6, '0', STR_PAD_LEFT);
        $sql = "INSERT INTO pasajeros VALUES('$siguiente_boleto', '$id', '$nombre', $asiento, '$tipo', $pago)";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
    }

    public function obtenerUltimoBoleto() {
        $obj = new Conexion();
        $sql = "SELECT MAX(BOLNRO) AS ultimo_boleto FROM pasajeros";
        $res = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $row = mysqli_fetch_assoc($res);

        return $row['ultimo_boleto'];
    }

    public function eliminarPasajeros($id) {
        $obj = new Conexion();
        $sql = "DELETE FROM pasajeros WHERE BOLNRO='$id'";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
    }

    public function iniciarSesion($correo, $telefono) {
        $obj = new Conexion();
        $sql = "SELECT * FROM usuario WHERE CORREO='$correo' AND TELEFONO='$telefono'";
        $res = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        if (mysqli_num_rows($res) == 1) {
            session_start();
            $vec = mysqli_fetch_assoc($res);

            $_SESSION["user_id"] = $vec["CODE"];
            $_SESSION["user_nombre"] = $vec["NOMBRE"];
            $_SESSION["user_correo"] = $vec["CORREO"];
            $_SESSION["user_telefono"] = $vec["TELEFONO"];
            $_SESSION["user_pais"] = $vec["pais"];

            header("Location: principal_i.php");
        } else {
            $mensaje_error = "Usuario o contraseña incorrectos";

            header("Location: inicio_sesion.php?error=$mensaje_error");
        }
    }

    public function registroRuta($id, $nombre, $pago) {
        $obj = new Conexion();
        $sql = "INSERT INTO ruta VALUES('$id', '$nombre', $pago)";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
    }

    public function actualizarRuta($id, $nombre, $pago) {
        $obj = new Conexion();
        $sql = "UPDATE ruta SET RUTNOM='$nombre', pago_cho=$pago WHERE RUTCOD='$id'";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
    }

    public function eliminarRuta($id) {
        $obj = new Conexion();

        // Obtener el nombre de la imagen asociada a la ruta que se eliminará
        $sql = "SELECT RUTNOM FROM ruta WHERE RUTCOD='$id'";
        $result = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $row = mysqli_fetch_assoc($result);
        $nombre_imagen = $row['nombre_imagen'];

        // Eliminar el registro de la base de datos correspondiente a la ruta
        $sql = "DELETE FROM ruta WHERE RUTCOD='$id'";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));

        // Eliminar la imagen de la carpeta "../FOTOS/turismo"
        if ($nombre_imagen) {
            $ruta_imagen = "../FOTOS/turismo/" . $nombre_imagen;
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
        }
    }

    public function registroViaje($bus, $ruta, $chofer, $hora, $fecha, $costo) {
        $obj = new Conexion();
        $ultimo_viaje = $this->obtenerUltimoViaje();
        $siguiente_viaje = str_pad($ultimo_viaje + 1, 6, '0', STR_PAD_LEFT);
        $sql = "INSERT INTO viaje VALUES('$siguiente_viaje', $bus, '$ruta', '$chofer', '$hora', '$fecha', $costo)";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
    }

    public function actualizarViaje($id, $bus, $ruta, $chofer, $hora, $fecha, $costo) {
        $obj = new Conexion();
        $sql = "UPDATE viaje SET BUSNRO='$bus', RUTCOD='$ruta', IDCOD='$chofer', VIAHRS='$hora', VIAFCH='$fecha', COSVIA='$costo' WHERE VIANRO='$id'";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
    }

    public function eliminarViaje($id) {
        $obj = new Conexion();
        $sql = "DELETE FROM viaje WHERE VIANRO='$id'";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
    }

    public function obtenerUltimoViaje() {
        $obj = new Conexion();
        $sql = "SELECT MAX(VIANRO) AS ultimo_viaje FROM viaje";
        $res = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $row = mysqli_fetch_assoc($res);

        return $row['ultimo_viaje'];
    }

    public function registroChofer($nombre, $fecha, $categoria, $sba) {
        $obj = new Conexion();
        $ultimo_chofer = $this->obtenerUltimoChofer();
        $numero_chofer = (int) substr($ultimo_chofer, 1);
        $siguiente_numero_chofer = $numero_chofer + 1; // Incrementar el número de chofer
        $siguiente_chofer = "C" . str_pad($siguiente_numero_chofer, 3, '0', STR_PAD_LEFT); // Formar el nuevo código
        $sql = "INSERT INTO chofer VALUES('$siguiente_chofer', '$nombre', '$fecha', '$categoria', $sba)";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
    }

    public function actualizarChofer($id, $nombre, $fecha, $categoria, $sba) {
        $obj = new Conexion();
        $sql = "UPDATE chofer SET CHONOM='$nombre', CHOFIN='$fecha', CHOCAT='$categoria', CHOSBA=$sba WHERE IDCOD='$id'";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
    }

    public function eliminarChofer($id) {
        $obj = new Conexion();

        // Obtener el nombre de la imagen asociada al chofer que se eliminará
        $sql = "SELECT IDCOD FROM chofer WHERE IDCOD='$id'";
        $result = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $row = mysqli_fetch_assoc($result);
        $nombre_imagen = $row['imagen_chofer'];

        // Eliminar el registro de la base de datos correspondiente al chofer
        $sql = "DELETE FROM chofer WHERE IDCOD='$id'";
        mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));

        // Eliminar la imagen de la carpeta "../FOTOS/Choferes"
        if ($nombre_imagen) {
            $ruta_imagen = "../FOTOS/Choferes/" . $nombre_imagen;
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
        }
    }

    public function obtenerUltimoChofer() {
        $obj = new Conexion();
        $sql = "SELECT MAX(IDCOD) AS ultimo_chofer FROM chofer";
        $res = mysqli_query($obj->conecta(), $sql) or die(mysqli_error($obj->conecta()));
        $row = mysqli_fetch_assoc($res);

        return strval($row['ultimo_chofer']);
    }

}
