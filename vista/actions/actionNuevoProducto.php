<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$abmProducto = new abmproducto();

$datosBusqueda['idproducto'] = $datos['idproducto'];
$listaProductos = $abmProducto->buscar($datos);

if (isset($listaProductos[0])) {
    $message = "El ID ingresado ya existe";
    header('Location: ../pages/cargarProducto.php?message=' . urlencode($message));
    exit;
} else {
    $datos['procantventas'] = 0;
    $exito = $abmProducto->alta($datos);

    if ($exito) {
        $message = "Producto cargado correctamente";
        header('Location: ../pages/listaProductos.php?message=' . urlencode($message));
        exit;
    } else {
        $message = "Error en la carga del producto";
        header('Location: ../pages/cargarProducto.php?message=' . urlencode($message));
        exit;
    }
}
