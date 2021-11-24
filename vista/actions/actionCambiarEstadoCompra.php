<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$enviada = false;
$message = "Compra no encontrada";
$abmCompraEstado = new abmcompraestado();
$listaCE = $abmCompraEstado->buscar(['idcompraestado' => $datos['idcompraestado']]);
if (count($listaCE) > 0) {

    switch ($datos['idcompraestadotipo']) {
        case 1:
            $datos['idcompraestadotipo'] = 2;
            $datos['cefechafin'] = date('Y-m-d H:i:s');
            $message = "Compra aceptada";
            break;
        case 2:
            $datos['idcompraestadotipo'] = 3;
            $enviada = true;
            $message = "Compra enviada";
            break;
    }

    $exito = $abmCompraEstado->modificacion($datos);

    if ($exito) {
        if ($enviada) {
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
        }
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
