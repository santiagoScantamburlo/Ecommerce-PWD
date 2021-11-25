<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$abmUsuario = new abmusuario();
$datosBusqueda['usnombre'] = $datos['usnombre'];

$lista = $abmUsuario->buscar($datosBusqueda);

if (count($lista) == 0) {
    $exito = false;
    $exitoAltaUsuario = $abmUsuario->alta($datos);
    if ($exitoAltaUsuario) {
        $lista = $abmUsuario->buscar($datos);
        $datos['idusuario'] = $lista[0]->getIdusuario();
        $abmUsuarioRol = new abmusuariorol();
        $exito = $abmUsuarioRol->alta($datos);
    }
    $exito ? header('Location: ../admin/administrarUsuarios.php?message=' . urlencode("Usuario cargado correctamente")) : header('Location: ../admin/administrarUsuarios.php?message=' . urlencode("Error en la carga"));
    exit;
} else {
    $message = "El nombre de usuario ya existe";
    header('Location: ../admin/cargarUsuario.php?message=' . urlencode($message));
    exit;
}
