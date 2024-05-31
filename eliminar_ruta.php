<?php

include_once './Negocio.php';

$cod = $_REQUEST["id"];

if (isset($_REQUEST["id"])) {
    $obj = new Negocio();
    $obj->eliminarRuta($cod);
}

header("location:rutas_i.php");
?>

