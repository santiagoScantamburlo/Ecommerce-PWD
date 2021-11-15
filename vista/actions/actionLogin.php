<?php
include_once '../../configuracion.php';

$sesion = new session();
$datos = data_submitted();

$abmUsuario = new abmusuario();
$lista = $abmUsuario->buscar($datos);

if (isset($lista[0])) {
    $sesion->iniciar($datos['usnombre'], $datos['uspass']);
    $inicioSesion = $sesion->validar();

    if (isset($inicioSesion[1])) {
        $sesion->cerrarSession();
        header('Location: ../pages/login.php?message=' . urlencode($inicioSesion[1]));
        exit;
    } else {
        header('Location: ../home/index.php');
        exit;
    }
} else {
    header('Location: ../pages/login.php?message=' . urlencode("Usuario no encontrado"));
    exit;
}
