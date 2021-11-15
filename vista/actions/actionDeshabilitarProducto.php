<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmProducto = new abmproducto();

$lista = $abmProducto->buscar($datos);

if(isset($lista[0])) {
    $exito = $abmProducto->deshabilitarProd($datos);
    $exito ? header('Location: ../deposito/administrarProductos.php?message=' . urlencode("Producto deshabilitado correctamente")) : header('Location: ../deposito/administrarProductos.php?message=' . urlencode("Error en la deshabilitación"));
    exit;
} else {
    $message = "Producto no encontrado en la base de datos";
    header('Location: ../deposito/administrarProductos.php?message=' . urlencode($message));
    exit;
}