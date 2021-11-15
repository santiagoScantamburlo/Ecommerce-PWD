<?php
include_once '../../configuracion.php';

$datos = data_submitted();
$datosBusqueda['idproducto'] = $datos['idproducto'];

$abmProducto = new abmproducto();

$lista = $abmProducto->buscar($datosBusqueda);

if (isset($lista)) {
    $exito = $abmProducto->modificacion($datos);
    $exito ? header('Location: ../pages/administrarProductos.php?message=' . urlencode("Producto modificado")) : header('Location: ../pages/administrarProductos.php?message=' . urlencode("Error en la modificacion"));
    exit;
} else {
    $message = "Producto no encontrado en la base de datos";
    header('Location: ../pages/administrarProductos.php?message=' . urlencode($message));
    exit;
}
