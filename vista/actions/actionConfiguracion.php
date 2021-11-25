<?php
include_once '../../configuracion.php';

$datos = data_submitted();
$datosBusqueda['idusuario'] = $datos['idusuario'];

$abmUsuario = new abmUsuario();

$lista = $abmUsuario->buscar($datosBusqueda);

if (count($lista) > 0) {
    $exitoModificacionUsuario = $abmUsuario->modificacion($datos);
    $abmUsuarioRol = new abmusuariorol();
    $exitoModificacionUsuarioRol = $abmUsuarioRol->modificacion($datos);
    if ($exitoModificacionUsuario || $exitoModificacionUsuarioRol) {
        header('Location: ../home/index.php?messageOk=' . urlencode("Usuario modificado correctamente"));
        exit;
    } else {
        header('Location: ../login/configuracion.php?messageErr=' . urlencode("Error en la modificación"));
        exit;
    }
} else {
    $message = "Usuario no encontrado en la base de datos";
    header('Location: ../login/configuracion.php?messageErr=' . urlencode($message));
    exit;
}
