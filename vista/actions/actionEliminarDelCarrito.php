<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$controlCarrito = new control_carrito_cliente();
$respuesta = $controlCarrito->eliminarDelCarrito($datos);

if ($respuesta['messageErr' != "?messageErr="]) {
    $message = $respuesta['messageErr'];
} else {
    $message = $respuesta['messageOk'];
}

header('Location: ../cliente/carrito.php' . $message);
exit;
