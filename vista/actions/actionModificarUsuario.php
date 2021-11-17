<?php
include_once '../../configuracion.php';

$datos = data_submitted();
$datosBusqueda['idusuario'] = $datos['idusuario'];

$abmUsuario = new abmUsuario();

$lista = $abmUsuario->buscar($datosBusqueda);

if (isset($lista)) {
    $exitoModificacionUsuario = $abmUsuario->modificacion($datos);
    $abmUsuarioRol = new abmusuariorol();
    $exitoModificacionUsuarioRol = $abmUsuarioRol->modificacion($datos);
    if ($exitoModificacionUsuario || $exitoModificacionUsuarioRol) {
        header('Location: ../admin/administrarUsuarios.php?messageOk=' . urlencode("Usuario modificado correctamente"));
        exit;
    } else {
        header('Location: ../admin/formularioModificarUsuario.php?messageErr=' . urlencode("Error en la modificación"));
        exit;
    }
} else {
    $message = "Usuario no encontrado en la base de datos";
    header('Location: ../admin/administrarUsuarios.php?messageErr=' . urlencode($message));
    exit;
}
