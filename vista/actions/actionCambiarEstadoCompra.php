<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$enviada = false;
$message = "?messageErr=" . urlencode("Compra no encontrada");
$abmCompraEstado = new abmcompraestado();
$listaCE = $abmCompraEstado->buscar(['idcompraestado' => $datos['idcompraestado']]);
if (count($listaCE) > 0) {

    $controlCompra = new control_compra();
    $respuesta = $controlCompra->cambiarEstadoCompra($datos, $listaCE);

    if ($respuesta['messageErr'] != "") {
        $message = "?messageErr=" . urlencode($respuesta['messageErr']);
    } else {
        $message = "?messageOk=" . urlencode($respuesta['messageOk']);
    }
}

header('Location: ../deposito/administrarCompras.php?' . $message);
exit;
