<?php
include_once '../../configuracion.php';

class control_carrito_cliente
{
    private $retorno;

    public function __construct()
    {
        $this->retorno = ['messageErr' => "?messageErr=", 'messageOk' => "?messageOk="];
    }

    public function getRetorno()
    {
        return $this->retorno;
    }


    public function verificarCarrito($idusuario)
    {
        $abmCompra = new abmcompra();
        //Busco todas las compras realizadas por el usuario
        $listaCompras = $abmCompra->buscar(['idusuario' => $idusuario]);

        //Seteo la compra de retorno en null
        $compraRetorno = null;
        if (count($listaCompras) > 0) { //Veo si el usuario tiene alguna compra hecha
            $compra = $listaCompras[count($listaCompras) - 1]; //Tomo la ultima compra, asumiendo que puede estar iniciada como minimo
            $abmCompraEstado = new abmcompraestado();
            $listaCompraEstado = $abmCompraEstado->buscar(['idcompra' => $compra->getIdcompra()]); //Busco la compra con el ultimo ID
            if (count($listaCompraEstado) > 0) { //Veo si existe
                if ($listaCompraEstado[0]->getObjCompraEstadoTipo()->getIdcompraestadotipo() == 1) { //Veo si el tipo de compraestado que tiene es "iniciada"
                    $compraRetorno = $compra; //Asigno la compra encontrada a la compra que se va a retornar
                }
            }
        }
        return $compraRetorno; //Retorno, y en caso de no haber encontrado ninguna compra, retorna null
    }

    public function cargarItemCarrito($datos, $idUsuario)
    {
        $retorno = $this->getRetorno();
        $compra = $this->verificarCarrito($idUsuario);
        if (is_null($compra)) { //En caso de que no haya encontrado una compra valida
            $abmCompra = new abmcompra();
            $altaCompra = $abmCompra->alta(['idusuario' => $idUsuario]); //Doy de alta una nueva compra con el usuario actual

            if ($altaCompra) {
                //Si se dio de alta la compra, busco todas las compras del usuario y tomo la ultima que es la recien creada
                $listaCompra = $abmCompra->buscar(['idusuario' => $idUsuario]);
                $compra = $listaCompra[count($listaCompra) - 1];

                //Agrego a la tabla compraestado la nueva compra con su estado "iniciada"
                $abmCompraEstado = new abmcompraestado();
                $altaCompraEstado = $abmCompraEstado->alta(['idcompra' => $compra->getIdcompra(), 'cefechaini' => date('Y-m-d H:i:s'), 'idcompraestadotipo' => 1]);
                if ($altaCompraEstado) {
                    //Agrego a la tabla compraitem la nueva compra con el producto seleccionado
                    $abmCompraItem = new abmcompraitem();

                    $altaCompraItem = $abmCompraItem->alta(['idcompra' => $compra->getIdcompra(), 'idproducto' => $datos['idproducto'], 'cicantidad' => 1]);
                    if ($altaCompraItem) {
                        $retorno['messageOk'] .= urlencode("Producto agregado al carrito");
                    } else {
                        $retorno['messageErr'] .= urlencode("Error al agregar el producto");
                    }
                } else {
                    $retorno['messageErr'] .= urlencode("Error al agregar el producto");
                }
            } else {
                //En caso de retornar una compra abierta, crea una nueva compraitem para el nuevo producto seleccionado
                $abmCompraItem = new abmcompraitem();
                $datosBusqueda['idcompra'] = $compra->getIdcompra();
                $datosBusqueda['idproducto'] = $datos['idproducto'];
                $listaCI = $abmCompraItem->buscar($datosBusqueda);

                if (count($listaCI) == 0) {
                    $altaCompraItem = $abmCompraItem->alta(['idcompra' => $compra->getIdcompra(), 'idproducto' => $datos['idproducto'], 'cicantidad' => 1]);
                    if ($altaCompraItem) {
                        $retorno['messageOk'] .= urlencode("Producto agregado al carrito");
                    } else {
                        $retorno['messageErr'] .= urlencode("Error al agregar el producto");
                    }
                } else {
                    $abmProducto = new abmproducto();
                    $listaProducto = $abmProducto->buscar(['idproducto' => $datos['idproducto']]);
                    $cantidad = $listaCI[0]->getCicantidad() + 1;
                    if ($listaProducto[0]->getProcantstock() >= $cantidad) {
                        $abmCompraItem->modificacion(['idcompraitem' => $listaCI[0]->getIdcompraitem(), 'idcompra' => $compra->getIdcompra(), 'idproducto' => $datos['idproducto'], 'cicantidad' => $cantidad]);
                        $retorno['messageOk'] .= urlencode("Producto agregado al carrito");
                    } else {
                        $retorno['messageErr'] .= urlencode("No hay más stock del producto");
                    }
                }
            }
        }
        return $retorno;
    }

