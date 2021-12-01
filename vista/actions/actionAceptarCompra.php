<?php
include_once '../../configuracion.php';

$sesion = new session();
$datos = data_submitted();

$controlCompra = new control_compra();
$respuesta = $controlCompra->aceptarCompra($datos);


header('Location: ../home/index.php' . $respuesta['messageOk']);
exit;
