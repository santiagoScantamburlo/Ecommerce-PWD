<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmProducto = new abmproducto();
$lista = $abmProducto->buscar($datos);

if (isset($lista)) {
    $exito = $abmProducto->baja($datos);
    if ($exito) {
        $controlImagen = new control_imagen();
        $controlImagen->eliminarImagen($datos['idproducto']);
        header('Location: ../deposito/administrarProductos.php?message=' . urlencode("Producto eliminado"));
        exit;
    } else {
        header('Location: ../deposito/administrarProductos.php?message=' . urlencode("Error en la eliminacion"));
        exit;
    }
} else {
    $message = "Producto no encontrado en la base de datos";
    header('Location: ../deposito/administrarProductos.php?message=' . urlencode($message));
    exit;
}
