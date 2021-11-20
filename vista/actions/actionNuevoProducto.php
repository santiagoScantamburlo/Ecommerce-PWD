<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$abmProducto = new abmproducto();

$datosBusqueda['idproducto'] = $datos['idproducto'];
$listaProductos = $abmProducto->buscar($datos);

if (isset($listaProductos[0])) {
    $message = "El ID ingresado ya existe";
    header('Location: ../deposito/cargarProducto.php?message=' . urlencode($message));
    exit;
} else {
    $datos['procantventas'] = 0;
    $exito = $abmProducto->alta($datos);

    print_r($_FILES);

    if ($exito) {
        $control_carga_imagen = new control_imagen();
        $control_carga_imagen->cargarImagen($_FILES, $datos['idproducto']);
        $message = "Producto cargado correctamente";
        header('Location: ../deposito/administrarProductos.php?message=' . urlencode($message));
        exit;
    } else {
        $message = "Error en la carga del producto";
        header('Location: ../deposito/cargarProducto.php?message=' . urlencode($message));
        exit;
    }
}
