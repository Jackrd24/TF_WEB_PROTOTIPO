<?php

include_once './Negocio.php';

$cod = $_REQUEST["id"];

if (isset($_REQUEST["id"])) {
    $obj = new Negocio();
    $obj->eliminarChofer($cod);
}

header("location:choferes_i.php");
?>

