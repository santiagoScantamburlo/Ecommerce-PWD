<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmProducto = new abmproducto();
$lista = $abmProducto->buscar($datos);

if (isset($lista)) {
    $exito = $abmProducto->baja($datos);
    $exito ? header('Location: ../pages/administrarProductos.php?message=' . urlencode("Producto eliminado")) : header('Location: ../pages/administrarProductos.php?message=' . urlencode("Error en la eliminacion"));
    exit;
} else {
    $message = "Producto no encontrado en la base de datos";
    header('Location: ../pages/administrarProductos.php?message=' . urlencode($message));
    exit;
}
