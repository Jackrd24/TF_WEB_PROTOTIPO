<?php

include_once './Negocio.php';

$cod = $_REQUEST["id"];
$coda = $_REQUEST["coda"];
$noma = $_REQUEST["nom"];

if (isset($_REQUEST["id"])) {
    $obj = new Negocio();
    $obj->eliminarViaje($cod);
}

header("location:viajes_i.php?id=$coda&nom=$noma");
?>

