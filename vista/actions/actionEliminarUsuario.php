<?php
include_once '../../configuracion.php';

$datos = data_submitted();

$abmUsuario = new abmusuario();
$lista = $abmUsuario->buscar($datos);

if (isset($lista)) {
    $exito = $abmUsuario->baja($datos);
    $exito ? header('Location: ../pages/administrarUsuarios.php?message=' . urlencode("Usuario eliminado")) : header('Location: ../pages/administrarUsuarios.php?message=' . urlencode("Error en la eliminación"));
    exit;
} else {
    $message = "Usuario no encontrado en la base de datos";
    header('Location: ../pages/administrarUsuarios.php?message=' . urlencode($message));
    exit;
}
