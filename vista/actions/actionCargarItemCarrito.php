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
$respuesta = $controlCarritoCliente->cargarItemCarrito($datos, $idUsuario);

if ($respuesta['messageErr'] != "?messageErr=") {
    $message = $respuesta['messageErr'];
} else {
    $message = $respuesta['messageOk'];
}

header('Location: ../cliente/carrito.php' . $message);
exit;
