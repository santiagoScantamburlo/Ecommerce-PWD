<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$sesion = new session();
if (!$sesion->activa()) {
    header('Location: ../login/login.php?message=' . urlencode("No ha iniciado sesión"));
    exit;
}
$idUsuario = $sesion->getIdusuario();
$controlAdmin = new control_admin();
$respuesta = $controlAdmin->deshabilitarUsuario($datos, $idUsuario);

if ($respuesta['exito'] != "") {
    echo json_encode(['status' => "EXITO", 'fecha' => $respuesta['fecha']]);
} else {
    echo json_encode(['status' => "ERROR"]);
}
