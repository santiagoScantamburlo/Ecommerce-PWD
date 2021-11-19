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
    $idCompraEstado = $listaCE[0]->getObjCompra()->getIdcompra();
    $abmCompraEstado->baja(['idcompraestado' => $idCompraEstado]);

    $abmCompra = new abmcompra();
    $abmCompra->baja(['idcompra' => $idCompra]);
}

header('Location: ../cliente/carrito.php');
exit;
