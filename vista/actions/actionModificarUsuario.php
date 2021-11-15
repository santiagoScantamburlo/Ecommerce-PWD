<?php
include_once '../../configuracion.php';

$datos = data_submitted();
$datosBusqueda['idusuario'] = $datos['idusuario'];

$abmUsuario = new abmUsuario();

$lista = $abmUsuario->buscar($datosBusqueda);

if (isset($lista)) {
    $exito = $abmUsuario->modificacion($datos);
    $abmUsuarioRol = new abmusuariorol();
    $exito = $abmUsuarioRol->modificacion($datos);
    $exito ? header('Location: ../pages/administrarUsuarios.php?message=' . urlencode("Usuario modificado")) : header('Location: ../pages/administrarUsuarios.php?message=' . urlencode("Error en la modificacion"));
    exit;
} else {
    $message = "Usuario no encontrado en la base de datos";
    header('Location: ../pages/administrarUsuarios.php?message=' . urlencode($message));
    exit;
}
