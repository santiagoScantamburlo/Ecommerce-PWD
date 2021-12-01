<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$controlAdmin = new control_admin();
$respuesta = $controlAdmin->nuevoUsuario($datos);

if ($respuesta['messageErr'] != "?messageErr=") {
    $message = $respuesta['messageErr'];
} else {
    $message = $respuesta['messageOk'];
}

header('Location: ../admin/administrarUsuarios.php' . $message);
exit;