    public function eliminarDelCarrito($datos)
    {
        $retorno = $this->getRetorno();
        $abmCompraItem = new abmcompraitem();
        $listaCI = $abmCompraItem->buscar(['idcompraitem' => $datos['idcompraitem']]);

        $idCompra = $listaCI[0]->getObjCompra()->getIdcompra();

        $abmCompraItem->baja(['idcompraitem' => $datos['idcompraitem']]);

        $listaCI = $abmCompraItem->buscar(['idcompra' => $idCompra]);

        if (count($listaCI) == 0) {
            $abmCompraEstado = new abmcompraestado();
            $listaCE = $abmCompraEstado->buscar(['idcompra' => $idCompra]);
            $ceFechaIni = $listaCE[0]->getCefechaini();
            $idCompraEstado = $listaCE[0]->getIdcompraestado();
            $ceFechaFin = date('Y-m-d H:i:s');
            $exito = $abmCompraEstado->modificacion(['idcompra' => $idCompra, 'idcompraestado' => $idCompraEstado, 'idcompraestadotipo' => 4, 'cefechaini' => $ceFechaIni, 'cefechafin' => $ceFechaFin]);
            if ($exito) {
                $retorno['messageOk'] .= urlencode("Producto eliminado");
            } else {
                $retorno['messageErr'] .= urlencode("Error en la eliminación");
            }
        } else {
            $retorno['messageErr'] .= urlencode("Error en la eliminación");
        }
        return $retorno;
    }


    public function restarCantidad($datos)
    {
        $retorno = $this->getRetorno();
        $abmCompraItem = new abmcompraitem();
        $listaCI = $abmCompraItem->buscar(['idcompraitem' => $datos['idcompraitem']]);

        $compraItem = $listaCI[0];

        $cantidad = $compraItem->getCicantidad();
        $idCompra = $compraItem->getObjCompra()->getIdcompra();
        $idCompraItem = $compraItem->getIdcompraitem();
        $idProducto = $compraItem->getObjProducto()->getIdproducto();

        if ($cantidad == 1) {
            $retorno['messageErr'] .= urlencode("No se puede restar mas");
        } else {
            $cantidad--;
            $datosModificacion = [
                'idcompraitem' => $idCompraItem,
                'idcompra' => $idCompra,
                'idproducto' => $idProducto,
                'cicantidad' => $cantidad
            ];
            $abmCompraItem->modificacion($datosModificacion);
            $retorno['messageOk'] .= urlencode("Cantidad disminuida");
        }
        return $retorno;
    }


    public function sumarCantidad($datos)
    {
        $retorno = $this->getRetorno();
        $abmCompraItem = new abmcompraitem();
        $listaCI = $abmCompraItem->buscar(['idcompraitem' => $datos['idcompraitem']]);

        $compraItem = $listaCI[0];

        $cantidad = $compraItem->getCicantidad();
        $idCompra = $compraItem->getObjCompra()->getIdcompra();
        $idCompraItem = $compraItem->getIdcompraitem();
        $idProducto = $compraItem->getObjProducto()->getIdproducto();

        if ($cantidad + 1 <= $compraItem->getObjProducto()->getProcantstock()) {
            $cantidad++;
            $datosModificacion = [
                'idcompraitem' => $idCompraItem,
                'idcompra' => $idCompra,
                'idproducto' => $idProducto,
                'cicantidad' => $cantidad
            ];
            $abmCompraItem->modificacion($datosModificacion);
            $retorno['messageOk'] .= urlencode("Cantidad aumentada");
        } else {
            $retorno['messageErr'] .= urlencode("No se puede aumentar más");
        }
        return $retorno;
    }
}
