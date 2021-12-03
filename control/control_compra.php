<?php
include_once '../configuracion.php';
class control_compra
{
    public function cambiarEstadoCompra($datos, $listaCE)
    {
        $retorno = ['messageOk' => "", 'messageErr' => ""];
        $abmCompraEstado = new abmcompraestado();
        switch ($datos['idcompraestadotipo']) {
            case 1:
                $datos['idcompraestadotipo'] = 2;
                $datos['cefechafin'] = date('Y-m-d H:i:s');
                $aceptada = true;
                $message = "Compra aceptada";
                break;
            case 2:
                $datos['idcompraestadotipo'] = 3;
                $message = "Compra enviada";
                $datos['cefechafin'] = $listaCE[0]->getCefechafin();
                $datos['cefechaini'] = $listaCE[0]->getCefechaini();
                break;
        }

        $exito = $abmCompraEstado->modificacion($datos);

        if ($exito) {
            if ($aceptada) {
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
            $retorno['messageOk'] = $message;
            // header('Location: ../deposito/administrarCompras.php?messageOk=' . urlencode($message));
            // exit;
        } else {
            $message = "Error en la modificacion";
            $retorno['messageErr'] = $message;
        }
        return $retorno;
    }

    //FUNCION UTILIZADA PARA ACEPTAR UNA COMPRA
    public function aceptarCompra($datos)
    {
        $retorno = [];
        $abmCompraEstado = new abmcompraestado();
        $listaCE = $abmCompraEstado->buscar(['idcompra' => $datos['idcompra']]);

        $datos['idcompraestado'] = $listaCE[0]->getIdcompraestado();
        $datos['cefechaini'] = $listaCE[0]->getCefechaini();
        $datos['idcompraestadotipo'] = 2;
        $datos['cefechafin'] = date('Y-m-d H:i:s');

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

        $retorno['messageOk'] = "?messageOk=" . urlencode("Compra aceptada");
        return $retorno;
    }
}
