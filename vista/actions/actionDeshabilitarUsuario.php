<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmUsuario = new abmusuario();

$lista = $abmUsuario->buscar($datos);

if(isset($lista[0])) {
    $exito = $abmUsuario->deshabilitarUsuario($datos);
    $exito ? header('Location: ../pages/administrarUsuarios.php?message=' . urlencode("Usuario deshabilitado correctamente")) : header('Location: ../pages/administrarUsuarios.php?message=' . urlencode("Error en la deshabilitación"));
    exit;
} else {
    $message = "Usuario no encontrado en la base de datos";
    header('Location: ../pages/administrarUsuarios.php?message=' . urlencode($message));
    exit;
}