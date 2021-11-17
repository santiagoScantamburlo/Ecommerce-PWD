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
        header('Location: ../admin/administrarUsuarios.php?messageErr=' . urlencode("No se puede deshabilitar a si mismo"));
        exit;
    }
    if($lista[0]->getUsdeshabilitado() == '0000-00-00 00:00:00') {
        $message = "Usuario deshabilitado";
    } else {
        $message = "Usuario habilitado";
    }
    $exito = $abmUsuario->deshabilitarUsuario($datos);
    $exito ? header('Location: ../admin/administrarUsuarios.php?messageOk=' . urlencode($message)) : header('Location: ../admin/administrarUsuarios.php?messageErr=' . urlencode("Error en la deshabilitación"));
    exit;
} else {
    $message = "Usuario no encontrado en la base de datos";
    header('Location: ../admin/administrarUsuarios.php?messageErr=' . urlencode($message));
    exit;
}
