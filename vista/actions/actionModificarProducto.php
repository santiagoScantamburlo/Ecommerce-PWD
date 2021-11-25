<?php
include_once '../../configuracion.php';

$datos = data_submitted();
$datosBusqueda['idproducto'] = $datos['idproducto'];

$abmProducto = new abmproducto();

$lista = $abmProducto->buscar($datosBusqueda);

if (isset($lista)) {
    $exito = $abmProducto->modificacion($datos);
    $exito ? header('Location: ../deposito/administrarProductos.php?messageOk=' . urlencode("Producto modificado")) : header('Location: ../deposito/administrarProductos.php?messageErr=' . urlencode("Error en la modificacion"));
    exit;
} else {
    $message = "Producto no encontrado en la base de datos";
    header('Location: ../deposito/administrarProductos.php?messageErr=' . urlencode($message));
    exit;
}
