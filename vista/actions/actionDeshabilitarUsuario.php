<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$sesion = new session();
if (!$sesion->activa()) {
    header('Location: ../login/login.php?message=' . urlencode("No ha iniciado sesión"));
    exit;
}

$abmUsuario = new abmusuario();

$lista = $abmUsuario->buscar($datos);
$idUsuario = $sesion->getIdusuario();

if (isset($lista[0])) {
    if ($lista[0]->getIdusuario() == $idUsuario) {
        header('Location: ../admin/administrarUsuarios.php?message=' . urlencode("No se puede deshabilitar a si mismo"));
        exit;
    }
    $exito = $abmUsuario->deshabilitarUsuario($datos);
    $exito ? header('Location: ../admin/administrarUsuarios.php?message=' . urlencode("Usuario deshabilitado correctamente")) : header('Location: ../admin/administrarUsuarios.php?message=' . urlencode("Error en la deshabilitación"));
    exit;
} else {
    $message = "Usuario no encontrado en la base de datos";
    header('Location: ../admin/administrarUsuarios.php?message=' . urlencode($message));
    exit;
}
