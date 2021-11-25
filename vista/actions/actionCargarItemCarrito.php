<?php
include_once '../../configuracion.php';
$datos = data_submitted();
$sesion = new session();

if (!$sesion->activa()) {
    header('Location: ../login/login.php?messageErr=' . urlencode("Usted no ha iniciado sesion"));
    exit;
}

$idUsuario = $sesion->getIdusuario(); //Tomo el ID del usuario con la sesion activa
// echo $idUsuario;
$controlCarritoCliente = new control_carrito_cliente();
$compra = $controlCarritoCliente->verificarCarrito($idUsuario); //Invoco a la funcion, usando el id de usuario para buscar

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

        //Agrego a la tabla compraitem la nueva compra con el producto seleccionado
        $abmCompraItem = new abmcompraitem();


        $altaCompraItem = $abmCompraItem->alta(['idcompra' => $compra->getIdcompra(), 'idproducto' => $datos['idproducto'], 'cicantidad' => 1]);
        header('Location: ../cliente/carrito.php');
        exit;
    }
} else {
    //En caso de retornar una compra abierta, crea una nueva compraitem para el nuevo producto seleccionado
    $abmCompraItem = new abmcompraitem();
    $datosBusqueda['idcompra'] = $compra->getIdcompra();
    $datosBusqueda['idproducto'] = $datos['idproducto'];
    $listaCI = $abmCompraItem->buscar($datosBusqueda);

    if (count($listaCI) == 0) {
        $altaCompraItem = $abmCompraItem->alta(['idcompra' => $compra->getIdcompra(), 'idproducto' => $datos['idproducto'], 'cicantidad' => 1]);
        header('Location: ../cliente/carrito.php');
        exit;
    } else {
        $abmProducto = new abmproducto();
        $listaProducto = $abmProducto->buscar(['idproducto' => $datos['idproducto']]);
        $cantidad = $listaCI[0]->getCicantidad() + 1;
        if ($listaProducto[0]->getProcantstock() >= $cantidad) {
            $abmCompraItem->modificacion(['idcompraitem' => $listaCI[0]->getIdcompraitem(), 'idcompra' => $compra->getIdcompra(), 'idproducto' => $datos['idproducto'], 'cicantidad' => $cantidad]);
            header('Location: ../cliente/carrito.php');
            exit;
        } else {
            header('Location: ../cliente/carrito.php?messageErr=' . urlencode("No hay mas stock del producto"));
            exit;
        }
    }
}
