<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$message = "Compra no encontrada";
$abmCompraEstado = new abmcompraestado();
$listaCE = $abmCompraEstado->buscar(['idcompraestado' => $datos['idcompraestado']]);
if (count($listaCE) > 0) {
    $datos['cefechaini'] = $listaCE[0]->getCefechaini();
    $datos['idcompraestadotipo'] = 4;
    $datos['cefechafin'] = date('Y-m-d H:i:s');
    $exito = $abmCompraEstado->modificacion($datos);
    if ($exito) {
        $message = "Compra cancelada";
        header('Location: ../deposito/administrarCompras.php?messageOk=' . urlencode($message));
        exit;
    } else {
        $message = "Error en la cancelacion";
        header('Location: ../deposito/administrarCompras.php?messageErr=' . urlencode($message));
        exit;
    }
}

header('Location: ../deposito/administrarCompras.php?messageErr=' . urlencode($message));
exit;
