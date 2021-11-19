<?php
include_once '../../configuracion.php';

class control_carrito_cliente
{
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
}
