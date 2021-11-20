<?php
include_once '../../configuracion.php';

$sesion = new session();
$datos = data_submitted();

$abmCompraEstado = new abmcompraestado();
$listaCE = $abmCompraEstado->buscar(['idcompra' => $datos['idcompra']]);

$datos['idcompraestado'] = $listaCE[0]->getIdcompraestado();
$datos['idcompraestadotipo'] = 2;

$abmCompraEstado->modificacion($datos);

$abmCompraItem = new abmcompraitem();
$listaCI = $abmCompraItem->buscar(['idcompra' => $datos['idcompra']]);

foreach ($listaCI as $item) {
    $objProducto = $item->getObjProducto();
    $idProducto = $objProducto->getIdproducto();
    $cantidad = $item->getCicantidad();
    $cantidadStock = $objProducto->getProcantstock();
    $cantidadVentas = $objProducto->getProcantventas();
    $precio = $objProducto->getProprecio();
    $descuento = $objProducto->getProdescuento();
    $nombre = $objProducto->getPronombre();
    $detalle = $objProducto->getProdetalle();

    $abmProducto = new abmproducto();
    $datosModificacion = [
        'idproducto' => $idProducto,
        'procantventas' => ($cantidadVentas + $cantidad),
        'procantstock' => ($cantidadStock - $cantidad),
        'pronombre' => $nombre,
        'prodetalle' => $detalle,
        'prodescuento' => $descuento,
        'proprecio' => $precio
    ];
    $abmProducto->modificacion($datosModificacion);
}
header('Location: ../home/index.php?messageOk=' . urlencode("Compra aceptada"));
exit;
