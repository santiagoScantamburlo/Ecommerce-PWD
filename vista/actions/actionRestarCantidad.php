<?php
include_once '../../configuracion.php';

$datos = data_submitted();
print_r($datos);
$abmCompraItem = new abmcompraitem();
$listaCI = $abmCompraItem->buscar(['idcompraitem' => $datos['idcompraitem']]);

$compraItem = $listaCI[0];

$cantidad = $compraItem->getCicantidad();
$idCompra = $compraItem->getObjCompra()->getIdcompra();
$idCompraItem = $compraItem->getIdcompraitem();
$idProducto = $compraItem->getObjProducto()->getIdproducto();

if ($cantidad == 1) {
    header('Location: ../cliente/carrito.php');
    exit;
} else {
    $cantidad--;
    $datosModificacion = [
        'idcompraitem' => $idCompraItem,
        'idcompra' => $idCompra,
        'idproducto' => $idProducto,
        'cicantidad' => $cantidad
    ];
    $abmCompraItem->modificacion($datosModificacion);
    header('Location: ../cliente/carrito.php');
    exit;
}
