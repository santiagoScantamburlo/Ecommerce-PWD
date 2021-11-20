<?php
include_once '../../configuracion.php';
$datos = data_submitted();
$sesion = new session();
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
    $altaCompraItem = $abmCompraItem->alta(['idcompra' => $compra->getIdcompra(), 'idproducto' => $datos['idproducto'], 'cicantidad' => 1]);
    header('Location: ../cliente/carrito.php');
    exit;
}
