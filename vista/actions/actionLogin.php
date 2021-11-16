<?php
include_once '../../configuracion.php';

$sesion = new session();

if (!$sesion->activa()) {
    $datos = data_submitted();

    $abmUsuario = new abmusuario();
    $lista = $abmUsuario->buscar($datos);



    if (isset($lista[0])) {
        // $abmUsuarioRol = new abmusuariorol();
        // $listaUsRol = $abmUsuarioRol->buscar($lista[0]->getIdusuario());
        // $datos['rol'] = $listaUsRol[0]->getObjRol()->getIdrol();
        if ($lista[0]->getUsdeshabilitado() == '0000-00-00 00:00:00') {
            $sesion->iniciar($datos['usnombre'], $datos['uspass']/*, array($datos['rol'])*/);
            list($inicioSesion, $error) = $sesion->validar();
            if (!$inicioSesion) {
                $sesion->cerrarSession();
                header('Location: ../login/login.php?message=' . urlencode($error));
                exit;
            } else {
                header('Location: ../home/index.php');
                exit;
            }
        } else {
            header('Location: ../login/login.php?message=' . urlencode($error));
            exit;
        }
    } else {
        header('Location: ../login/login.php?message=' . urlencode("Usuario no encontrado"));
        exit;
    }
} else {
    header('Location: ../login/login.php');
    exit;
}
