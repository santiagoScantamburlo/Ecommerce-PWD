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

if (isset($lista)) {
    if ($lista[0]->getIdusuario() == $idUsuario) {
        header('Location: ../admin/administrarUsuarios.php?messageErr=' . urlencode("No se puede eliminar a si mismo"));
        exit;
    }
    $exito = $abmUsuario->baja($datos);
    $exito ? header('Location: ../admin/administrarUsuarios.php?messageOk=' . urlencode("Usuario eliminado")) : header('Location: ../admin/administrarUsuarios.php?messageErr=' . urlencode("Error en la eliminación"));
    exit;
} else {
    $message = "Usuario no encontrado en la base de datos";
    header('Location: ../admin/administrarUsuarios.php?messageErr=' . urlencode($message));
    exit;
}
