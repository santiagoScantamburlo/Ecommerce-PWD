<?php
include_once '../../configuracion.php';

$datos = data_submitted();
$datosBusqueda['idusuario'] = $datos['idusuario'];

$abmUsuario = new abmUsuario();

$lista = $abmUsuario->buscar($datosBusqueda);
$respuesta = [];

if (count($lista) > 0) {
    $controlAdmin = new control_admin();
    $respuesta = $controlAdmin->configuracion($datos);
} else {
    $message = "?messageErr=" . urlencode("Usuario no encontrado en la base de datos");
}

if (count($respuesta) > 0) {
    if ($respuesta['messageErr'] != "") {
        $message = $respuesta['messageErr'];
    } else {
        $message = $respuesta['messageOk'];
    }
}

header('Location: ../login/configuracion.php' . $message);
exit;
