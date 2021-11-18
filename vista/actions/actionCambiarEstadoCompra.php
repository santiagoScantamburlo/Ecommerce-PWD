<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$message = "Compra no encontrada";
$abmCompraEstado = new abmcompraestado();
$listaCE = $abmCompraEstado->buscar(['idcompraestado' => $datos['idcompraestado']]);
if (count($listaCE) > 0) {

    switch ($datos['idcompraestadotipo']) {
        case 1:
            $datos['idcompraestadotipo'] = 2;
            $message = "Compra aceptada";
            break;
        case 2:
            $datos['idcompraestadotipo'] = 3;
            $datos['cefechafin'] = date('Y-m-d H:i:s');
            $message = "Compra enviada";
            break;
    }
    $exito = $abmCompraEstado->modificacion($datos);
    if ($exito) {
        header('Location: ../deposito/administrarCompras.php?messageOk=' . urlencode($message));
        exit;
    } else {
        $message = "Error en la modificacion";
        header('Location: ../deposito/administrarCompras.php?messageErr=' . urlencode($message));
        exit;
    }
}

header('Location: ../deposito/administrarCompras.php?messageErr=' . urlencode($message));
exit;
