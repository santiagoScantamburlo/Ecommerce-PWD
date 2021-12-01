<?php
include_once '../../configuracion.php';

$sesion = new session();

if (!$sesion->activa()) {
    $datos = data_submitted();

    $controlUsuario = new control_usuario();
    $respuesta = $controlUsuario->login($datos);

    if ($respuesta['messageErr'] != "?messageErr=") {
        $message = $respuesta['messageErr'];
        header('Location: ../login/login.php' . $message);
        exit;
    } else {
        $message = $respuesta['messageOk'];
        header('Location: ../home/index.php' . $message);
        exit;
    }
} else {
    header('Location: ../home/index.php?messageErr=' . urlencode("Sesión ya iniciada"));
    exit;
}
