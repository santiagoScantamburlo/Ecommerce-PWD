<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$abmCompraItem = new abmcompraitem();
$listaCI = $abmCompraItem->buscar(['idcompraitem' => $datos['idcompraitem']]);

$idCompra = $listaCI[0]->getObjCompra()->getIdcompra();

$abmCompraItem->baja(['idcompraitem' => $datos['idcompraitem']]);

$listaCI = $abmCompraItem->buscar(['idcompra' => $idCompra, 'idcompraitem' => $datos['idcompraitem']]);

if (count($listaCI) == 0) {
    $abmCompraEstado = new abmcompraestado();
    $listaCE = $abmCompraEstado->buscar(['idcompra' => $idCompra]);
    $ceFechaIni = $listaCE[0]->getCefechaini();
    $idCompraEstado = $listaCE[0]->getIdcompraestado();
    $ceFechaFin = date('Y-m-d H:i:s');
    $abmCompraEstado->modificacion(['idcompra' => $idCompra, 'idcompraestado' => $idCompraEstado, 'idcompraestadotipo' => 4, 'cefechaini' => $ceFechaIni, 'cefechafin' => $ceFechaFin]);
}

header('Location: ../cliente/carrito.php');
exit;
