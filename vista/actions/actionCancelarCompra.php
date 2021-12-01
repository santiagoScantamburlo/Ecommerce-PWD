<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$message = "messageErr=" . urlencode("Compra no encontrada");
$abmCompraEstado = new abmcompraestado();
$listaCE = $abmCompraEstado->buscar(['idcompraestado' => $datos['idcompraestado']]);
if (count($listaCE) > 0) {
    $controlDeposito = new control_deposito();
    $respuesta = $controlDeposito->cancelarCompra($datos, $listaCE);

    if ($respuesta['messageErr'] != "") {
        $message = $respuesta['messageErr'];
    } else {
        $message = $respuesta['messageOk'];
    }
}

header('Location: ../deposito/administrarCompras.php?' . $message);
exit;
