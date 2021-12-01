<?php
include_once '../../configuracion.php';

$sesion = new session();

if (!$sesion->activa()) {
    header('Location: ../home/index.php?message=' . urlencode('Sesion no iniciada'));
    exit;
}
$datos = data_submitted();
if (count($datos) == 0) {
    header('Location: ../home/index.php');
    exit;
}

$controlAdmin = new control_admin();
$respuesta = $controlAdmin->cambioRol($datos, $sesion);

header('Location: ../home/index.php?' . $respuesta['messageOk']);
exit;
